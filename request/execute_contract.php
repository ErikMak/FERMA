<?
session_start();
require_once 'db.php';

if (isset($_POST['article'])&&$_POST['article']!="") {
	$article = decrypt($_POST['article']);

	// Get information about user id
	define('USER_ID', $_SESSION['user_data']['id']);
    // Get information about contract
    $result = $connection->select("contracts", ["item"], ["id" => $article, "LIMIT" => 1]);
    if (empty($result)) {
		$response = [
			"status" => false,
			"title" => 'Контракта не существует!'
		];
		echo json_encode($response);
		$connection->pdo=null;
		exit ();
	}
	foreach($result as $contract) {
		$item = unserialize($contract['item']);
		// Get information about user storage
		$result = $connection->select("storage", "*", ["user_id" => USER_ID, "LIMIT" => 1]);
		foreach($result as $storage) {
		// Comparison of values
			for($i = 0; $i < count($item) - 1; ++$i) {
				if ($storage[$item[$i]['name']] < $item[$i]['quantity']) {
					$response = [
						"status" => false,
						"title" => 'Недостаточно товаров на складе!'
					];
					echo json_encode($response);
					$connection->pdo=null;
					exit ();
				}
			}
			// Reduction of products
			for($i = 0; $i < count($item) - 1; ++$i) {
				$quantity = $storage[$item[$i]['name']] - $item[$i]['quantity'];
				$name = $item[$i]['name'];
				$connection->update("storage", [ $name => $quantity ], ["user_id" => USER_ID, "LIMIT" => 1]);
			}
			// Update sessions
			$cost = $item[(count($item) - 1)];
		    $_SESSION['user_data']['coins'] = $_SESSION['user_data']['coins'] + $cost;
		    $coins = $_SESSION['user_data']['coins'];
		    // Deposit money
    		$connection->update("users", ["coins" => $coins], ["id" => USER_ID, "LIMIT" => 1]);
    		// Writing log
			$connection->insert("logs", [
				"timestamp" => date("H:i:s d-m-Y"),
				"user_id" => USER_ID,
				"action" => 'Выполнение контракта стоимостью '.$cost.' C пользователем '.$_SESSION['user_data']['username'].'. Кристаллов: '.$coins.' C'
			]);
			// Response on client
			$response = [
				"status" => true,
				"coins" => $coins,
				"title" => 'Успешная продажа'
			];
			echo json_encode($response);
			}
		}
	}
$connection->pdo=null;
?>