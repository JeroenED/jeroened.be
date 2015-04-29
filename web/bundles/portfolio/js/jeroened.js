$(document).ready(function() {
	$("nav").click(function() {
		var cur = $("nav ul li").css("margin-left");
		if (cur == "0px") {
			cur = "200px"
		} else {
			closePage();
			cur = "0px"
		}
		$("nav ul li").animate({
			"margin-left": cur
		});
	});
	$("a").click(function() {
		if ($(this).attr("href") == 'javascript:void(0)') {
			var page = $(this).data("page");
			OpenPage(page);
		}
	});
	$(document).on("click", '.closebtn', function() {
		closePage();
	});
	$(window).resize(function() {
		closePage();
	});
});

function OpenPage(page) {
	$('body').append('<div class="loading page">Your page is loading...</div>');
	var hash = location.hash;
	$('.loading').css("position", "absolute");
	$('.loading').css("max-height", $(window).innerHeight() - 100 + "px");
	$('.loading').css("max-width", $(window).innerWidth() - 100 + "px");
	$('.loading').css("top", ($(window).innerHeight() - $('.loading').innerHeight()) / 2 + $(window).scrollTop() + "px");
	$('.loading').css("left", ($(window).innerWidth() - $('.loading').innerWidth()) / 2 + $(window).scrollLeft() + "px");
	$.ajax({
		url: location.protocol + "//" + location.hostname + "/api/getPage/" + page
	}).done(function(data) {
		$('body').append('<div class="page" id="' + page + '"></div>');
		$('#' + page).html(data);
		$('#' + page).css("position", "absolute");
		$('#' + page).css("max-height", $(window).innerHeight() - 100 + "px");
		$('#' + page).css("max-width", $(window).innerWidth() - 100 + "px");
		$('#' + page).css("top", ($(window).innerHeight() - $('#' + page).innerHeight()) / 2 + $(window).scrollTop() + "px");
		$('#' + page).css("left", ($(window).innerWidth() - $('#' + page).innerWidth()) / 2 + $(window).scrollLeft() + "px");
		if (!$('#' + page).hasClass("mCustomScrollbar")) {
			$('#' + page).append('<img src="/bundles/portfolio/images/closeicon.png" alt="sluiten" class="closebtn" style="display: block; width: 18px; height: 18px; position: absolute; top: 1px; right: 1px;">');
			$('#' + page).mCustomScrollbar();
			var closebutton = $(".closebtn");
		}
		$('.loading').remove();
		if ($(window).innerWidth() <= 480) {
			$('.cv-informatics tr').each(function() {
				var head = $(':nth-child(3)', this).clone().wrap('<p>').parent().html();
				var body = $(':nth-child(4)', this).clone().wrap('<p>').parent().html();
				$(':nth-child(4)', this).remove();
				$(':nth-child(3)', this).remove();
				$('<tr>' + head + body + '</tr>').insertAfter(this);
			});
		}
	});
	history.pushState(null, "", "/page/" + page);
	location.hash = hash;
}

function closePage() {
	var hash = location.hash;
	$(".page").css("display", "none");
	history.pushState(null, "", "/");
	location.hash = hash;
}