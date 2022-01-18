$(document).ready(function () {
var days = [];
var prices = [];
$.ajax({
	url: '/graphic.json',
	type: 'GET',
	dataType: 'json',
	success: function(data) { 
	  var days = [];
	  var prices = [];
	  $.each(data, function(key){
	    days.push(data[key][0]["timestamp"]);
	    prices.push(data[key][0]["fuelPrice"]);
	  });
	  new Chartist.Line('.ct-chart', {
			  labels: days,
			  series: [
			    prices
			  ]
			}, {
			  seriesBarDistance: 12,
			  divisor: 2,
			  low: 0,
			  high: Math.max.apply(null, prices)+20,
			  showArea: true,
			});
	 if (data[data.length - 1][0]["trend"] == "up") {
	 	$('.trend').css({'color': 'green'});
	 	$('.trend').text("▲");
	 	$('.change').text("+"+data[data.length - 1][0]["change"]+"$");
	 } else if (data[data.length - 1][0]["trend"] == "down") {
	 	$('.trend').css({'color': 'red'});
		$('.trend').text("▼");
		$('.change').text("-"+data[data.length - 1][0]["change"]+"$");
	 }
	}
});
// Fuel purchase
$('#purchase').click(function(e){
	e.preventDefault();
	let quantity = $("#quantity").val();
	$.ajax({
		url: '/request/buy_fuel.php',
		type: 'POST',
		dataType: 'json',
		data: {
			quantity: quantity,
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
// 
$("#quantity").on("change", function(e) {
	$("#finalPrice").val($("#quantity").val() * parseInt($("#price").text()) + " $");
});
});