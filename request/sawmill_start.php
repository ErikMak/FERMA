<?
require_once 'db.php';

if (isset($_POST['item_id'])&&$_POST['item_id']!="") {
	$item_id = decrypt($_POST['item_id']);
	$connection->update("sawmills", ["mining" => true], ["id" => $item_id, "LIMIT" => 1]);
	$result = $connection->select("sawmills", ["name"], ["id" => $item_id, "LIMIT" => 1]);
	foreach($result as $item) {
		$response = [
			"title" => $item['name']." теперь добывается"
		];
		echo json_encode($response);
	}
}
$connection->pdo=null;
?>