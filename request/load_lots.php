<?
require_once 'db.php';

if (isset($_POST['category'])&&$_POST['category']!="") {
	$category = filter_var(trim($_POST['category']),
	FILTER_SANITIZE_STRING);
	$checkbox = filter_var($_POST['checkbox'], FILTER_VALIDATE_BOOLEAN);

function withdrawLot($lot) {
	echo '<tr>
      <td style="line-height: 30px;"><b>'.$lot["id"].'</b></td>
      <td style="line-height: 30px;">'.$lot["productNameRU"].'</td>
      <td style="line-height: 30px; text-align: center;">'.$lot["quantity"].' шт.</td>
      <td style="line-height: 30px; text-align: center; color: #659b25"><b>'.$lot["lotPrice"].' $</b></td>
      <td style="line-height: 30px;"><button type="submit" class="btn blue-outline btn-block btn-sm" id="'.$lot["id"].'">Купить</button></td></tr>';
}
function withdrawNull() {
	echo '<p style="margin: 10px;">Лотов не найдено!</p>';
}
// Load lot
	if ($category == "spring") {
		if ($checkbox) {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["salad", "cucumber", "potato", "turnip", "squash", "cauliflower"], "ORDER" => ["lotPrice" => "ASC"]]);
		} else {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["salad", "cucumber", "potato", "turnip", "squash", "cauliflower"]]);
		}
		if (empty($result)) {
			withdrawNull();
		} else {
			foreach ($result as $lot) {
				withdrawLot($lot);
			}
		}
	} else if ($category == "summer") {
		if ($checkbox) {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["corn", "tomato", "radish", "pepper"], "ORDER" => ["lotPrice" => "ASC"]]);
		} else {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["corn", "tomato", "radish", "pepper"]]);
		}
		if (empty($result)) {
			withdrawNull();
		} else {
			foreach ($result as $lot) {
				withdrawLot($lot);
			}
		}
	} else if ($category == "autumn") {
		if ($checkbox) {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["eggplant", "beet", "pumpkin", "chin_cabbage", "artichoke"], "ORDER" => ["lotPrice" => "ASC"]]);
		} else {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => ["eggplant", "beet", "pumpkin", "chin_cabbage", "artichoke"]]);
		}
		if (empty($result)) {
			withdrawNull();
		} else {
			foreach ($result as $lot) {
				withdrawLot($lot);
			}
		}
	} else if ($category == "material") {
		if ($checkbox) {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => "material", "ORDER" => ["lotPrice" => "ASC"]]);
		} else {
			$result = $connection->select("marketplace", ["id", "user_id", "productNameRU", "quantity", "lotPrice"], ["productName" => "material"]);
		}
		if (empty($result)) {
			withdrawNull();
		} else {
			foreach ($result as $lot) {
				withdrawLot($lot);
			}
		}
	}
}
$connection->pdo=null;
?>