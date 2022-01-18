<?php
	top("Админ-панель");
?>
<div id="main">
	<?php include "inc/admin_header.php";
	?>
<div class="wrapper">
	<?php include "inc/admin_sidebar.php";
	?>
<div class="content-wrapper">
	<main>
	<div class="main-container news-header">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Добро пожаловать, <?echo $_SESSION['admin_data']['username'];?>!</h4>
		<p>Вы вошли в админ-панель проекта</p>
	</div>
	<div class="main-container section_column">
		<p class="mb-2">Управлять проектом гораздо удобнее через административную панель! Вся необходимая информация в одном месте.</p>
		<hr>
		<h5>Наши контакты</h5>
		<style>
			.redirect {
				margin-top: 1.4rem;
				border-radius: 30px !important;
				background: linear-gradient(to right, #F8D654, #FCB55A);
				border-style:  none  !important;
				padding: 0.5rem 4rem !important;
				font-family: 'NoirPro', sans-serif;
				box-shadow: 0 5px 5px 0 rgba(0,0,0,0.2);
			}
			.redirect:hover {
				background: linear-gradient(to right, #F0CE4A, #EDA952);
			}
			.chill {
				float: right;
				padding-right: 2rem;
			}
		</style>	
		<div class="mb-4" style="background:#f7f7f7; padding:2rem; border-radius: 7px">
			  <div class="row">
			    <div class="col-sm">
			      <b style="font-family: 'Open Sans', sans-serif;">Дискорд-канал администраторов и разработчиков проекта</b><br>
			      <button onclick="location.href = '#';" type="button" class=" redirect btn btn-info">Перейти</button>
			    </div>
			    <div class="col-sm">
			      <img class="chill" width="68%"src="/img/undraw_Chilling_re_4iq9.svg">
			    </div>
			  </div>
		</div>
		<div class="container" style="background: #1a1a1a; padding:2rem; border-radius: 7px; color: white">
		  <div class="row">
		    <div class="col-sm-2">
		      <img width="50%" src="/img/vk-logo.svg">
		    </div>
		    <div class="col">
		      <h5 style="margin-bottom: 0.3rem">Официальная страница проекта во Вконтакте</h5>
		      <p>Закрытая беседа для общения - <a style="text-decoration: underline;" href="#">войти</a> </p>
		    </div>
		  </div>
		</div>
		<hr>
		<h5>Студия #47Poligons</h5>
		<div class="contact d-flex" style="padding-top: 0.2rem;padding-bottom: 0.2rem; padding-left: 2rem">
			<img src="/img/foto.jpg" style="margin-top:  4px;border-radius: 10px; width: 44px; height: 44px; margin-right: 15px;">
			<div class="d-flex flex-column w-100">
				<div class="d-flex align-items-center">
					<p style="font-weight: 600; margin-right: 10px">Эрик Золотов </p><span class="badge badge-primary">Главный разработчик</span>
				</div>
				<div  class="p-1">
				<p style="font-size: 15px"><i class="fab fa-skype"></i> x-ray6650</p>
				<p style="font-size: 15px"><i class="fab fa-vk"></i> vk.com/erikmak</p>
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