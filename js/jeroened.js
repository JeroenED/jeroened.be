$(document).ready(function() {
	$("nav").click(function() {
		var cur = $("nav ul li").css("margin-left");
		if (cur == "0px") {
			cur = "200px"
		} else {
			cur = "0px"
		}
		$("nav ul li").animate({
			"margin-left": cur
		});
	});
	$("a").click(function() {
		var page = $(this).data("page");
		OpenPage(page);
	});
	$('body').click(function(event) {
		if($('.page span.closeable')[0]) {
			$(".page").css("display", "none");
			$("span.closeable").remove();
		}
	});
});

function OpenPage(page) {
	var element = $("#" + page);
	element.css("display", "block");
	element.css("position", "absolute");
	element.css("max-height", $(window).innerHeight() - 100 + "px");
	element.css("max-width", $(window).innerWidth() - 100 + "px");
	element.css("top", ($(window).innerHeight() - element.innerHeight()) / 2 + $(window).scrollTop() + "px");
	element.css("left", ($(window).innerWidth() - element.innerWidth()) / 2 + $(window).scrollLeft() + "px");
	$(element).mCustomScrollbar();
	
	setTimeout(function(){ element.append('<span class="closeable" style="display:none;">I am closable</span>') }, 500);
}