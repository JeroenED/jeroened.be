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
	
	$(document).on("click", '.closebtn', function() {
		$(".page").css("display", "none");
	});
	
	$(window).resize( function() {
		$(".page").css("display", "none");
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
	if(!element.hasClass("mCustomScrollbar")) {
		element.append('<img src="images/closeicon.png" alt="sluiten" class="closebtn" style="display: block; width: 24px; height: 24px; position: absolute; top: 1px; right: 1px;">');
		element.mCustomScrollbar();
		var closebutton = $(".closebtn");
	}
}