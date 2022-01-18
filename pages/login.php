<?php
	if($_SESSION['user_data']) {
		header('Location: news');
	}
	top('Войти');
?>
<a href="home"><img style="position: absolute; width: 121px; height: auto; top: 1.1rem;
		left: 1.1rem;"src="img/LogoWhite.svg"></a>
<div id="reg">
	<? versionTag(); ?>
	<div class="reg-container" style="margin-bottom: 15px;">
		<div class="error_msg none">
			Error Message
		</div>
	</div>
	<div class="reg-container">
		<div class="header">
			<h2>Авторизация</h2>
		</div>
		<form class="form">
		<div class="form-group" style="margin: 0 0; position: relative;">
				<label>E-mail</label>
				<input class="form-control" type="email" placeholder="name@example.com" name="email">
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error Message</small>
		</div>
		<div class="form-group" style="margin: 0 0; position: relative;">
				<label>Пароль</label>
				<input class="form-control" type="password" placeholder="Пароль" name="password">
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error Message</small>
		</div>
		<p>Нет аккаунта? <a href="registration">Создать аккаунт</a></p>
		<form class="form-inline my-2 my-lg-0">
	    	<button class="btn yellow btn-block" type="submit" id="login-btn">Войти</button>
	    </form>
	</form>
	</div>
</div>
<script src="/scripts/validation.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#login-btn').click(function(e){
			e.preventDefault();
			if($('.success').length == 2) {
				let email = $('input[name="email"]').val(),
					password = $('input[name="password"]').val();

				$.ajax({
					url: '/request/signin.php',
					type: 'POST',
					dataType: 'json',
					data: {
						email: email,
						password: password
					},
					success: function(data) {
						if (data['status'] === true) {
							window.location = 'news';
						} else if (data['admin'] === true) {
							window.location = 'admin/home';
						} else {
							$('.error_msg').removeClass('none').text(data['message']);
						}
					}
				});
			} else { return false; }
		});
	});
</script>
<? bottom();
?>