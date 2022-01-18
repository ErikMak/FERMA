<?php
	session_start();
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top('Магазин семян');
?>
<div id="main">
	<?php require "inc/header.php";
	?>
<div class="wrapper">
	<?php require "inc/sidebar.php";
	?>	
<div class="content-wrapper">
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Покупка растений</h4>
		<p>Вы находитесь на странице покупки семян культурных растений. Каждое растение характеризуется продолжительностью жизни, по истечению которого растение умирает, и плодовитостью. Учитывайте при покупке, что приобретаемым растениям необходимо наличие места для посадки.</p>
	</div>
	</main>
	<main>
	<div class="main-container info-board">
		<svg width="32px" height="32px" viewBox="0 0 16 16" class="bi bi-question-square-fill" fill="#007bff" xmlns="http://www.w3.org/2000/svg" style="margin-right: 20px;">
		<path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
		</svg>
		<p>Подробнее о «Фермерстве» и «Культурных растениях» можно прочитать на странице <a href="faq"><b style="text-decoration: underline;">справочная информация</b></a></p>
	</div>
	</main>
	<div class="shop-section">
	<?      // Get objects
			$result = $connection->select("seeds", ["name", "id", "class", "price", "sale", "maturation", "en_name"], ["class" => $season]);
			if (empty($result)) {
				echo '<main style="grid-column-start: 1; grid-column-end: 4;">
				<div class="shop-item" style="background: url(img/winter_pattern.png) repeat-x; border-radius: 5px;">
				<b>В зимний период магазин закрыт!</b>
				</div>
				</main>';
			} else {
				foreach($result as $seeds) { 
					echo '<main>
					<div class="shop-item">
					<section><h5>«'.$seeds["name"].'»</h5></section>
					<div class="vector '.$seeds["class"].'"><img src="img/'.$seeds["en_name"].'.png"></div>
					<div class="characteristics">
					<div class="line"><p>Стоимость</p><b>'.$seeds["price"].',00 $</b></div>
					<div class="line"><p>Цена продажи</p><b>'.$seeds["sale"].',00 $</b></div>
					<div class="line"><p>Срок созревания</p><b>'.$seeds["maturation"].' дн.</b></div>
					</div>
					<button type="submit" class="btn green btn-block" id="buy-object" value="'.encrypt($seeds["id"]).'">Приобрести</button>
					</div>
					</main>';
				}
			}
	?>
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
<script>
$(document).ready(function () {
$('.shop-item button').click(function(e){
	e.preventDefault();
	let article = $(this).attr("value");

		$.ajax({
			url: '/request/buy_seed.php',
			type: 'POST',
			dataType: 'json',
			data: {
				article: article,
			},
			success: function(data) {
					if (data['status'] === true) {
						showPopup('.confirm', data['title']);
						$('b.balance').text(data['balance'] + ' $');
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