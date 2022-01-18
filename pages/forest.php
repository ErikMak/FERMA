<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Добыча леса");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper" style="margin-bottom: 50px;">
	<ul class="nav nav-pills" id="pills-tab" role="tablist" style="margin-bottom: 30px">
	  <li class="nav-item" role="presentation">
	    <button class="active" style="margin-right: 13px;" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Статистика</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button style="margin-right: 13px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Участки</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Добыча</button>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  <!-- Первая страница -->
	  	<main>
		<div class="main-container section_column">
			<h4 style="font-size: 22px; margin-bottom: 10px;">Лесодобывающие предприятия</h4>
			<p>Позволяют добывать стройматериалы. Подробнее о системе лесодобывающих предприятий можно узнать на страницах <a href="faq"><b style="text-decoration: underline;">справочника</b></a> в разделе «Добыча леса».</p>
		</div>
		</main>
		<? $count = $connection->count("sawmills", [
			"user_id" => $_SESSION["user_data"]["id"]
		]);


		$result = $connection->select("sawmills", ["speed", "prod_volume", "mined", "service_cost"], ["user_id" => $_SESSION['user_data']['id']]);
  		$speed = 0;
  		$prod_volume = 0;
  		$mined = 0;
  		$cost = 0;
  		foreach ($result as $sawmills) {
  			$speed+=$sawmills["speed"];
  			$prod_volume+=$sawmills["prod_volume"];
  			$mined+=$sawmills["mined"];
  			$cost+=$sawmills["service_cost"];
  		}

		if ($count == 0) {
			echo '<main style="background: #2634a1; color: white">
		<div class="main-container info-board">
		<svg xmlns="http://www.w3.org/2000/svg" fill="white" width="32px" height="32px" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16" style="margin-right: 20px;">
		  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
		</svg>
		<p>На данный момент у вас нет ни одной шахты. Чтобы начать добычу ресурсов проведите исследование местности!</p>
		</div>
		</main>';
		}?>
		<main>
			<div class="main-container section_column mine_statistics">
				<div class="icon">
					<p style="font-size: 12px;">Лесодобывающих предприятий</p>
					<b><h3 style="margin: 0"><?echo $count?></h3></b>
				</div>
			<div style="width: 100%">
				<small>Объем добытой продукции:</small>
				<div class="progress" style="height: 10px; margin-bottom: 14px">
				  <div class="progress-bar" role="progressbar" style="background-color: #f82956;  width: <?echo round($mined/$prod_volume*100)?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="sections">
					<div class="item" style="border-right: 2px solid #ebebeb;"><h2><b><?echo number_format($prod_volume * 100)?>$ <span data-tooltip="Объем продукции всех лесопилок умноженный на стоимость продажи"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle mb-1" viewBox="0 0 16 16">
  					<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  					<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
					</svg></span></b>
					</h2><p style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>Оценочная стоимость<br>продукции</b></p></div>

					<div class="item" style="border-right: 2px solid #ebebeb; margin-left: 40px;"><h2><b><?
		      		echo $speed;
					?></b></h2><p style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>Скорость добычи <br>ед. в дн</b></p></div>

					<div class="item" style="margin-left: 40px;"><h2><b><?
					if ($mined > $prod_volume) {
						echo 0;
					} else {
						echo $prod_volume-$mined;
					}
					?></b></h2><p style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>Осталось добыть<br>ед.</b></p></div>
				</div>
			</div>
			</div>
		</main>
		<div class="container">
		  <div class="row">
		    <div class="col-sm" style="padding-left: 0">
		      <main id="card_pattern" style="color: white">
		      	<div class="d-flex flex-column p-3">
		      		<p class="mb-2" style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>Затраты</b></p>
		      		<img class="img-fluid mb-2" style="width: 20%" src="/icons/money-bag.png">
		      		<h4><b><?echo number_format($cost);?>$</b><p style="font-size: 15px">в дн</p></h4>
		      	</div>
		      </main>
		    </div>
		    <div class="col-sm">
		    </div>
		    <div class="col-sm">
		    </div>
		    <div class="col-sm">
		    </div>
		  </div>
		</div>
	  </div>
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
	  	<!-- Вторая страница -->
	  	<main>
		<div class="main-container section_column">
			<h4 style="font-size: 22px; margin-bottom: 10px;">Участки добычи</h4>
			<p style="margin-bottom: 15px;">Изучайте местность, чтобы найти подходящие локации добычи лесных ресурсов.</p>
			<div class="map" style="border: 2px black solid">
				<main style="width: 50%">
				<div class="main-container section_column">
					<h5 style=" margin-bottom: 10px;">Провести исследование</h5>
					<p style=" margin-bottom: 15px;">Провести исследование местности стоимостью 10000$. Срок выполнения работы - 8 дней</p>
					<button type="button" id="order" class="btn btn-outline-secondary">Заказать исследование</button>
				</div>
				</main>
			</div>
		</div>
		</main>
		<main style="color: white; background: #1A1A1A;">
			<div class="main-container section_column" style="padding: 20px;">
				<h6 style="margin: 0">Мои исследования</h6>
			</div>
		</main>
			<?
			$result = $connection->select("sawmills", ["id", "research", "name", "mining", "days"], ["user_id" => $_SESSION['user_data']['id']]);
			foreach($result as $item) {
				if (($item['research'] == true) && ($item['mining'] == false)) {
					echo '<main style="margin-bottom: 10px"><div class="sawmill_item research" id="'.encrypt($item["id"]).'">
				<div class="d-flex flex-column"><small>номер</small><b>#'.$item["id"].'</b></div>
				<img src="img/forest.png">
				<div class="d-flex flex-column text-center"><small>название</small><p style="white-space: nowrap;">«Участок добычи»</p></div>
				<div class="d-flex flex-column text-center"><small>статус</small><p style="white-space: nowrap;">Исследуется</p></div>
				<div class="d-flex flex-column text-center"><small>дней</small><b style="white-space: nowrap;">'.$item["days"].' дн.</b></div>
				<div class="d-flex flex-column text-center"><small>действие</small><a href="#"  class="delete">Удалить</a></div>
			</div></main>';
				} else if (($item['research'] == false) && ($item['mining'] == false)) {
					echo '<main style="margin-bottom: 10px"><div class="sawmill_item research" id="'.encrypt($item["id"]).'">
				<div class="d-flex flex-column"><small>номер</small><b>#'.$item["id"].'</b></div>
				<img src="img/forest.png">
				<div class="d-flex flex-column text-center"><small>название</small><p style="white-space: nowrap;">«'.$item["name"].'»</p></div>
				<div class="d-flex flex-column text-center"><small>статус</small><p style="white-space: nowrap;">Исследован <span class="badge badge-pill badge-danger">new</span></p></div>
				<div class="d-flex flex-column text-center"><small>характеристика</small><a href="#" class="show">Показать</a></div>
				<div class="d-flex flex-column text-center"><small>действие</small><div class="d-flex justify-content-center"><a style="margin-right: 10px;" href="#" class="start">Добывать </a><a href="#" class="delete-research">Удалить</a></div></div>
				</div></main>';
				}
			}
			?>
	  </div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
	  	<!-- Третья страница -->
		<main style="color: white; background: #1A1A1A;">
			<div class="main-container section_column" style="padding: 20px;">
				<h6 style="margin: 0">Лесодобывающие предприятия</h6>
			</div>
		</main>
		<?  $result = $connection->select("sawmills", ["id", "speed", "name", "mining", "mined", "service_cost", "prod_volume"], ["user_id" => $_SESSION['user_data']['id']]);
			foreach($result as $item) {
			if ($item['mining'] == true) {
				if ($item["mined"] >= $item["prod_volume"]) { 
			echo '<main style="margin-bottom: 10px"><div class="sawmill_item mining" id="'.encrypt($item["id"]).'">
			<div class="d-flex flex-column"><small>номер</small><b>#'.$item["id"].'</b></div>
			<img src="img/sawmill.png">
			<div class="d-flex flex-column text-center"><small>название</small><p style="white-space: nowrap;">«'.$item["name"].'» <span class="badge badge-pill badge-danger">new</span></p></div>
			<div class="d-flex flex-column text-center"><small>скорость добычи</small><p style="white-space: nowrap;"><b>0</b> ед. в дн</p></div>
			<div class="d-flex flex-column text-center"><small>обслуживание</small><p><b style="white-space: nowrap;">0$</b> в дн</p></div>
			<div class="d-flex flex-column text-center"><small>объем добычи</small><div class="progress">
			  <div class="progress-bar bg-success" role="progressbar" style="width:100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Выработано!</div>
			</div></div>
			<div class="d-flex flex-column text-center"><small>действие</small><a href="#" class="delete">Удалить</a></div>
			</div></main>';
				} else {
			echo '<main style="margin-bottom: 10px"><div class="sawmill_item mining" id="'.encrypt($item["id"]).'">
			<div class="d-flex flex-column"><small>номер</small><b>#'.$item["id"].'</b></div>
			<img src="img/sawmill.png">
			<div class="d-flex flex-column text-center"><small>название</small><p style="white-space: nowrap;">«'.$item["name"].'»</p></div>
			<div class="d-flex flex-column text-center"><small>скорость добычи</small><p style="white-space: nowrap;"><b>'.$item["speed"].'</b> ед. в дн</p></div>
			<div class="d-flex flex-column text-center"><small>обслуживание</small><p><b style="white-space: nowrap;">'.$item["service_cost"].'$</b> в дн</p></div>
			<div class="d-flex flex-column text-center"><small>объем добычи</small><div class="progress">
			  <div class="progress-bar bg-success" data-tooltip="'.$item["mined"].' ед. из '.$item["prod_volume"].' ед." role="progressbar" style="width: '.round(($item["mined"]/$item["prod_volume"])*100).'%;" aria-valuenow="'.$item["mined"].'" aria-valuemin="0" aria-valuemax="'.$item["prod_volume"].'"></div>
			</div></div>
			<div class="d-flex flex-column text-center"><small>действие</small><a href="#" class="delete">Удалить</a></div>
			</div></main>';}}}?>
	  </div>
	</div>
	<div class="popup-fade info">
	<div class="popup">
		<a href="#" title="Закрыть" class="popup-close">✕</a>
		<h5 style="margin-bottom: 20px;">Title</h5>
		<p style="margin-bottom: 20px;">Text</p>
	</div>
	</div>
	<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<button type="button" id="question" class="btn btn-outline-primary btn-block">Да</button>
		</div>
	</div>
	<div id="tooltip"></div>
</div>
</div>
</div>
<script src="/scripts/mining.js"></script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>