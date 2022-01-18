<?
$db = @new mysqli('localhost', 'root', 'root', 'game');
$Fuel = new Fuel();

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

class Fuel {
	public function setFuelPrice($trend, $percent, $lastPrice) {
		switch ($trend) {
			case "up":
				return $lastPrice + ($lastPrice/100)*$percent;
				break;
			case "down":
				return $lastPrice + ($lastPrice/100)*$percent;
				break;
		}
	}
}

// Load fuel data
$result = $db->query("SELECT `fuel`, `sales`, `purchases` FROM `rules`");
foreach($result as $rules) {
	$lastPrice = $rules["fuel"];
	$sales = $rules["sales"];
	$purchases = $rules["purchases"];
	if ($sales - $purchases > 0) {
		$newPrice = round($Fuel->setFuelPrice("down", round((($sales - $purchases)/($sales + $purchases))*100), $lastPrice));
		// Write new fuel price in log for graphic
		$data[] = array(
			"timestamp" => 12,
			"fuelPrice" => $newPrice,
			"trend" => "down",
			"change" => $lastPrice - $newPrice
		);
		$inp = file_get_contents('../graphic.json');
		$tempArray = json_decode($inp);
		array_push($tempArray, $data);
		$jsonData = json_encode($tempArray);
		file_put_contents('../graphic.json', $jsonData);
	} else {
		$newPrice = round($Fuel->setFuelPrice("up", round((($purchases - $sales)/($sales + $purchases))*100), $lastPrice));
		// Write new fuel price in log for graphic
		$data[] = array(
			"timestamp" => 12,
			"fuelPrice" => $newPrice,
			"trend" => "up",
			"change" => $newPrice - $lastPrice
		);
		$inp = file_get_contents('../graphic.json');
		$tempArray = json_decode($inp);
		array_push($tempArray, $data);
		$jsonData = json_encode($tempArray);
		file_put_contents('../graphic.json', $jsonData);
	}
	$db->query("UPDATE `rules` SET `fuel` = '$newPrice'");
}
?>