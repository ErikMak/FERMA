<?php
require_once 'db.php';

if ((isset($_POST['username'])&&$_POST['username']!="")&&(isset($_POST['email'])&&$_POST['email']!="")&&(isset($_POST['password'])&&$_POST['password']!="")) {
	$username = filter_var(trim($_POST['username']),
	FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']),
	FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']),
	FILTER_SANITIZE_STRING);

	$password = md5($password."b7lm4kS99ae1O");
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$timestamp = date("d-m-Y");

// Get information about user
	$result = $connection->select("users", ["email"], ["email" => $email]);
	foreach($result as $user) { $valid_email = $user['email']; }
// Data validation
	if(!strcasecmp($valid_email, $email)) {
		$response = [
			"status" => false,
			"message" => 'Аккаунт с таким E-mail уже существует'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit();		
	} else {
		// Set referal
		if($_COOKIE["ref"]) {
			$ref = $_COOKIE["ref"];
		} else {
			$ref = 0;
		}
		// Data recording
		$connection->insert("users", [
			"email" => $email,
			"password" => $password,
			"user" => $username,
			"money" => 300,
			"bonus" => 0,
			"coins" => 0,
			"ip_address" => $ip_address,
			"ref" => $ref,
			"timestamp" => $timestamp
		]);
		$user_id = $connection->id();
		$connection->insert("farms", [
			"id" => $user_id,
			"level" => 1,
			"exp" => 0,
			"size" => 4,
			"products" => 0,
			"max_exp" => 100
		]);
		$connection->insert("storage", [
			"user_id" => $user_id,
			"level" => 1,
			"capacity" => 500,
			"requirement" => 120,
			"salad" => 0,
			"cucumber" => 0,
			"potato" => 0,
			"turnip" => 0,
			"squash" => 0,
			"cauliflower" => 0,
			"corn" => 0,
			"tomato" => 0,
			"radish" => 0,
			"pepper" => 0,
			"eggplant" => 0,
			"beet" => 0,
			"pumpkin" => 0,
			"chin_cabbage" => 0,
			"artichoke" => 0,
			"material" => 0,
			"fuel" => 300
		]);
		// Writing log
		$connection->insert("logs", [
			"timestamp" => date("H:i:s d-m-Y"),
			"user_id" => $user_id,
			"action" =>  $username.' зарегистрировал аккаунт. IP: '.$_SERVER['REMOTE_ADDR']
		]);
		// Response on client
		$response = [
			"status" => true
		];
		echo json_encode($response);
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