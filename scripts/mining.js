$(document).ready(function () {
	// Start research
	$('#order').click(function(e){
		e.preventDefault();
		$.ajax({
			url: '/request/order_research.php',
			type: 'POST',
			dataType: 'json',
			success: function(data) {
				if (data['status'] === true) {
					toastr.success(data["title"]);
					$('b.balance').text(data['balance'] + ' $');
				} else {
					toastr.error(data["title"]);
				}
			}
		});
	});
	// Show characteristic
	let item_id;
	$('.sawmill_item .show').click(function(e){
		e.preventDefault();
		item_id = $($($(this)).parent()).parent().attr("id");
		console.log(item_id);
		$.ajax({
			url: '/request/show_sawmillChr.php',
			type: 'POST',
			dataType: 'json',
			data: {
				item_id: item_id,
			},
			success: function(data) {
				$(".info").fadeIn();
				$('.popup h5').html(data['title']);
				$('.popup p').html(data['text']);
			}
		});
	});
	// Start mining
	$('.sawmill_item .start').click(function(e){
		e.preventDefault();
		item_id = $($($($(this)).parent()).parent()).parent().attr("id");
		$.ajax({
			url: '/request/sawmill_start.php',
			type: 'POST',
			dataType: 'json',
			data: {
				item_id: item_id,
			},
			success: function(data) {
				toastr.success(data["title"]);
				document.getElementById(item_id).remove();
			}
		});
	});
	// Delete sawmill
	$('.sawmill_item .delete-research').click(function(e){
		e.preventDefault();
		showPopup('.question', 'Удалить участок', 'Вы действительно хотите удалить этот участок?');
		item_id = $($($($(this)).parent()).parent()).parent().attr("id");
	});
	$('.sawmill_item .delete').click(function(e){
		e.preventDefault();
		showPopup('.question', 'Удалить участок', 'Вы действительно хотите удалить этот участок?');
		item_id = $($($(this)).parent()).parent().attr("id");
	});
	$('#question').click(function(e){
		console.log(item_id);
		e.preventDefault();
		$('.question').fadeOut();
		$.ajax({
			url: '/request/delete_sawmill.php',
			type: 'POST',
			dataType: 'json',
			data: {
				item_id: item_id,
			},
			success: function(data) {
				toastr.success(data["title"]);	
				document.getElementById(item_id).remove();		
			}
		});
	});
});