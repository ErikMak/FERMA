<?php
	session_start();
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Профиль");
?>
<div id="profile">
	<?php require "inc/header.php";
	?>
<div class="wrapper">
	<?php require "inc/sidebar.php";
	?>	
<div class="content-wrapper">
	<div class="profile_desc">
		<main>
		<h6>Пользователь сайта</h6>
		<hr>
		<img src="/icons/farmer-male.svg" alt="Avatar" class="avatar">
		<div class="name"><div class="nickname"><p><? echo $_SESSION['user_data']['username']?></p><div class="level"><span><? echo $farm['level']?></span></div></div></div>
	</main>
	</div>
	<div class="profile_info">
		<main>
		<h6>Информация</h6>
		<table class="table">
		  <tbody>
		    <tr>
		      <td>Дата регистрации:</td>
		      <td><? echo $_SESSION['user_data']['timestamp']?></td>
		    </tr>
		    <tr>
		      <td>Активный e-mail:</td>
		      <td><? echo $_SESSION['user_data']['email']?></td>
		    </tr>
		    <tr>
		      <td>Пароль</td>
		      <td><a href="#" class="recovery"><b style="text-decoration: underline;">Сменить пароль</b></a></td>
		    </tr>
		  </tbody>
		</table>
	</main>
	</div>
	<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<div class="slider">
			<input type="text" name="secret_code" class="form-control form-control-lg" style="width: 100%;">
			</div>
			<button type="button" id="check" class="btn btn-outline-primary btn-block">Подтвердить</button>
		</div>
	</div>
</div>
</div>
</div>
<script>
$(document).ready(function () {
	$('.recovery').click(function(e){
		e.preventDefault();
		showPopup('.question', 'Код подтверждения', 'На действующий e-mail пришло письмо с кодом подтверждения. Введите его в поле ниже');
		$.ajax({
			url: '/request/recovery.php',
			type: 'POST',
			dataType: 'json',
			data: {
				send_code: true,
			},
		});
	});

	$('#check').click(function(e){
		e.preventDefault();
		let secret_code = $('.recovery input[name="secret_code"]').val();
		$('.question').fadeOut();
			$.ajax({
				url: '/request/unset_ban.php',
				type: 'POST',
				dataType: 'json',
				data: {
					secret_code: secret_code,
				},
				success: function(data) {
						if (data['status'] === true) {
							showPopup('.confirm', data['title']);
						} else {
							showPopup('.error', data['title']);
						}
				}
			});
		});
	});
</script>	
<?php include "inc/footer.php";
	?>
<? bottom();
?>