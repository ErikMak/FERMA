<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Бонусы");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<main id="bonus-pattern">
		<div class="main-container section_column">
			<p class="mb-3" style="color: #b0b2e6;font-size: 14px;font-weight: 600; text-transform: uppercase;">Ежедневный бонус</p>
			<h3 class="mb-2" style="color: white;">Получай от 100$ до 10000$ <br>ежедневно</h3>
			<p class="mb-4" style="color: white;">Бонус новым игрокам <i style="font-size: 5px; vertical-align: middle;" class="fas fa-circle"></i> до 4 уровня</p>
			<button class="btn white" type="submit" id="bonus" style="color: #363caf; width: 20%">Получить</button>
		</div>
	</main>
	<main class="d-flex">
	<div class="main-container section_column" style=" width: 60%;">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Промокоды</h4>
		<p style="border-right: 1px rgba(0, 0, 0, 0.1) solid; padding-right: 30px"><b style="font-weight: 600">Как получить промокод?</b><br>Вы можете получить промокод на одном из наших многочисленных мероприятий или розыгрышей на официальных страницах в социальных сетях.</p>
	</div>
	<div class="main-container section_column">
		<div class="mt-4">
			<p class="mb-2">Введите свой код:</p>
			<div class="d-flex mb-1" id="promocode">
				<input type="text" class="form-control">
				<button type="submit" class="btn blue ml-2">Использовать</button>
			</div>
			<small class="ok" style="color: #2ecc71; display: none;"><i class="fas fa-check-circle"></i> Промокод активирован</small>
			<small class="error" style="color: #e74c3c;  display: none;"><i class="fas fa-exclamation-circle"></i> Промокод не найден!</small>
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
<script>
	$(document).ready(function () {
		$('#promocode button').click(function(e){
		e.preventDefault();

		let promocode = $('#promocode input').val();
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'json',
			data: {
				promocode: promocode
			},
			success: function(data) {
				if (data['status'] === true) {
					$("small.ok").css("display", "block");
				} else {
					$("small.error").css("display", "block");
				}
			}
			});
		});
		$('#bonus').click(function(e){
		e.preventDefault();

		$.ajax({
			url: '/request/bonus.php',
			type: 'POST',
			dataType: 'json',
			success: function(data) {
				if (data['status'] === true) {
					showPopup('.confirm', data['title']);
					$('b.balance').text(data['balance'] + ' $');
				} else {
					showPopup('.popup-fade.error', data['title']);
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