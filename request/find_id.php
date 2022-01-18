<?php
require_once 'db.php';

if (isset($_POST['username'])&&$_POST['username']!="") {
	$username = filter_var(trim($_POST['username']),
	FILTER_SANITIZE_STRING);
// Get information about user
		$result = $connection->select("users", ["id", "user", "timestamp"], ["user[~]" => $username]);
		if (empty($result)) {
			echo '<p style="margin: 10px;">Пользователи с таким ником не найдены!</p>';
		} else {
			foreach($result as $log) {
				echo '<tr>
			      		<td><b>'.$log["id"].'</b></td>
			      		<td>'.$log["user"].'</td>
			      		<td>'.$log["timestamp"].'</td>
			    	</tr>';
			}
		}

} else {
	echo '<p style="margin: 10px;">Серверная ошибка!</p>';
}
$connection->pdo=null;
?>