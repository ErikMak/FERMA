<?php
	if($_SESSION['user_data']) {
		header('Location: news');
	}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-UA-Compatible" content="ie-edge">
	<title>Главная</title>
	<script src="/files/jquery-3.5.1.min.js"></script> <!--Jquery.min.js-->
	<script defer src="/files/icons.js"></script> <!--Icons-->
	<link rel="stylesheet" href="/files/bootstrap.css"> <!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link href="/vidbg.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="home">
	<?php include "inc/home_header.php";
	?>
	<div class="content-wrapper">
		<div class="background" style="width: 100%;height: 300px; background-color: blue">
			<div class="text-box">
	 			<b style="font-size: 40px; color: white; font-family: 'NoirPro', sans-serif;">Добро пожаловать!</b>
	 			<p style="font-size: 20px; color: white; font-family: 'NoirPro', sans-serif;">Экономическая браузерная игра Ferma.ru</p>
	 			<div class="links">
	 				<a href="#description" style="font-size: 15px; color: #D8D8D8; font-family: 'Open Sans', sans-serif;margin-bottom: 8px"><i style="font-size:  12px;" class="fas fa-chevron-right"></i> Описание</a>
 					<a href="#quality" style="font-size: 15px; color: #D8D8D8; font-family: 'Open Sans', sans-serif; margin-bottom: 8px"><i style="font-size:  12px;" class="fas fa-chevron-right"></i> Особенности</a>
 					<a href="#gameplay" style="font-size: 15px; color: #D8D8D8; font-family: 'Open Sans', sans-serif;"><i style="font-size:  12px;" class="fas fa-chevron-right"></i> Игра</a>
 				</div>
    	 	</div>
    	 	<img id="veg-bg" src="/wheat-bg.png">
		</div>
	<main>
		<div class="main-container statistic">
		<?
		// GET SEASON & PLAYERS & OBJECTS
		    require_once 'request/db.php';
		    $result = $connection->select("rules", ["season"]);
		    foreach($result as $rules) {
		        $season = $rules['season'];
		    }
		    $users = $connection->count("users");
		    $objects = $connection->count("objects");
		?> 
			<table class="table-striped">
			<tbody>
				<tr>
				<td>Время:</td>
				<td><p id="clock" style="font-family: 'Cairo', sans-serif;"></p></td>
			  </tr>
			  <tr>
				<td>Сезон:</td>
				<td><b><?
                    switch($season){  
                        case "summer": echo 'Лето'; break;
                        case "spring": echo 'Весна'; break;
                        case "autumn": echo 'Осень'; break; 
                    default: echo 'Зима';
                    
                    }
                ?></b></td>
			  </tr>
			  <tr>
				<td>Игроков:</td>
				<td><p style="font-family: 'Cairo', sans-serif;"><?echo $users?></p></td>
			  </tr>
			  <tr>
				<td>Объектов:</td>
				<td><p style="font-family: 'Cairo', sans-serif;"><?echo $objects?></p></td>
			  </tr>
			</tbody>
			</table>
			<div class="card">
				<div class="d-flex justify-content-between"><h5 style="font-family: 'NoirPro';">Обновления</h5><a style="color: white"href="https://vk.com/realrussiaofficial"><i style="margin-top: 5px;" class="fas fa-external-link"></i></a></div>
				  <div class="row">
				    <div class="col-2">
				      12.08.2021
				    </div>
				    <div class="col">
				      Добавлена новая главная страница. Системные обновления ввырвыов ыаотывоарво аыовароыва выароывраоыв авыоарывр ыаиров
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-2">
				      12.08.2021
				    </div>
				    <div class="col">
				      Добавлена новая главная страница. Системные обновления ввырвыов ыаотывоарво аыовароыва выароывраоыв авыоарывр ыаиров
				    </div>
				  </div>
			</div>
		</div>
		<div class="main-container description">
			  <div class="row">
			    <div class="col-sm justify-content-start flex-column" style="text-align: left;">
			      <h3 id="description" style="font-size: 22px; text-transform: uppercase;" class="mb-4"><b>Описание проекта</b></h3>
			      <p>
			      Ferma - многопользовательская экономическая браузерная игра с множеством уникальных систем. Хотели возглавить свою компанию и занять лидирующую позицию на рынке? Здесь все возможно. Развивайте виртуальную компанию в одной из нескольких сфер деятельности. Контролируйте поставку товаров, производство и продажи на торговой площадке.</p>
					<button onclick="location.href = 'registration';" type="button" style="width: fit-content;" class="btn btn-play mt-4">Играть</button>
			    </div>
			    <div class="col-sm">
			      <img src="/img/business-man.webp" style="width:20em">
			    </div>
			  </div>
		</div>
		<div class="main-container quality">
			<h3 id="quality" style="font-size: 22px; text-transform: uppercase; margin-bottom: 1.5em;"><b>Основные качества</b></h3>
			  <div class="row" style="font-family: 'NoirPro', sans-serif;">
			    <div class="col-sm">
			    	<div>
			      		<img src="icons/seeding.svg" style="height: 4em;width: 4em; margin-bottom: 10px;"><p>Интересные<br>системы</p>
			  		</div>
			    </div>
			    <div class="col-sm">
			    	<div>
			      		<img src="icons/money-bag.svg" style="height: 4em;width: 4em; margin-bottom: 10px;"><p>Внутренний<br>рынок</p>
			      	</div>
			    </div>
			    <div class="col-sm">
			    	<div>
			      		<img src="icons/graph.svg" style="height: 4em;width: 4em; margin-bottom: 10px;"><p>Продуманная<br>экономика</p>
			      	</div>
			    </div>
			    <div class="col-sm">
			    	<div>
			      		<img src="icons/refresh.svg" style="height: 4em;width: 4em; margin-bottom: 10px;"><p>Регулярные<br>обновления</p>
			      	</div>
			    </div>
			  </div>
		</div>
		<div class="main-container activity">
			<h3 id="gameplay" style="font-size: 22px; text-transform: uppercase; margin-bottom: 1.5em;"><b>Сферы деятельности</b></h3>
			<div class="d-flex justify-content-between">
			<div class="d-flex flex-column">
			  <div class="mb-3 d-flex">
			  	<img src="/img/agriculture.png" style="border-radius: 50%; height: 3.5em;width: 3.5em; margin-right: 20px">
			  	<div>
			  		<h5 style="font-family: 'NoirPro';margin:0">Сельское хозяйство</h5>
			  		<b style="font-size:  14px ;color: #b59c39">Выращивайте сезонный урожай, торгуйте им<br> на внутреннем рынке</b>
			  	</div>
			  </div>
			  <div class="mb-3 d-flex">
			  	<img src="/img/mining.png" style="border-radius: 50%; height: 3.5em;width: 3.5em; margin-right: 20px">
			  	<div>
			  		<h5 style="font-family: 'NoirPro';margin:0">Добыча ресурсов</h5>
			  		<b style="font-size:  14px ;color: #b59c39">Исследуйте местность, открывайте новые локации добычи <br>ресурсов, стройте добывающие предприятия</b>
			  	</div>
			  </div>
			</div>
			<div class="d-flex flex-column">
			  <div class="mb-3 d-flex">
			  	<img src="/img/factory.png" style="border-radius: 50%; height: 3.5em;width: 3.5em; margin-right: 20px">
			  	<div>
			  		<h5 style="font-family: 'NoirPro';margin:0">Производство</h5>
			  		<b style="font-size:  14px ;color: #b59c39">Скупайте сырье и ресурсы, производите товары для продажи на <br>внутреннем рынке</b>
			  	</div>
			  </div>
			  <div class="mb-3 d-flex">
			  	<img src="/img/bussiness.png" style="border-radius: 50%; height: 3.5em;width: 3.5em; margin-right: 20px">
			  	<div>
			  		<h5 style="font-family: 'NoirPro';margin:0">Торговля</h5>
			  		<b style="font-size:  14px ;color: #b59c39">Покупайте продукцию производств и продавайте в своих<br> магазинах</b>
			  	</div>
			  </div>
			</div>
			</div>
		  </div>
		  <div class="main-container description">
			  <div class="row">
			  	<div class="col-3">
			      <img src="/img/coffee-girl.png" style="width:10em">
			    </div>
			    <div class="col-sm justify-content-start flex-column" style="text-align: left;">
			      <p>Проект активно поддерживается разработчиками и регулярно дополняется новыми игровыми механиками. Следите за разработкой в официальной группе проекта в социальной сети Вконтакте, чтобы ничего не пропустить!
			      </p>
			      <button onclick="location.href = 'https://vk.com/realrussiaofficial';" type="button" style="width: fit-content;" class="btn btn-join mt-4">Вступить</button>
			    </div>
			  </div>
		  </div>
		</div>
	</main>
	</div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
	$(".text-box").on("click","a", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
			top = $(id).offset().top;
		$('body,html').animate({scrollTop: top}, 1500);
	});
});
function clock(){
    var date = new Date(),
        hours = (date.getHours() < 10) ? '0' + date.getHours() : date.getHours(),
        minutes = (date.getMinutes() < 10) ? '0' + date.getMinutes() : date.getMinutes(),
        seconds = (date.getSeconds() < 10) ? '0' + date.getSeconds() : date.getSeconds();
    document.getElementById("clock").innerHTML = hours + ':' + minutes;
}
setInterval(clock, 1000);
</script>
<!-- Footer -->
<?php include "inc/footer.php";
	?>
<? bottom();
?>