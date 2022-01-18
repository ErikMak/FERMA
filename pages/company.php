<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Моя ферма");
?>
<div id="farm_menu">
	<?php require "inc/header.php";
	?>
<div class="wrapper">
	<?php require "inc/sidebar.php";
	?>	
<div class="content-wrapper">
	<main style="grid-column-start: 1; grid-column-end: 3; max-height: 300px;">
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Компания</h4>
		<p>Стоимость</p>
	</div>
	</main>
	<?php require "inc/farm_menu.php";
	?>
	<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<button type="button" style="font-weight: 500;" id="question" class="btn blue-outline btn-block">Подтвердить</button>
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
	$('.objects .show').click(function (e) {
		e.preventDefault();
    	$('.item').slideToggle("fast");
    	$('.objects .show').text(function(i, text) {
    		return text === "▼" ? "▲" : "▼";
    		})
	 	});

$(document).ready(function () {
	let object_id;
	$('.item .delete').click(function(e){
		e.preventDefault();
		showPopup('.question', 'Удалить постройку', 'Вы действительно хотите удалить этот объект? Вам будет возвращено 30% от стоимости объекта');
		object_id = $($(this)).parent().attr("id");
	});



	$('#question').click(function(e){
		e.preventDefault();
		$('.question').fadeOut();
		$.ajax({
			url: '/request/delete_object.php',
			type: 'POST',
			dataType: 'json',
			data: {
				object_id: object_id,
			},
			success: function(data) {
				if (data['status'] === true) {
					document.getElementById(object_id).remove();
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