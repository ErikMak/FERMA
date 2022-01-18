<?php
@session_start();

function top($title) {
echo '<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-UA-Compatible" content="ie-edge">
	<title>'.$title.'</title>
	<script src="/files/jquery-3.5.1.min.js"></script> <!--Jquery.min.js-->
	<link rel="stylesheet" href="/files/bootstrap.css"> <!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link rel="stylesheet" type="text/css" href="/files/toastr.min.css"> <!--Toasts-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"> <!--Bootstrap+Tables-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css"> <!--Bootstrap+Tables-->
	<link rel="stylesheet" href="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css"> <!--Graphics-->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> <!--Tables-->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> <!--Tables-->
	<script defer src="/files/icons.js"></script> <!--Icons-->
</head>
<body>
<div class="preloader">
  <svg class="preloader__image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path fill="currentColor"
      d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z">
    </path>
  </svg>
</div>';
}
function bottom() {
echo '</body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> <!--Bootstrap-->
	<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script> 
	<script src="/files/frontend.js"></script> 
	<script src="/files/toastr.min.js"></script> <!--Toasts-->
	<script>
  	$(window).on("load", function () {
    	$("body").addClass("loaded_hiding");
    		window.setTimeout(function () {
      			$("body").addClass("loaded");
      			$("body").removeClass("loaded_hiding");
    		}, 500);
  		});
	</script>
</html>';
}
function versionTag() {
	echo '<p class="version">Версия игрового мода: 0.32b</p>';
}

// Connecting db for all pages
require 'request/db.php';


$result = $connection->select("farms", "*", ["id" => $_SESSION['user_data']['id']]);
foreach($result as $farm) {
	$_SESSION['farm_data'] = [
		"id" => $farm['id'],
		"level" => $farm['level'],
		"exp" => $farm['exp'],
		"size" => $farm['size'],
		"products" => $farm['products'],
		"max_exp" => $farm['max_exp']
	];
}

if(isset($_GET["page"])){
	$password = 2;		
	$page = strval($_GET["page"]);
	if (is_numeric($page)) {
		setcookie("ref", $page, time()+3600);
		exit(header("Location: registration"));
	}
	else if ($_SESSION['admin_data']) {
		switch($page){ 
			case "admin/home": include("admin/home.php"); break;
			case "admin/logs": include("admin/logs.php"); break;
			case "admin/users": include("admin/users.php"); break;
			case "admin/admin-list": include("admin/admin-list.php"); break;
			case "admin/ban-list": include("admin/ban-list.php"); break;
		}
	}

	switch($page){
		case "trade": include("pages/trade.php"); break;
		case "forest": include("pages/forest.php"); break;
		case "shop": include("pages/shop.php"); break; 
		case "login": include("pages/login.php"); break;
		case "donate": include("pages/donate.php"); break;
		case "industry": include("pages/industry.php"); break;
		case "registration": include("pages/registration.php"); break;
		case "company": include("pages/company.php"); break;
		case "seed_shop": include("pages/seed_shop.php"); break;
		case "field": include("pages/field.php"); break;
		case "storage": include("pages/storage.php"); break;
		case "news": include("pages/news.php"); break;
		case "support": include("pages/support.php"); break;
		case "referal": include("pages/referal.php"); break;
		case "home": include("pages/home.php"); break;
		case "contracts": include("pages/contracts.php"); break;
		case "profile": include("pages/profile.php"); break;
		case "faq": include("pages/faq.php"); break;
		case "bonus": include("pages/bonus.php"); break;
	default: @include("pages/404.php");
	
	}
	
}else @include("pages/home.php");
?>