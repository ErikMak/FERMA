<?
session_start();
require_once 'db.php';


define('USER_ID', $_SESSION['user_data']['id']);
// Bonus system
function getRandomIndex($data, $column = 'ver') {
  $rand = mt_rand(1, array_sum(array_column($data, $column)));
  $cur = $prev = 0;
  for ($i = 0, $count = count($data); $i < $count; ++$i) {
    $prev += $i != 0 ? $data[$i-1][$column] : 0;
    $cur += $data[$i][$column];
    if ($rand > $prev && $rand <= $cur) {
      return $i;
    }
  }
  return -1;
}

$result = $connection->select("farms", ["level"], ["id" => USER_ID]);
// Check a user's level
foreach($result as $user) { $level = $user["level"]; }
if ($level < 4) {
	// Check existence of a bonus
	$result = $connection->select("users", ["bonus"], ["id" => USER_ID]);
	foreach($result as $user) {
		if($user["bonus"] == false) {
			$bonus = [
			  ['maxBonus' => 500, 'ver' => 22], // Low chance
			  ['maxBonus' => 1000, 'ver' => 11], // Medium
			  ['maxBonus' => 2500, 'ver' => 6], // High
			  ['maxBonus' => 5000, 'ver' => 1], // Overhigh
			];
			$bonusAmount = rand(100, $bonus[getRandomIndex($bonus)]['maxBonus']);
			// Bonus accrual
			$_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] + $bonusAmount; 
			$money = $_SESSION['user_data']['money'];
			// Start timer
			$timestamp = date("mdHis");
			$connection->update("users", [
				"money" => $money,
				"bonus" => $timestamp,
			], ["id" => USER_ID, "LIMIT" => 1]);
			// Response on client
			$response = [
				"status" => true,
				"title" => 'Бонус '.$bonusAmount.'$ начислен!',
				"balance" => $money
			];
			echo json_encode($response);
		} else {
			// Check timer
			if(date("mdHis") - $user["bonus"] > 24*60*60) {
				$bonus = [
				  ['maxBonus' => 500, 'ver' => 22], // Low chance
				  ['maxBonus' => 1000, 'ver' => 11], // Medium
				  ['maxBonus' => 2500, 'ver' => 6], // High
				  ['maxBonus' => 5000, 'ver' => 1], // Overhigh
				];
				$bonusAmount = rand(100, $bonus[getRandomIndex($bonus)]['maxBonus']);
				// Bonus accrual
				$_SESSION['user_data']['money'] = $_SESSION['user_data']['money'] + $bonusAmount; 
				$money = $_SESSION['user_data']['money'];
				// Start timer
				$timestamp = date("mdHis");
				$connection->update("users", [
					"money" => $money,
					"bonus" => $timestamp,
				], ["id" => USER_ID, "LIMIT" => 1]);
				// Response on client
				$response = [
					"status" => true,
					"title" => 'Бонус '.$bonusAmount.'$ начислен!',
					"balance" => $money
				];
				echo json_encode($response);
			} else {
				$response = [
					"status" => false,
					"title" => 'Вы уже получали сегодня бонус!'
				];
				echo json_encode($response);
			}
		}
	}
} else {
	$response = [
		"status" => false,
		"title" => 'Бонус только новичкам проекта!'
	];
	echo json_encode($response);
}

$connection->pdo=null;
?>