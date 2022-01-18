<?
require_once 'db.php';
session_start();

if (isset($_POST['quantity'])&&$_POST['quantity']!=""&&is_numeric($_POST['quantity'])) {
	define('USER_ID', $_SESSION['user_data']['id']);
	$quantity = filter_var(trim($_POST['quantity']),
	FILTER_SANITIZE_NUMBER_FLOAT);
	// Get fuel price
	$result = $connection->select("rules", ["fuel"]);
	foreach ($result as $fuel) {
		$finalPrice = $fuel["fuel"] * $quantity;
		if ($_SESSION['user_data']['money'] < $finalPrice) {
			$response = [
				"status" => false,
				"title" => 'Недостаточно денег!'
			];
			echo json_encode($response);
			$connection->pdo=null;
			exit ();
		}
	// Update sessions
		$_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] - $finalPrice; 
	// Variable announcement
		$money = $_SESSION['user_data']['money'];
	// Charge fuel
		$connection->update("storage", [ "fuel[+]" => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
	// Change the trend on the burse
		$connection->update("rules", [ "purchases[+]" => $finalPrice ]);
	// Update money on db
		$connection->update("users", [
		"money" => $money
		], ["id" => USER_ID, "LIMIT" => 1]);
	// Writing log
		$connection->insert("logs", [
			"timestamp" => date("H:i:s d-m-Y"),
			"user_id" => USER_ID,
			"action" => 'Покупка fuel за '.$finalPrice.'$ количеством '.$quantity.' пользователем '.$_SESSION['user_data']['username'].'. Баланс пользователя: '.$money.'$'
		]);
	// Response on client
		$response = [
			"status" => true,
			"title" => 'Успешная покупка',
			"balance" => $money
		];
		echo json_encode($response);
	}
}
$connection->pdo=null;
?>