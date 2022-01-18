<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Служба поддержки");
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
		<h4 style="font-size: 22px; margin-bottom: 10px;">Служба поддержки</h4>
		<p>Свяжитесь со службой поддержки, если у вас возникли вопросы или вы столкнулись с ошибками на сайте. Ответ технических специалистов может занимать несколько часов.</p>
	</div>
	</main>
	<main style="background: #1a1a1a;">
	<div class="main-container support">
		<div class="container">
		  <div class="row">
		    <div class="col-sm-2">
		      <img width="50%" src="/img/vk-logo.svg">
		    </div>
		    <div class="col">
		      <h5 style="margin-bottom: 0.3rem">Официальная страница проекта во Вконтакте</h5>
		      <p>Для связи со службой поддержки пишите в <a style="text-decoration: underline;" href="#">сообщения сообщества</a></p>
		    </div>
		  </div>
		</div>
	</div>
	</main>
</div>
</div>
</div>
<?php include "inc/footer.php";
	?>
<? bottom();
?>