<?php
	session_start();
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Донат");
?>
<div id="main">
	<?php require "inc/header.php";
	?>
<div class="wrapper">
	<?php require "inc/sidebar.php";
	?>	
<div class="content-wrapper">
	<main class="donate d-flex">
		<div class="bg"></div>
		<div>
			<div class="main-container section_column">
				<h5>Краудфандинг</h5>
				<p class="mb-2">Поддержи любимый проект! Пожертвуй любую сумму от 150 рублей и получи уникальные возможности:</p>
				<div class="characteristics"><b>Дополнительные преимущества</b>
					<p><b>150 </b><i style="font-size: 13px;" class="fas fa-ruble-sign"></i> Статус VIP проекта с доступом к экслюзивным материалам</p>
					<p><b>350 </b><i style="font-size: 13px;" class="fas fa-ruble-sign"></i> Привилегии выше + эксклюзивные бонусы</p>
					<p><b>600 </b><i style="font-size: 13px;" class="fas fa-ruble-sign"></i> Привилегии выше + доступ к авторским каналам</p>
				</div>
			</div>
			<button id="donate" href="#">Пожертвовать</button>
		</div>
	</main>
	<div class="container">
      <div class="row">
      	<div class="col pl-0">
			<div class="replenish-gradient">
			<main style="background:#252328; color:white; margin-bottom: 0">
			<div class="main-container section_column donate">
				<h4 style="font-size: 22px; margin-bottom: 10px;">Пополнение баланса</h4>
				<p class="mb-2">Курс конвертации: 1<i style="font-size: 13px;" class="fal fa-ruble-sign"></i> = 300$</p>
				<div class="form-group">
					<input class="form-control form-control-lg inp_sum" type="text" placeholder="">
					<label class="sum">Сумма</label>
					<label class="rub"><i style="font-size: 1.25rem"class="fas fa-ruble-sign"></i></label>
				</div>
				<label>Будет начислено</label>
				<input class="form-control mb-3" id="final" type="text" placeholder="" readonly>
				<button type="button" class="btn blue btn-block">Пополнить</button>
				<div class="text-center mt-1">
					<small>Нажимая на кнопку, вы соглашаетесь с <a style="text-decoration: underline;" href="rules">правилами проекта</a></small>
				</div>
			</div>
			</main>
			</div>
		</div>
		<div class="col pr-0">
		<main style="">
		<div class="main-container section_column">
			<h4 style="font-size: 22px; margin-bottom: 10px;">Последние пополнения</h4>
			
		</div>
		</main>
		</div>
	  </div>
	</div>
</div>
</div>
</div>
<?php include "inc/footer.php";
	?>
<? bottom();
?>