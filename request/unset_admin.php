<?php
require_once 'db.php';
if ((isset($_POST['user_id'])&&$_POST['user_id']!="") && (isset($_POST['secret_code'])&&$_POST['secret_code']!="")) {
	$user_id = decrypt($_POST['user_id']);
	$secret_code = filter_var(trim($_POST['secret_code']),
	FILTER_SANITIZE_STRING);

	if ($secret_code === "Qdkvsuomj911") {
		$connection->update("users", ["admin" => false], ["id" => $user_id, "LIMIT" => 1]);
		$response = [
			"status" => true,
			"title" => 'Пользователь лишен админ-прав!'
		];
		echo json_encode($response);
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