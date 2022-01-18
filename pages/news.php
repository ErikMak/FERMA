<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Новости");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<main>
	<div class="main-container news-header">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Добро пожаловать!</h4>
		<p>Последние новости проекта</p>
	</div>
	<div class="main-container news-block">
		<div class="card" style="grid-column: 1/3">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Мы открылись!</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, error cum, dolorum, libero excepturi nulla voluptas distinctio quis, explicabo vitae</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
		<div class="card" style="grid-column: 1/3; grid-row-start: 2">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Мы открылись!</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, error cum, dolorum, libero excepturi nulla voluptas distinctio quis, explicabo vitae</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
		<div class="card" style="grid-row: 1/3;">
		  <img src="img/news/image.jpg" class="card-img-top">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Card with stretched link</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
	</div>
	<div class="main-container dev-news">
		<div class="header" style="grid-column: 1/4;"><h4>Новости разработки</h4></div>
		<div class="card" style="background: #0F0F0F;">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Мы открылись!</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, error cum, dolorum, libero excepturi nulla voluptas distinctio quis, explicabo vitae</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
		<div class="card" style="background: #0F0F0F;">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Мы открылись!</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, error cum, dolorum, libero excepturi nulla voluptas distinctio quis, explicabo vitae</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
		<div class="card" style="background: #0F0F0F;">
		  <div class="card-body">
		    <h5 class="card-title" style="text-decoration: underline;">Card with stretched link</h5>
		    <p class="card-text" style="margin-bottom: 6px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		    	<a href="#" class="stretched-link"><small><b>27 июля 2021</b></small></a>
		  </div>
		</div>
	</div>
	<div class="main-container fuel-block">
		<div class="header" style="grid-column: 1/4;"><h4>Топливная биржа</h4></div>
		<div class="field" style="grid-column: 1/3;">
		  <div class="ct-chart ct-golden-section"></div>
		</div>
		<div class="field" style="grid-column: 3/3;">
		  <b>Информация на <?echo date("d.m.Y")?>:</b>
		  <div class="info" style="padding-top: 10px;">
		  	<p>Тенденция</p><p class="trend">trend</p>
		  </div>
		  <div class="info">
		  	<p>Изменение:</p><p class="change">+50</p>
		  </div>
		  <div class="info" style="margin-bottom: 15px;">
		  	<p>Стоимость за л.</p><p><i id="price" style="font-style: normal;"><?
		  		$result = $connection->select("rules", ["fuel"]);
		  		foreach($result as $fuel) {
		  			echo $fuel["fuel"];
		  		}
		  	?></i>$</p>
		  </div>
		  <div class="form-group">
		    <input class="form-control" id="quantity" placeholder="Количество">
		    <small class="form-text text-muted">Топливо будет добавлено на склад</small>
		  </div>
		  <fieldset disabled><input class="form-control" type="text" placeholder="" id="finalPrice"></fieldset>
		  <div class="info" style="margin-top: 15px;">
		  	<button type="button" class="btn green-outline btn-block" id="purchase">Приобрести</button>
		  </div>
		</div>
	</div>
	</main>
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
<script src="/scripts/burse.js?123"></script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>