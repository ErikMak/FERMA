<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Поле");
?>
<div id="farm_menu">
	<?php require "inc/header.php";
	?>
<div class="wrapper">
	<?php require "inc/sidebar.php";
	?>	
<div class="content-wrapper">
	<div class="seeds">
		<div class="description">
			<a href="" style="color: white; text-decoration: none;" class="show">▼</a>
			<p></p>
			<p>Название</p>
			<p>Стадия</p>
			<p>Дней</p>
			<p>Действие</p>
		</div>
		<?  // Get objects
			$number = 1;
			$result = $connection->select("user_feg", ["feg_id", "maturation", "en_name", "name"], ["user_id" => $_SESSION['user_data']['id']]);
			foreach($result as $seed) {
				if ($seed["maturation"] > 0) {
					$stage = "Рост";
					$day = $seed["maturation"];
				} else {
					$stage = "Сбор";
					$day = $days;
				}

				echo '<div class="item" id="'.encrypt($seed["feg_id"]).'">
						<b>'.$number++.'</b>
						<img src="img/'.$seed["en_name"].'.png">
						<p style="white-space: nowrap;">«'.$seed["name"].'»</p>
						<p style="white-space: nowrap;">'.$stage.'</p>
						<b style="white-space: nowrap;">'.$day.' дн.</b>
						<a href="#" class="delete">Удалить</a>
					</div>';
			}
		?>
	</div>
	<?php require "inc/farm_menu.php";
	?>
	<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
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
<script type="text/javascript">
	$('.item').hide();
	$('.seeds .show').click(function (e) {
		e.preventDefault();
    	$('.item').slideToggle("fast");
    	$('.seeds .show').text(function(i, text) {
    		return text === "▼" ? "▲" : "▼";
    		})
	 	});

$(document).ready(function () {
	let feg_id;
	$('.item .delete').click(function(e){
		e.preventDefault();
		showPopup('.question', 'Убрать растение', 'Вы действительно хотите удалить это растение? Место на поле будет очищено. Прогресс будет утерян!');
		feg_id = $($(this)).parent().attr("id");
	});

	$('#question').click(function(e){
		e.preventDefault();
		$('.question').fadeOut();
		$.ajax({
			url: '/request/delete_feg.php',
			type: 'POST',
			dataType: 'json',
			data: {
				feg_id: feg_id,
			},
			success: function(data) {
				if (data['status'] === true) {
					document.getElementById(feg_id).remove();
					showPopup('.confirm', data['title']);
					$('b.size').text(data['size'] + ' яч.');
					$('b.engaged').text(data['engaged'] + ' яч.');
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
<?
bottom();
?>