<?php
session_start();
require_once 'db.php';

if ((isset($_POST['email'])&&$_POST['email']!="")&&(isset($_POST['password'])&&$_POST['password']!="")) {
	$email = filter_var(trim($_POST['email']),
	FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']),
	FILTER_SANITIZE_STRING);
	$password = md5($password."b7lm4kS99ae1O");

// Get information about user
	$result = $connection->select("users", ["id", "user", "admin", "email", "money", "coins", "ip_address", "timestamp"], [
		"AND" => [
			"email" => $email,
			"password" => $password
		],
		"LIMIT" => 1
	]);
	foreach($result as $user) { $admin_status = $user['admin']; }
	if (empty($result)) {
		$response = [
			"status" => false,
			"message" => 'Не верный логин или пароль'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	} else if ($admin_status) {
		foreach($result as $user) {
		// Create sessions
			$_SESSION['admin_data'] = [
				"id" => $user['id'],
				"username" => $user['user'],
				"email" => $user['email']
			];
		// Response on client
			$response = [
				"admin" => true
			];
			echo json_encode($response);
		}
	} else {
		foreach($result as $user) {
		// Checking ban status
		$ban = $connection->select("ban_list", "*", ["ip_address" => $user['ip_address'], "LIMIT" => 1]);
			if (empty($ban)) {
			// Create sessions
				$_SESSION['user_data'] = [
					"id" => $user['id'],
					"username" => $user['user'],
					"email" => $user['email'],
					"money" => $user['money'],
					"coins" => $user['coins'],
					"timestamp" => $user['timestamp']
				];
			// Writing log
				$connection->insert("logs", [
					"timestamp" => date("H:i:s d-m-Y"),
					"user_id" => $user['id'],
					"action" =>  $user['user'].' вошел в аккаунт. IP: '.$_SERVER['REMOTE_ADDR']
				]);
			// Response on client
				$response = [
					"status" => true
				];
				echo json_encode($response);
			} else {
				foreach($ban as $ban_list) {
				$response = [
					"status" => false,
					"message" => 'IP заблокирован '.$ban_list['timestamp'].' по причине "'.$ban_list['reason'].'"'
				];
				echo json_encode($response);
				$connection->pdo=null;
				exit ();
				}
			}
		}
	}
} else {
	$response = [
		"status" => false,
		"message" => 'Серверная ошибка'
	];
	echo json_encode($response);
	$connection->pdo=null;
	exit();
}
	$connection->pdo=null;
?>