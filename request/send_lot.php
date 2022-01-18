<?
require_once 'db.php';
session_start();

if ((isset($_POST['unitPrice'])&&$_POST['unitPrice']!=""&&is_numeric($_POST['unitPrice'])) && (isset($_POST['quantity'])&&$_POST['quantity']!=""&&is_numeric($_POST['quantity'])) && (isset($_POST['productName'])&&$_POST['productName']!=""&&is_string($_POST['productName']))  && (isset($_POST['productNameRU'])&&$_POST['productNameRU']!="")) {

	define('USER_ID', $_SESSION['user_data']['id']);
	$productName = filter_var(trim($_POST['productName']),
	FILTER_SANITIZE_STRING);
	$productNameRU = filter_var(trim($_POST['productNameRU']),
	FILTER_SANITIZE_STRING);
	$quantity = filter_var(trim($_POST['quantity']),
	FILTER_SANITIZE_NUMBER_FLOAT);
	$unitPrice = filter_var(trim($_POST['unitPrice']),
	FILTER_SANITIZE_NUMBER_FLOAT);

	function getStorageQuantity($db, $productName, $user_id) {
		$result = $db->select("storage", [$productName], ["user_id" => $user_id, "LIMIT" => 1]);
		foreach ($result as $quantity) {
			return $quantity[$productName];
		}
	};
// Validate data
	if ($quantity > getStorageQuantity($connection, $productName, USER_ID)) {
		$response = [
			"status" => false,
			"title" => 'Недостаточно товаров на складе!'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	}
// Writeoff product
	$connection->update("storage", [ $productName.'[-]' => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
// Push a lot
	$connection->insert("marketplace", [
		"productName" => $productName,
		"productNameRU" => $productNameRU,
		"quantity" => $quantity,
		"lotPrice" => round(($quantity * $unitPrice) + ($quantity * $unitPrice *0.08)),
		"user_id" => USER_ID
	]);
	$lot_id = $connection->id();
// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => $_SESSION['user_data']['username'].' выставил лот №'.$lot_id,
	]);
// Response on client
	$response = [
		"status" => true,
		"title" => 'Лот выставлен на продажу!'
	];
	echo json_encode($response);
// Send signal to WebSocket
$instance = stream_socket_client('tcp://127.0.0.1:1234');
fwrite($instance, json_encode(['id' => USER_ID, 'lot_id' => $lot_id])  . "\n");
}
$connection->pdo=null;	
?>