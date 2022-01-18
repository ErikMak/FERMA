<?php
session_start();
require_once 'db.php';

if (isset($_POST['feg_id'])&&$_POST['feg_id']!="") {
	$feg_id = decrypt($_POST['feg_id']);
	define('USER_ID', $_SESSION['user_data']['id']);
// Increase farm size
	$_SESSION['farm_data']['size'] = $_SESSION['farm_data']['size'] + 1;
	$size = $_SESSION['farm_data']['size'];
// Get engaged
	$engaged = $connection->count("user_feg", "*", ["user_id" => USER_ID]);
	// Protection
	$result = $connection->select("user_feg", ["user_id", "name"], ["feg_id" => $feg_id]);
	foreach($result as $feg) {
		if ($feg["user_id"] != USER_ID) {
			$response = [
				"status" => false,
				"title" => 'Ошибка внутреннего запроса!'
			];
			echo json_encode($response);
			$connection->pdo=null;
			exit ();
		}
		$fegName = $feg["name"];
	}

// Data recording
	$connection->update("farms", ["size" => $size], ["id" => $_SESSION['user_data']['id'], "LIMIT" => 1]);
	$connection->delete("user_feg", ["feg_id" => $feg_id]);
// Writing log
	$engaged = $engaged - 1;
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Удаление '.$fegName.' пользователем '.$_SESSION['user_data']['username'].'. Занятые места: '.$engaged.'. Доступно: '.$size.' яч.'
	]);
// Response on client
	$response = [
		"status" => true,
		"title" => 'Растение удалено!',
		"size" => $size,
		"engaged" => $engaged
	];
	echo json_encode($response);
}
$connection->pdo=null;
?>