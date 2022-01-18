<?
require_once 'db.php';
session_start();

define('USER_ID', $_SESSION['user_data']['id']);
define('ORDER_COST', 10000);
// Validate money
if ($_SESSION['user_data']['money'] < ORDER_COST) {
	$response = [
		"status" => false,
		"title" => 'Недостаточно денег!'
	];
	echo json_encode($response);
	$connection->pdo=null;
	exit ();
}
// Update sessions
	$_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] - ORDER_COST; 
// Variable announcement
	$money = $_SESSION['user_data']['money'];
// Writing to the database
	$connection->insert("sawmills", [
		"user_id" => USER_ID,
		"research" => true,
		"days" => 3,
		"speed" => 0,
		"service_cost" => 0,
		"prod_volume" => 0,
		"mining" => false
	]);
	$sawmill_id = $connection->id();
	$connection->update("users", [
		"money" => $money
	], ["id" => USER_ID, "LIMIT" => 1]);
// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => $_SESSION['user_data']['username'].' заказал исследование. class: sawmills ID'.$sawmill_id
	]);
// Response on client
	$response = [
		"status" => true,
		"balance" => $money,
		"title" => 'Исследование добавлено!'
	];
	echo json_encode($response);
$connection->pdo=null;
?>