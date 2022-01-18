<?php
require_once 'db.php';
if (isset($_POST['user_id'])&&$_POST['user_id']!="") {
	$user_id = filter_var(trim($_POST['user_id']),
	FILTER_SANITIZE_STRING);
	$checkbox = filter_var($_POST['checkbox'], FILTER_VALIDATE_BOOLEAN);

// Get information about user
	if ($checkbox) {
		$result = $connection->select("logs", "*", ["user_id" => $user_id, "ORDER" => [ "id" => "DESC"], "LIMIT" => 100]);
		if (empty($result)) {
			echo '<p style="margin: 10px;">Пользователь не найден!</p>';
		} else {
			foreach($result as $log) {
				echo '<tr>
			      		<td>'.$log["timestamp"].'</td>
			      		<td>'.$log["action"].'</td>
			    	</tr>';
			}
		}
	} else {
		$result = $connection->select("logs", "*", ["user_id" => $user_id, "ORDER" => [ "id" => "DESC"]]);
		if (empty($result)) {
			echo '<p style="margin: 10px;">Пользователь не найден!</p>';
		} else {
			foreach($result as $log) {
				echo '<tr>
			      		<td>'.$log["timestamp"].'</td>
			      		<td>'.$log["action"].'</td>
			    	</tr>';
			}
		}
	}

} else {
	echo '<p style="margin: 10px;">Серверная ошибка!</p>';
}
$connection->pdo=null;
?>