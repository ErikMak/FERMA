<?php
	session_start();
	require_once 'db.php';
	// Writing log
	if ($_SESSION['user_data']) {
		$connection->insert("logs", [
			"timestamp" => date("H:i:s d-m-Y"),
			"user_id" => $_SESSION['user_data']['id'],
			"action" =>  $_SESSION['user_data']['username'].' вышел с аккаунта. IP: '.$_SERVER['REMOTE_ADDR']
		]);
	}
	unset($_SESSION['user_data']);
	unset($_SESSION['admin_data']);
	header('Location: ../home');
?>