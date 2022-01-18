<?php
session_start();
require_once 'db.php';
$requirement = filter_var(trim($_POST['requirement']),
FILTER_SANITIZE_STRING);
$size = filter_var(trim($_POST['size']),
FILTER_SANITIZE_STRING);

// Get information about user id
define('USER_ID', $_SESSION['user_data']['id']);
// Get information about user's materials
$result = $connection->select("storage", "*", ["user_id" => USER_ID, "LIMIT" => 1]);
foreach($result as $storage) {
	if ($storage['material'] < $requirement) {
		$response = [
			"status" => false,
			"title" => 'Недостаточно материалов на складе!'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	} else {
		$connection->update("storage", [ "material" => $storage['material'] - $requirement, "capacity" => $size, "requirement" => $requirement, "level[+]" => 1], ["user_id" => USER_ID, "LIMIT" => 1]);
		$response = [
			"status" => true,
			"material" => $storage['material'] - $requirement,
			"title" => 'Уровень склада повышен!'
		];
		echo json_encode($response);
	}
}
$connection->pdo=null;
?>