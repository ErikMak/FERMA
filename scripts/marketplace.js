$(document).ready(function () {
	let category = $("#accordian .active").children().attr("name");
	// Save checkbox position
	document.querySelectorAll("#list-setting").forEach(el => {
	  el.onchange = () => {
	  	localStorage.setItem(el.id, el.checked);
	  	$.ajax({
			url: '/request/load_lots.php',
			type: 'POST',
			dataType: 'html',
			data: {
				category: $("#accordian .active").children().attr("name"),
				checkbox: document.getElementById("list-setting").checked,
			},
			success: function(data) {
				$("#responsecontainer").html(data);
			}
		});
	  };
	  el.checked = localStorage.getItem(el.id) === "true";
	})
	// Get checkbox setting
	let checkbox = document.getElementById("list-setting").checked;
	// Sidebar
	var tabsVerticalInner = $('#accordian');
	var selectorVerticalInner = $('#accordian').find('li').length;
	var activeItemVerticalInner = tabsVerticalInner.find('.active');
	var activeWidthVerticalHeight = activeItemVerticalInner.innerHeight();
	var activeWidthVerticalWidth = activeItemVerticalInner.innerWidth();
	var itemPosVerticalTop = activeItemVerticalInner.position();
	var itemPosVerticalLeft = activeItemVerticalInner.position();
	$(".selector-active").css({
	  "top":itemPosVerticalTop.top + "px", 
	  "left":itemPosVerticalLeft.left + "px",
	  "height": activeWidthVerticalHeight + "px",
	  "width": activeWidthVerticalWidth + "px"
	});
	$("#accordian").on("click","li",function(e){
	  $('#accordian ul li').removeClass("active");
	  // GET LINK CATEGORY
	  let category = $(this).children().attr("name");
	  $(this).addClass('active');
	  var activeWidthVerticalHeight = $(this).innerHeight();
	  var activeWidthVerticalWidth = $(this).innerWidth();
	  var itemPosVerticalTop = $(this).position();
	  var itemPosVerticalLeft = $(this).position();
	  $(".selector-active").css({
	    "top":itemPosVerticalTop.top + "px", 
	    "left":itemPosVerticalLeft.left + "px",
	    "height": activeWidthVerticalHeight + "px",
	    "width": activeWidthVerticalWidth + "px"
	  });
	  // Load lots by click
	  $.ajax({
			url: '/request/load_lots.php',
			type: 'POST',
			dataType: 'html',
			data: {
				category: category,
				checkbox: checkbox,
			},
			success: function(data) {
				$("#responsecontainer").html(data);
			}
		});
	});
	// My lots table
	$('#lots').DataTable({
		"searching": false,
		"language": {
            "lengthMenu": "Показать _MENU_ лотов",
            "zeroRecords": "Лотов не найдено!",
            "info": "Страница _PAGE_ из _PAGES_ (Загружено _MAX_ лотов)",
            "infoEmpty": "Лотов не найдено!",
        },
	});
	// Load lots when document ready	
	$.ajax({
		url: '/request/load_lots.php',
		type: 'POST',
		dataType: 'html',
		data: {
			category: category,
			checkbox: checkbox,
		},
		success: function(data) {
			$("#responsecontainer").html(data);
		}
	});
	// Show final price in disable input
	$("#unitPrice, #quantity").on("change", function(e) {
		let finalPrice = $("#quantity").val() * $("#unitPrice").val();
		$("#lotPrice").val(Math.round(finalPrice + finalPrice *0.08) + " $");
	});
	// Send lot
	$('#place').click(function(e){
		e.preventDefault();
		let productName = $("#product option:selected").attr("value");
		let productNameRU = $("#product option:selected").text();
		let quantity = $("#quantity").val();
		let unitPrice = $("#unitPrice").val();
		$.ajax({
			url: '/request/send_lot.php',
			type: 'POST',
			dataType: 'json',
			data: {
				productName: productName,
				productNameRU: productNameRU,
				quantity: quantity,
				unitPrice: unitPrice,
			},
			success: function(data) {
				if (data['status'] === true) {
					toastr.success(data["title"]);
					let lots = parseInt($(".lots_quan").text());
					let summa = parseInt($(".summa").text());
					$(".lots_quan").text(lots+1);
					summa = Math.round(summa + (unitPrice - unitPrice*0.08));
					$(".summa").text(summa);
				} else {
					toastr.error(data["title"]);
				}
			}
		});
	});
});