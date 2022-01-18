<?php
	session_start();
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Контракты");
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
		<h4 style="font-size: 22px; margin-bottom: 10px;">Контракты</h4>
		<p>Вы находитесь на странице контрактов. Контракты позволяют быстро продавать товары за более крупные суммы. Для выполнения контракта требуется собрать продукты в необходимом количестве. Список контрактов регулярно обновляется, узнать время до следующего обновления можно ниже.</p>
	</div>
	</main>
	<main style="background: #1A1A1A; color: white;">
	<div class="main-container info-board">
		<svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
		  <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
		</svg>
		<p style="margin-left: 15px">До следующего обновления списка контрактов осталось: <b id="timer"></b></p>
	</div>
	</main>
	<div class="contracts_section">
		<?  // Get user's storage information
			$result = $connection->select("storage", ["salad", "cucumber", "potato", "turnip", "squash", "cauliflower", "corn", "tomato", "radish", "pepper", "eggplant", "beet", "pumpkin", "chin_cabbage", "artichoke"], ["user_id" => $_SESSION['user_data']['id']]);
			foreach($result as $storage) {
			// Get objects
			$result = $connection->select("contracts", ["id", "store_name", "item", "image"]);
			foreach($result as $contract) {
				$item = unserialize($contract['item']);
				echo '<main>
					<div class="contract_item">
					<div class="vector bg"><img src="'.$contract["image"].'"></div>
					<div class="information">
						<section>Контракт на поставку продуктов от <b>«'.$contract["store_name"].'»</b></section>
						<b>Требуется:</b>';
				for($i = 0; $i < sizeof($item) - 1; ++$i) {
				    echo '<div class="line"><p> ';
				    if ($storage[$item[$i]['name']] >= $item[$i]['quantity']) {
				    	echo '<i class="fas fa-check-circle"></i>';
				    } else {
				    	echo '<i class="fas fa-exclamation-circle"></i>';
				    }
				    echo ' '.$item[$i]['ru_name'].'</p><b>'.$item[$i]['quantity'].' шт.</b></div>';
				}
				echo '</div>
					<div class="price">
						<h5>Оплата</h5>
						<hr>
						<b>'.$item[(sizeof($item) - 1)].' Кристаллов</b>
						<button type="button" class="btn green btn-block" value="'.encrypt($contract["id"]).'">Выполнить</button>
					</div>
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
	$('.price button').click(function(e){
			e.preventDefault();
			let article = $(this).attr("value");

			$.ajax({
				url: '/request/execute_contract.php',
				type: 'POST',
				dataType: 'json',
				data: {
					article: article,
				},
				success: function(data) {
						if (data['status'] === true) {
							showPopup('.confirm', data['title']);
							$('b.coins').text(data['coins'] + ' C');
						} else {
							showPopup('.error', data['title']);
						}
				}
			});
		});
	});
</script>
<script src="/scripts/timer.js"></script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>