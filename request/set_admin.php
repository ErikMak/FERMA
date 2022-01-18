<?php
require_once 'db.php';

if ((isset($_POST['user_id'])&&$_POST['user_id']!="") && (isset($_POST['secret_code'])&&$_POST['secret_code']!="")) {
	$user_id = filter_var(trim($_POST['user_id']),
	FILTER_SANITIZE_NUMBER_FLOAT);
	$secret_code = filter_var(trim($_POST['secret_code']),
	FILTER_SANITIZE_STRING);

	if ($secret_code === "Qdkvsuomj911") {
		$result = $connection->select("users", ["user"], [ "id" => $user_id] );
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
				$connection->update("users", ["admin" => true], ["id" => $user_id, "LIMIT" => 1]);
				$response = [
					"status" => true,
					"title" => $user['user'].' получил админ-права!'
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