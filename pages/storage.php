<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Склад");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Склад компании</h4>
		<p>Вы находитесь на странице склада вашей компании. На склад приходит весь урожай с фермы, добытые ресурсы и произведенные товары. Вы можете тут же продать собранные предметы или приберечь до лучших времен. Склад имеет своё ограничение по вместимости. Улучшайте уровень склада, чтобы увеличить вместимость</p>
	</div>
	</main>
	<main style="background: #e74c3c; color: white;" class="danger-board">
		<div class="main-container info-board">
		<svg style="margin-right: 20px;" fill="white" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
		  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
		</svg>
		<p>Внимание! Поставка товаров прекращена, из-за нехватки свободного места. Очистите или улучшите склад</p>
	</div>
	</main>
	<main style="background: #F2B828; color: white;" class="warning-board">
    	<div class="main-container info-board">
    	<svg style="margin-right: 20px; float: left;" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    	</svg>
    	<p>Внимание! Поставка товаров скоро будет прекращена, из-за нехватки свободного места. Очистите или улучшите склад</p>
	</div>
	</main>
	<main>
	<div class="main-container storage-section">
		<div class="description">
			<p></p>
			<p style="margin-left: 3vw;">Название</p>
			<p style="margin-left: 3vw;">Тип</p>
			<p>Количество</p>
			<p style="margin-left: 2vw;">Действие</p>
		</div>
<?// Get products
$result = $connection->select("storage", ["salad", "cucumber", "potato", "turnip", "squash", "cauliflower", "corn", "tomato", "radish", "pepper", "eggplant", "beet", "pumpkin", "chin_cabbage", "artichoke", "material", "fuel"], ["user_id" => $_SESSION['user_data']['id']]);
foreach($result as $products) {
echo '<div class="item">
		<img src="img/salad.png">
		<p style="white-space: nowrap;">«Салат»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="salad">'.$products["salad"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="salad">Продать</button>
	</div>
	<div class="item">
		<img src="img/cucumber.png">
		<p style="white-space: nowrap;">«Огурец»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="cucumber">'.$products["cucumber"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="cucumber">Продать</button>
	</div>
	<div class="item">
		<img src="img/potato.png">
		<p style="white-space: nowrap;">«Картофель»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="potato">'.$products["potato"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="potato">Продать</button>
	</div>
	<div class="item">
		<img src="img/turnip.png">
		<p style="white-space: nowrap;">«Репа»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="turnip">'.$products["turnip"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="turnip">Продать</button>
	</div>
	<div class="item">
		<img src="img/squash.png">
		<p style="white-space: nowrap;">«Кабачок»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="squash">'.$products["squash"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="squash">Продать</button>
	</div>
	<div class="item">
		<img src="img/cauliflower.png">
		<p style="white-space: nowrap;">«Цветная капуста»</p>
		<p style="white-space: nowrap;">Весенний урожай</p>
		<b style="white-space: nowrap;" id="cauliflower">'.$products["cauliflower"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="cauliflower">Продать</button>
	</div>
	<div class="item">
		<img src="img/corn.png">
		<p style="white-space: nowrap;">«Кукуруза»</p>
		<p style="white-space: nowrap;">Летний урожай</p>
		<b style="white-space: nowrap;" id="corn">'.$products["corn"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="corn">Продать</button>
	</div>
	<div class="item">
		<img src="img/tomato.png">
		<p style="white-space: nowrap;">«Помидор»</p>
		<p style="white-space: nowrap;">Летний урожай</p>
		<b style="white-space: nowrap;" id="tomato">'.$products["tomato"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="tomato">Продать</button>
	</div>
	<div class="item">
		<img src="img/radish.png">
		<p style="white-space: nowrap;">«Редис»</p>
		<p style="white-space: nowrap;">Летний урожай</p>
		<b style="white-space: nowrap;" id="radish">'.$products["radish"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="radish">Продать</button>
	</div>
	<div class="item">
		<img src="img/pepper.png">
		<p style="white-space: nowrap;">«Перец»</p>
		<p style="white-space: nowrap;">Летний урожай</p>
		<b style="white-space: nowrap;" id="pepper">'.$products["pepper"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="pepper">Продать</button>
	</div>
	<div class="item">
		<img src="img/eggplant.png">
		<p style="white-space: nowrap;">«Баклажан»</p>
		<p style="white-space: nowrap;">Осенний урожай</p>
		<b style="white-space: nowrap;" id="eggplant">'.$products["eggplant"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="eggplant">Продать</button>
	</div>
	<div class="item">
		<img src="img/beet.png">
		<p style="white-space: nowrap;">«Свекла»</p>
		<p style="white-space: nowrap;">Осенний урожай</p>
		<b style="white-space: nowrap;" id="beet">'.$products["beet"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="beet">Продать</button>
	</div>
	<div class="item">
		<img src="img/pumpkin.png">
		<p style="white-space: nowrap;">«Тыква»</p>
		<p style="white-space: nowrap;">Осенний урожай</p>
		<b style="white-space: nowrap;" id="pumpkin">'.$products["pumpkin"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="pumpkin">Продать</button>
	</div>
	<div class="item">
		<img src="img/chin_cabbage.png">
		<p style="white-space: nowrap;">«Китайская капуста»</p>
		<p style="white-space: nowrap;">Осенний урожай</p>
		<b style="white-space: nowrap;" id="chin_cabbage">'.$products["chin_cabbage"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="chin_cabbage">Продать</button>
	</div>
	<div class="item">
		<img src="img/artichoke.png">
		<p style="white-space: nowrap;">«Артишок»</p>
		<p style="white-space: nowrap;">Осенний урожай</p>
		<b style="white-space: nowrap;" id="artichoke">'.$products["artichoke"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="artichoke">Продать</button>
	</div>
	<hr>
	<div class="item">
		<img src="img/materials.png">
		<p style="white-space: nowrap;">«Стройматериалы»</p>
		<p style="white-space: nowrap;">Материалы</p>
		<b style="white-space: nowrap;" id="material">'.$products["material"].' шт.</b>
		<button type="button" class="btn red-outline btn-sm" value="material">Продать</button>
	</div>
	<div class="item">
		<img src="img/oil.png">
		<p style="white-space: nowrap;">«Топливо»</p>
		<p style="white-space: nowrap;">Товар</p>
		<b style="white-space: nowrap;" id="fuel">'.$products["fuel"].' л.</b>
		<button type="button" class="btn red-outline btn-sm" value="fuel">Продать</button>
	</div>
	';
}?>
	</div>
	</main>
<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<div class="slider"><a href="#" class="plus"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg></a>
			<input class="form-control form-control-lg" style="width: 60%;" type="text">
			<a href="#" class="minus"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
			</svg></a>
			</div>
			<button type="button" id="question" style="font-weight: 500;" class="btn blue-outline btn-block">Подтвердить</button>
		</div>
	</div>
	<div class="popup-fade confirm">
	<div class="popup">
		<a href="#" title="Закрыть" class="popup-close">✕</a>
		<h5 style="margin: 0 0">Title</h5>
		<svg class="checkmark green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle green" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
	</div>
	</div>
	<div class="popup-fade error">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin: 0 0">Title</h5>
			<svg class="checkmark red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle red" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/></svg>
		</div>
	</div>
</div>
</div>
</div>
<script src="/scripts/selling.js"></script>
<script type="text/javascript">
	let filled = <?use Medoo\Medoo;
        $result = $connection->select("storage", ["field_sum" => Medoo::raw("salad + cucumber + potato + turnip + squash + cauliflower + corn + tomato + radish + pepper + eggplant + beet + pumpkin + chin_cabbage + artichoke + fuel + material")],  ["user_id" => $_SESSION['user_data']['id']]);
        foreach($result as $farm) { echo $farm["field_sum"]; }
        ?>;
    let size = <?
        $result = $connection->select("storage", ["capacity"], ["user_id" => $_SESSION['user_data']['id']]);
    foreach($result as $farm) { echo $farm['capacity']; }?>;
    if (size - filled == 0) {
    	$(".danger-board").css("display", "block");
    } else if (size - filled <= 21) {
    	$(".warning-board").css("display", "block");
    }
</script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>