<?
require_once 'db.php';

if (isset($_POST['item_id'])&&$_POST['item_id']!="") {
	$item_id = decrypt($_POST['item_id']);
	// Load Characteristic
	$result = $connection->select("sawmills", ["id", "speed", "service_cost", "prod_volume"], ["id" => $item_id, "LIMIT" => 1]);
	foreach($result as $Chr) {
		$response = [
			"title" => "Характеристики участка #".$Chr['id'],
			"text" => "● Скорость добычи - <b style='font-size: 16px;'>".$Chr['speed']."</b> ед. в день<hr>● Стоимость обслуживания - <b style='font-size: 16px;'>".$Chr['service_cost']."</b> $ в день<hr>● Объем добычи - <b style='font-size: 16px;'>".$Chr['prod_volume']."</b> мат.",
		];
		echo json_encode($response);
	}
}
$connection->pdo=null;
?>