$(document).ready(function () {
	let name;
	let quantity = 0;
	$('.item button').click(function(e){
		e.preventDefault();

		$('input').val(quantity);
		name = $(this).attr("value");

		showPopup('.question', 'Продажа предмета');
		return name;
	});
	// Increase quantity
	$('.plus').click(function(e){
		e.preventDefault();
		quantity++;
		$('input').val(quantity);
	});
	// Decrease quantity
	$('.minus').click(function(e){
		e.preventDefault();
		if (quantity == 0) {
			return false;
		}
		quantity--;
		$('input').val(quantity);
	});
	// Quantity input
	$('input').on('change', function(e){
		quantity = $('input').val();
	});

// Sending data
	$('#question').click(function(e){ 
		e.preventDefault();
		$('.question').fadeOut();
		$.ajax({
				url: '/request/storage_sell.php',
				type: 'POST',
				dataType: 'json',
				data: {
					name: name,
					quantity: quantity,
				},
				success: function(data) {
						if (data['status'] === true) {
							showPopup('.confirm', data['title']);
							$('b.balance').text(data['balance'] + ' $');
							if (name == "fuel") {
								$('.item #' + name).text(data['quantity'] + ' л.');
							} else {
								$('.item #' + name).text(data['quantity'] + ' шт.');
							}
						} else {
							showPopup('.error', data['title']);
						}
				}
		});
	});
});