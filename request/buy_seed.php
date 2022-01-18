<?php
session_start();
require_once 'db.php';

if (isset($_POST['article'])&&$_POST['article']!="") {

	$article = decrypt($_POST['article']);
	define('USER_ID', $_SESSION['user_data']['id']);
// Get information about the rurchased object
	$result = $connection->select("seeds", ["name", "class", "sale", "maturation", "price", "en_name"], ["id" => $article]);
	foreach($result as $seed) {
	// Get season information
		$result = $connection->select("rules", ["season"]);
		foreach($result as $rules) {
	// Data validation
			if($_SESSION['user_data']['money'] < $seed['price']) {
				$response = [
					"status" => false,
					"title" => 'Недостаточно денег!'
				];
				echo json_encode($response);
				$connection->pdo=null;
				exit ();
			} else if ($_SESSION['farm_data']['size'] < 1) {
				$response = [
					"status" => false,
					"title" => 'На поле нет места!'
				];
				echo json_encode($response);
				$connection->pdo=null;
				exit ();
			}  else if ($rules['season'] != $seed['class']) {
				$response = [
					"status" => false,
					"title" => 'Семена больше не продаются!'
				];
				echo json_encode($response);
				$connection->pdo=null;
				exit ();
			} 
		}

	// Update sessions
		$_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] - $seed['price']; 
		$_SESSION['farm_data']['size'] = $_SESSION['farm_data']['size'] - 1;
	// Data recording
		$money = $_SESSION['user_data']['money'];
		$seedName = $seed["name"];
		$price = $seed["price"];
		$maturation = $seed["maturation"];
		$sale = $seed["sale"];
		$size = $_SESSION['farm_data']['size'];
		$class = $seed["class"];
		$en_seedName = $seed["en_name"];
	}

// Writing to the database
	$connection->insert("user_feg", [
		"user_id" => USER_ID,
		"class" => $class,
		"name" => $seedName,
		"maturation" => $maturation,
		"sale" => $sale,
		"price" => $price,
		"en_name" => $en_seedName
	]);
	$connection->update("users", [
		"money" => $money
	], ["id" => USER_ID, "LIMIT" => 1]);
	$connection->update("farms", [
		"size" => $size
	], ["id" => USER_ID, "LIMIT" => 1]);
// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Покупка '.$seedName.' за '.$price.'$ пользователем '.$_SESSION['user_data']['username'].'. Баланс пользователя: '.$money.'$'
	]);
// Response on client
	$response = [
		"status" => true,
		"title" => 'Успешная покупка',
		"balance" => $money
	];
	echo json_encode($response);
}
$connection->pdo=null;
?>