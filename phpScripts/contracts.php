<?
	$connection = @new mysqli('localhost', 'root', 'root', 'game');

	$Contract = new Contract();

	$result = $connection->query("SELECT * FROM `rules`");
    $rules = $result->fetch_assoc();
    $season = $rules['season'];

	class Contract {
		// SETTINGS
		const max_quantity = 10;
		const add_money = 5000;
		const multiplier = 3;
		const season_bonus = 1.5;

		public $store = array(
			array("Ресторан", 4),
			array("Пиццерия", 4),
			array("Бар", 3),
			array("Шашлычная", 3),
			array("Фаст-фуд", 3),
			array("Кафетерий", 2),
			array("Кафе", 2),
			array("Таверна", 1),
			array("Бистро", 1),
		);

		public $images = array(
			'/img/food/cake.png',
			'/img/food/chin_food.png',
			'/img/food/cutlets.png',
			'/img/food/fast_food.png',
			'/img/food/hamburgers.png',
			'/img/food/kebab.png',
			'/img/food/meat.png',
			'/img/food/pita.png',
			'/img/food/pizza.png',
			'/img/food/pizza_2.png',
			'/img/food/ribs.png',
			'/img/food/salad.png',
			'/img/food/soup.png',
			'/img/food/tacos.png',
		);
		public $products = array(
			array("salad", "spring", 35, 'Салат'),
			array("cucumber", "spring", 110, 'Огурец'),
			array("potato", "spring", 80, 'Картофель'),
			array("turnip", "spring", 330, 'Репа'),
			array("squash", "spring", 220, 'Кабачок'),
			array("cauliflower", "spring", 175, 'Цветная капуста'),
			array("corn", "summer", 300, 'Кукуруза'),
			array("tomato", "summer", 60, 'Томат'),
			array("radish", "summer", 180, 'Редис'),
			array("pepper", "summer", 390, 'Перец'),
			array("eggplant", "autumn", 60, 'Баклажан'),
			array("beet", "autumn", 120, 'Свекла'),
			array("pumpkin", "autumn", 450, 'Тыква'),
			array("chin_cabbage", "autumn", 80, 'Китайская капуста'),
			array("artichoke", "autumn", 160, 'Артишок')
		);

		public function setContract($count, $products) {						
			$numbers = [];						
			$item = array();						
			while (count($numbers) < $count) $numbers[$numb] = ($numb = array_rand($products));
			$values = array_values($numbers);
			for($x=0; $x!=$count; $x++) {			
				$item[$x]['name'] = $products[$values[$x]][0];
				$item[$x]['ru_name'] = $products[$values[$x]][3];
				$item[$x]['price'] = $products[$values[$x]][2];
				$item[$x]['season'] = $products[$values[$x]][1];
			}
			usort($item, function($a, $b) { 
				return ($b['price'] - $a['price']);
			});
			$quantity = rand(1, Contract::max_quantity);	
			for($x=0; $x!=$count; $x++) {	
				$item[$x]['quantity'] = $quantity;
				if ($item[$x]['season'] != $rules['season']) {
					$payment += $item[$x]['price'] * $item[$x]['quantity'] * Contract::season_bonus;
				} else {
					$payment += $item[$x]['price'] * $item[$x]['quantity'];
				}
				$quantity = $quantity * rand(1, Contract::multiplier);
			}
			array_push($item, round($payment/100));
			return serialize($item);
		}
	}
	// Writing to the database 
	$connection->query("DELETE FROM `contracts`");
	for($i=0; $i<=10; $i++) {
		$rand_key = array_rand($Contract->store);
		$connection->query("INSERT INTO `contracts` (`store_name`, `item`, `image`) VALUES('".$Contract->store[$rand_key][0]."', '".$Contract->setContract($Contract->store[$rand_key][1], $Contract->products)."', '".$Contract->images[(array_rand($Contract->images))]."')");
	}
	$connection->pdo=null;
?>