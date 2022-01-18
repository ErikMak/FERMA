<?
$start = microtime(true);
$db = @new mysqli('localhost', 'root', 'root', 'game');
$userStorage = new userStorage($db);
$dailyUpdate = new dailyUpdate($db);
$Own = new Own($db);
$Sawmills = new Sawmills($db);
$User = new User($db);

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
class userStorage {
	private $connection;

	public function __construct($connection) {
		$this->connection = $connection;
	}
	public function increaseCapacity($name, $user_id) {
		$this->connection->query("UPDATE `storage` SET `".$name."` = `".$name."` + 1 WHERE `user_id` = '".$user_id."' LIMIT 1");
	}
	public function increaseMaterials($amount, $user_id) {
		$this->connection->query("UPDATE `storage` SET `material` = `material` + ".$amount." WHERE `user_id` = '".$user_id."' LIMIT 1");
	}
	public function getCapacity($user_id) {
		$result = $this->connection->query("SELECT `capacity` FROM `storage` WHERE `user_id` = '".$user_id."'");
		$storage = $result->fetch_assoc();
		return $storage['capacity'];
	}
	public function getFullness($user_id) {
		$result = $this->connection->query("SELECT `salad` + `cucumber` + `potato` + `turnip` + `squash` + `cauliflower` + `corn` + `tomato` + `radish` + `pepper` + `eggplant` + `beet` + `pumpkin` + `chin_cabbage` + `artichoke` + `material` + `fuel` AS `total` FROM `storage` WHERE `user_id` = '".$user_id."'");
		$storage = $result->fetch_assoc();
		return $storage['total'];
	}
	public function getFuel($user_id) {
		$result = $this->connection->query("SELECT `fuel` FROM `storage` WHERE `user_id` = '".$user_id."' LIMIT 1");
		$storage = $result->fetch_assoc();
		return $storage["fuel"];
	}
}
class dailyUpdate {
	private $connection;

	public function __construct($connection) {
		$this->connection = $connection;
	}
	public function reduceDays() {
		$this->connection->query("UPDATE `rules` SET `days` = `days` - 1");
	}
	public function reduceMaturation($feg_id) {
		$this->connection->query("UPDATE `user_feg` SET `maturation` = `maturation` - 1 WHERE `feg_id` = '".$feg_id."' LIMIT 1");
	}
	public function updateSeason($season) {
		$this->connection->query("UPDATE `rules` SET `days` = '14', `season` = '".$season."'");
	}
	public function removePlants($season, $user_id) {
		$this->connection->query("DELETE FROM `user_feg` WHERE `class` = '".$season."' LIMIT 1");
		$this->connection->query("UPDATE `farms` SET `size` = `size` + 1 WHERE `id` = '".$user_id."' LIMIT 1");
	}
	public function setFuelPrice($trend, $percent, $lastPrice) {
		switch ($trend) {
			case "up":
				return $lastPrice + ($lastPrice/100)*$percent;
				break;
			case "down":
				return $lastPrice - ($lastPrice/100)*$percent;
				break;
		}
	}
}
class Own {
	private $connection;

	public function __construct($connection) {
		$this->connection = $connection;
	}
	public function getRequiredFuelAmount($user_id) {
		$totalRequiredAmount = 0;
		$result = $this->connection->query("SELECT `fuel` FROM `user_objects` WHERE `user_id` = '".$user_id."'");
		foreach ($result as $fuel) {
			$totalRequiredAmount+=$fuel['fuel'];
		}
		return $totalRequiredAmount;
	}
	public function decreaseFuelAmount($user_id, $fuel) {
		$this->connection->query("UPDATE `storage` SET `fuel` = '".$fuel."' WHERE `user_id` = '".$user_id."' LIMIT 1");
	}
}
class Sawmills {
	private $connection;

	public $namesLow = array(
		'Березовое редколесье',
		'Кедровник',
		'Дубрава',
		'Буковый перелесок',
		'Ельник',
	);
	public $namesMedium = array(
		'Березовая роща',
		'Липовая роща',
		'Дубовая роща',
		'Буковая роща',
		'Хвойная роща',
	);
	public $namesHigh = array(
		'Березовый лес',
		'Липовый лес',
		'Дубовый лес',
		'Буковый лес',
		'Хвойный лес',
	);

	public function __construct($connection) {
		$this->connection = $connection;
	}
	public function decreaseResearchDays($sawmill_id) {
		$this->connection->query("UPDATE `sawmills` SET `days` = `days` - 1 WHERE `id` = '".$sawmill_id."' LIMIT 1");
	} 
	public function getRequiredMoney($user_id) {
		$totalRequiredMoney = 0;
		$result = $this->connection->query("SELECT `service_cost` FROM `sawmills` WHERE `user_id` = '".$user_id."' AND `mining` = true");
		foreach ($result as $money) {
			$totalRequiredMoney+=$money['service_cost'];
		}
		return $totalRequiredMoney;
	}
	public function checkWorkedOut($sawmill_id) {
		$result = $this->connection->query("SELECT `prod_volume`, `mined` FROM `sawmills` WHERE `id` = '".$sawmill_id."' AND `mining` = true");
		$sawmill = $result->fetch_assoc();
		if ($sawmill["mined"] > $sawmill["prod_volume"]) {
			return false;
		} else {
			return true;
		}
	}
	public function getProduction($sawmill_id) {
		$result = $this->connection->query("SELECT `speed` FROM `sawmills` WHERE `id` = '".$sawmill_id."' AND `mining` = true");
		$sawmill = $result->fetch_assoc();
		return $sawmill["speed"];
	}
	public function setSpeed($cost) {
		return ceil($cost/100+($cost/100)*(rand(10, 50)/100));
	}
	public function setServiceCost($maxCost) {
		return round(rand(150, $maxCost), -1);
	}
	public function setProdVolume($key, $speed) {
		switch ($key) {
			case 0: // LOW
				$profit = [
				  ['maxCost' => 1, 'ver' => 12], // Low profit
				  ['maxCost' => 1.4, 'ver' => 10], // Medium
				  ['maxCost' => 2, 'ver' => 5], // High
				  ['maxCost' => 3, 'ver' => 1], // Overhigh
				];
				$days = array("120", "100", "80");
				return $speed*$days[array_rand($days)]*$profit[getRandomIndex($profit)]['maxCost'];
				break;	
			case 1: // MEDIUM
				$profit = [
				  ['maxCost' => 1, 'ver' => 12], // Low profit
				  ['maxCost' => 1.4, 'ver' => 10], // Medium
				  ['maxCost' => 2, 'ver' => 5], // High
				  ['maxCost' => 3, 'ver' => 1], // Overhigh
				];
				$days = array("70", "60", "50", "40");
				return $speed*$days[array_rand($days)]*$profit[getRandomIndex($profit)]['maxCost'];
				break;
			case 2: // FAST
				$profit = [
				  ['maxCost' => 1, 'ver' => 12], // Low profit
				  ['maxCost' => 1.4, 'ver' => 10], // Medium
				  ['maxCost' => 2, 'ver' => 5], // High
				  ['maxCost' => 3, 'ver' => 1], // Overhigh
				];
				$days = array("35", "20", "10");
				return $speed*$days[array_rand($days)]*$profit[getRandomIndex($profit)]['maxCost'];
				break;		
		}

	}
}
class User {
	private $connection;

	public function __construct($connection) {
		$this->connection = $connection;
	}
	public function getMoney($user_id) {
		$result = $this->connection->query("SELECT `money` FROM `users` WHERE `id` = '".$user_id."'");
		$money = $result->fetch_assoc();
		return $money["money"];
	}
	public function writeOffMoney($user_id, $money) {
		$this->connection->query("UPDATE `users` SET `money` = `money` - ".$money." WHERE `id` = '".$user_id."' LIMIT 1");
	}
}


// Load all user's ID
$users = [];
$result = $db->query("SELECT `user_id` FROM `user_objects`");
foreach ($result as $user) {
	array_push($users, $user['user_id']);
}
$users = array_unique($users);
// Calculate required fuel amount
foreach ($users as $key => $user) {
	// Decrease required fuel at user
	$requiredFuel = $Own->getRequiredFuelAmount($user);
	$storageFuel = $userStorage->getFuel($user);
	if ($storageFuel > $requiredFuel) {
		$Own->decreaseFuelAmount($user, $storageFuel - $requiredFuel);
		// Load all fegetables 
		$result = $db->query("SELECT `en_name`, `maturation`, `user_id` FROM `user_feg`");
		// Calculate the harvest
		foreach ($result as $feg) {
			if ($feg["maturation"] == 0) {
				if ($userStorage->getCapacity($feg["user_id"]) >= $userStorage->getFullness($feg["user_id"]) + 1) {
					$userStorage->increaseCapacity($feg["en_name"], $feg["user_id"]);
				}
			}
		}
	}
}


// Load all sawmills & research sawmills
$result = $db->query("SELECT `id`, `research`, `days`, `mining` FROM `sawmills`");
foreach ($result as $sawmill) {
	$sawmill_id = $sawmill["id"];
	if (($sawmill["research"] == true)&&($sawmill["days"] == 1)) {
		$serviceCost = [
		  ['maxCost' => 360, 'ver' => 7],
		  ['maxCost' => 550, 'ver' => 5],
		  ['maxCost' => 800, 'ver' => 3],
		  ['maxCost' => 1200, 'ver' => 2], 
		  ['maxCost' => 2500, 'ver' => 1], 
		];
		$cost = $Sawmills->setServiceCost($serviceCost[getRandomIndex($serviceCost)]['maxCost']);
		$speed = $Sawmills->setSpeed($cost);
		$volume = $Sawmills->setProdVolume(rand(0,2), $speed);
		if (0 < $cost && $cost <= 400) {
			$name = $Sawmills->namesLow[array_rand($Sawmills->namesLow)];
		} else if (401 <= $cost && $cost <= 900) {
			$name = $Sawmills->namesMedium[array_rand($Sawmills->namesMedium)];
		} else if (901 <= $cost && $cost <= 2500) {
			$name = $Sawmills->namesHigh[array_rand($Sawmills->namesHigh)];
		}
		// Send formed chr
		$db->query("UPDATE `sawmills` SET `name` = '$name', `research` = false, `speed` = '$speed', `service_cost` = '$cost', `prod_volume` = '$volume' WHERE `id` = '$sawmill_id' LIMIT 1");
	} else if (($sawmill["research"] == true)&&($sawmill["days"] > 1)) {
		$Sawmills->decreaseResearchDays($sawmill_id);
	}
	// Check mining status
	if ($sawmill["mining"] == true) {
		// Load all user's ID who mining
		$users = [];
		$result = $db->query("SELECT `user_id` FROM `sawmills` WHERE `mining` = true");
		foreach ($result as $user) {
			array_push($users, $user['user_id']);
		}
		$users = array_unique($users);
		foreach ($users as $key => $user) {
			// Check worked out status 
			if ($Sawmills->checkWorkedOut($sawmill_id)) {
				// Calculate required money
				$requiredMoney = $Sawmills->getRequiredMoney($user);
				$userMoney = $User->getMoney($user);
				// Check user money
				if ($userMoney > $requiredMoney) {
					// Calculate mined materials
					$materials = $Sawmills->getProduction($sawmill_id);
					// Accrue to column 'mined'
					$db->query("UPDATE `sawmills` SET `mined` = `mined` + $materials WHERE `id` = '$sawmill_id' LIMIT 1");
					// Increase materials in storage
					$userStorage->increaseMaterials($materials, $user);
					// Write off money
					$User->writeOffMoney($user, $requiredMoney);					
				}
			}
		}
	}
}


// Load information about season and days
$result = $db->query("SELECT `season`, `days` FROM `rules`");
foreach ($result as $rules) {
	$day = $rules["days"]; 
	if ($day > 1) {
		$dailyUpdate->reduceDays();
		// Load all fegetables
		$result = $db->query("SELECT `maturation`, `feg_id` FROM `user_feg`");
		// Calculate maturation
		foreach ($result as $feg) {
			if ($feg["maturation"] == 0) {
				continue;
			} else {
				$dailyUpdate->reduceMaturation($feg["feg_id"]);
			}
		}
	} else {
		// Load all fegetables
		$result = $db->query("SELECT `user_id` FROM `user_feg`");
		foreach ($result as $feg) {
			$dailyUpdate->removePlants($rules['season'], $feg['user_id']);
		}
		switch($rules['season']){  
	        case "summer": $dailyUpdate->updateSeason('autumn'); break;
	        case "spring": $dailyUpdate->updateSeason('summer'); break;
	        case "autumn": $dailyUpdate->updateSeason('winter'); break;
	    	default: $dailyUpdate->updateSeason('spring');               
    	}
 		// Calculate maturation
		foreach ($result as $feg) {
			if ($feg["maturation"] == 0) {
				continue;
			} else {
				$dailyUpdate->reduceMaturation($feg["feg_id"]);
			}
		}
	}
}


// Update fuel price 
$result = $db->query("SELECT `fuel`, `sales`, `purchases` FROM `rules`");
foreach($result as $rules) {
	if ((($rules["sales"] == 0) && ($rules["purchases"] == 0))|| $rules["fuel"] == 0) {
		$newPrice = $rules["fuel"]+20;
		// Write new fuel price in log for graphic
		$data[] = array(
			"timestamp" => $day,
			"fuelPrice" => $newPrice,
			"trend" => "up",
			"change" => 20
		);
		$inp = file_get_contents('graphic.json');
		$tempArray = json_decode($inp);
		array_push($tempArray, $data);
		$jsonData = json_encode($tempArray);
		file_put_contents('graphic.json', $jsonData);
		$db->query("UPDATE `rules` SET `fuel` = '$newPrice', `sales` = 0, `purchases` = 0");
	} else {
		$lastPrice = $rules["fuel"];
		$sales = $rules["sales"];
		$purchases = $rules["purchases"];
		if ($sales > $purchases) {
			$newPrice = round($dailyUpdate->setFuelPrice("down", round((($sales - $purchases)/($sales + $purchases))*100), $lastPrice));
			// Write new fuel price in log for graphic
			$data[] = array(
				"timestamp" => $day,
				"fuelPrice" => $newPrice,
				"trend" => "down",
				"change" => $lastPrice - $newPrice
			);
			$inp = file_get_contents('graphic.json');
			$tempArray = json_decode($inp);
			array_push($tempArray, $data);
			$jsonData = json_encode($tempArray);
			file_put_contents('graphic.json', $jsonData);
		} else {
			$newPrice = round($dailyUpdate->setFuelPrice("up", round((($purchases - $sales)/($sales + $purchases))*100), $lastPrice));
			// Write new fuel price in log for graphic
			$data[] = array(
				"timestamp" => $day,
				"fuelPrice" => $newPrice,
				"trend" => "up",
				"change" => $newPrice - $lastPrice
			);
			$inp = file_get_contents('graphic.json');
			$tempArray = json_decode($inp);
			array_push($tempArray, $data);
			$jsonData = json_encode($tempArray);
			file_put_contents('graphic.json', $jsonData);
		}
		// Update fuel price & zeroing sales and purchases
		$db->query("UPDATE `rules` SET `fuel` = '$newPrice', `sales` = 0, `purchases` = 0");
	}
}
$db->pdo=null;
echo 'Скрипт был выполнен за ' . (microtime(true) - $start) . ' секунд';
?>