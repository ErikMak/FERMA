<?php
require_once 'db.php';
if ((isset($_POST['user_id'])&&$_POST['user_id']!="") && (isset($_POST['secret_code'])&&$_POST['secret_code']!="") && (isset($_POST['reason'])&&$_POST['reason']!="")) {
	$user_id = filter_var(trim($_POST['user_id']),
	FILTER_SANITIZE_NUMBER_FLOAT);
	$secret_code = filter_var(trim($_POST['secret_code']),
	FILTER_SANITIZE_STRING);
	$reason = filter_var(trim($_POST['reason']),
	FILTER_SANITIZE_STRING);


	if ($secret_code === "Qdkvsuomj911") {
		$result = $connection->select("users", ["id", "user", "ip_address"], ["id" => $user_id] );
		if (empty($result)) {
			$response = [
				"status" => false,
				"title" => 'Пользователя не существует!'
			];
			echo json_encode($response);
			$connection->pdo=null;
			exit ();
		} else {
			foreach($result as $user) { 
				$connection->insert("ban_list", [
					"timestamp" => date("H:i:s d-m-Y"),
					"user_id" => $user['id'],
					"user" => $user['user'],
					"ip_address" => $user['ip_address'],
					"reason" => $reason,
				]);
				// Writing log
				$connection->insert("logs", [
					"timestamp" => date("H:i:s d-m-Y"),
					"user_id" => $user['id'],
					"action" =>  $user['user'].' заблокирован по причине: '.$reason
				]);
				$response = [
					"status" => true,
					"title" => $user['user'].' заблокирован!'
				];
				echo json_encode($response);
			}
		}
	} else {
		$response = [
			"status" => false,
			"title" => 'Ключ-код не верный!'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	}
}
$connection->pdo=null;
?>