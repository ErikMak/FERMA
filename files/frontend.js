// SMOOTH TRANSITION
$(".reg-container").css("display", "none");
$(".reg-container").fadeIn(800);
$("a.transition").click(function(event){
	event.preventDefault();
	linkLocation = this.href;
	$(".reg-container").fadeOut(800, redirectPage);
});

// function redirectPage() {
// 	window.location = linkLocation;
// }

// POPUP
function showPopup(popup, title, msg) {
	$(document).ready(function($){
		$(popup).fadeIn();
		$('.popup h5').text(title);
		$('.popup p').text(msg);
	});
}

$(document).ready(function($){
	$('.popup-open').click(function() {
		$('.popup-fade').fadeIn();
		return false;
	});

	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
		return false;
	});

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
		}
	});

	$('.popup-fade').click(function(e) {
		if($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();
		}
	});
});
// TOOLTIP
$(function(){
      $("[data-tooltip]").mousemove(function (eventObject) {
          $data_tooltip = $(this).attr("data-tooltip");
          $("#tooltip").html($data_tooltip)
              .css({ 
                "top" : eventObject.pageY + 5,
                "left" : eventObject.pageX + 5
              })
              .show();
          }).mouseout(function () {
            $("#tooltip").hide()
              .html("")
              .css({
                  "top" : 0,
                  "left" : 0
              });
      });
});