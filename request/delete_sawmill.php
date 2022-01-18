<?php
session_start();
require_once 'db.php';


if (isset($_POST['item_id'])&&$_POST['item_id']!="") {
	$item_id = decrypt($_POST['item_id']);
	define('USER_ID', $_SESSION['user_data']['id']);


	$result = $connection->select("sawmills", ["user_id"], ["id" => $item_id]);
	foreach($result as $sawmill) {
	// Protection
		if ($sawmill["user_id"] != USER_ID) {
			$response = [
				"status" => false,
				"title" => 'Ошибка внутреннего запроса!'
			];
			echo json_encode($response);
			$connection->pdo=null;
			exit ();
		}
	}
	// Data recording
	$connection->delete("sawmills", ["id" => $item_id]);
	// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Удаление лесопилки ID'.$item_id.' пользователем '.$_SESSION['user_data']['username']
	]);
	// Response on client
	$response = [
		"status" => true,
		"title" => 'Постройка удалена!',
		"balance" => $money
	];
	echo json_encode($response);
}
$connection->pdo=null;
?>