<?
session_start();
require_once 'db.php';
if ((isset($_POST['name'])&&$_POST['name']!="") && (isset($_POST['quantity'])&&$_POST['quantity']!=""&&is_numeric($_POST['quantity']))){
	define('USER_ID', $_SESSION['user_data']['id']);
	$name = $_POST['name'];
	$quantity = filter_var(trim($_POST['quantity']),
	FILTER_SANITIZE_NUMBER_FLOAT);


// Get information about user storage
	$result = $connection->select("storage", "*", ["user_id" => USER_ID, "LIMIT" => 1]);
    foreach($result as $storage) { $valid_quantity = $storage[$name]; }
// Data validation 
    if($valid_quantity < $quantity) {
		$response = [
			"status" => false,
			"title" => 'Такого количества нету на складе!'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	} else if ($name == "material") {
	// Calculate materials selling price
		$sale = 100 * $quantity;
	// Update sessions
	    $_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] + $sale;
	    $money = $_SESSION['user_data']['money'];
	// Deposit money
	    $connection->update("users", ["money" => $money], ["id" => USER_ID, "LIMIT" => 1]);
	// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Продажа '.$name.' пользователем '.$_SESSION['user_data']['username'].' в размере '.$quantity.'. Баланс пользователя: '.$money.'$'
	]);
	// Decrease quantity
	    $quantity = $valid_quantity - $quantity;
		$connection->update("storage", [ $name => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
	// Response on client
		$response = [
			"status" => true,
			"title" => 'Успешная продажа',
			"balance" => $money,
			"quantity" => $quantity
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit();
	} else if ($name == "fuel") {
	// Get fuel price
		$result = $connection->select("rules", [ "fuel" ]);
	    foreach($result as $rules) { 
	    	$sale = round($rules['fuel'] - $rules['fuel']*0.08) * $quantity; 
	    }
	// Update sessions
	    $_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] + $sale;
	    $money = $_SESSION['user_data']['money'];
	// Deposit money
	    $connection->update("users", ["money" => $money], ["id" => USER_ID, "LIMIT" => 1]);
	// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Продажа '.$name.' пользователем '.$_SESSION['user_data']['username'].' в размере '.$quantity.'. Баланс пользователя: '.$money.'$'
	]);
	// Decrease quantity
		$quantity = $valid_quantity - $quantity;
		$connection->update("storage", [ $name => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
	// Change the trend on the burse
		$connection->update("rules", [ "sales[+]" => $sale ]);
	// Response on client
		$response = [
			"status" => true,
			"title" => 'Успешная продажа',
			"balance" => $money,
			"quantity" => $quantity
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit();
	}
// Get information about selling price
	$result = $connection->select("seeds", ["sale"], ["en_name" => $name, "LIMIT" => 1]);
// Calculate selling price
    foreach($result as $feg) { 
	    $sale = $feg["sale"] * $quantity;
	}
// Update sessions
    $_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] + $sale;
    $money = $_SESSION['user_data']['money'];
// Deposit money
    $connection->update("users", ["money" => $money], ["id" => USER_ID, "LIMIT" => 1]);
// Writing log
	$connection->insert("logs", [
		"timestamp" => date("H:i:s d-m-Y"),
		"user_id" => USER_ID,
		"action" => 'Продажа '.$name.' пользователем '.$_SESSION['user_data']['username'].' в размере '.$quantity.'. Баланс пользователя: '.$money.'$'
	]);
// Decrease quantity
	$quantity = $valid_quantity - $quantity;
	$connection->update("storage", [ $name => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
// Response on client
	$response = [
		"status" => true,
		"title" => 'Успешная продажа',
		"balance" => $money,
		"quantity" => $quantity
	];
	echo json_encode($response);
}
$connection->pdo=null;
?>