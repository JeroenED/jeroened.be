var pages = new Array("", "archive", "changelog");
var currentPage = getCurrentPage();
$(document).ready(function() {
    $("nav").click(function() {
        var cur = $("nav ul li").css("margin-left");
        if (cur == "0px") {
            cur = "200px"
        } else {
            ClosePage(currentPage);
            cur = "0px"
        }
        $("nav ul li").animate({
            "margin-left": cur
        });
    });
    $(document).on("click", '.closebtn', function() {
        ClosePage(currentPage);
    });
    $(window).resize(function() {
        $('.page').css("max-height", $(window).innerHeight() - 100 + "px");
        $('.page').css("max-width", $(window).innerWidth() - 100 + "px");
        $('.page').mCustomScrollbar('update');
        $('.page').css("top", ($(window).innerHeight() - $('.page').innerHeight()) / 2 + $(window).scrollTop() + "px");
        $('.page').css("left", ($(window).innerWidth() - $('.page').innerWidth()) / 2 + $(window).scrollLeft() + "px");
    });
    var mobile = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))mobile=true})(navigator.userAgent||navigator.vendor||window.opera);
        
    if (mobile) {
        $('.nomobile').css("display", "none");
        $('.mobile').css("display", "block");
    } else {
        $('.nomobile').css("display", "block");
        $('.mobile').css("display", "none");
    }
    $('.table-mobile').each(function() {
        $(this).stacktable();
    });

    $('body').on('click', "a[href^='/']", function(e) {
		var page = $(this).attr('href').replace('/', '')
		if(pages.indexOf(page) == -1)
		{  
			OpenPage(page);
			e.preventDefault();
		}
    });

    $("a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])")
    .addClass("external")
    .attr("target","_blank");
});

window.onpopstate = function(e) {
	var page = location.pathname.replace('/', '')
	if(pages.indexOf(page) > -1)
	{  
		ClosePage(currentPage, false);
		e.preventDefault();
	} else {
		if($('#' + page).length == 0) OpenPage(page, false);
	}
}

function OpenPage(page, popState = true) {
    ClosePage(currentPage, false);
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
        $('body').append('<div class="printable"></div>');
        $('.printable').html(data);
        $('#' + page).css("position", "absolute");
        $('#' + page).css("max-height", $(window).innerHeight() - 100 + "px");
        $('#' + page).css("max-width", $(window).innerWidth() - 100 + "px");
        if (!$('#' + page).hasClass("mCustomScrollbar")) {
            $('#' + page).append('<img src="/bundles/jeroenedportfolio/images/closeicon.png" alt="sluiten" class="closebtn" style="display: block; width: 24px; height: 24px; position: absolute; top: 1px; right: 1px;">');
            $('#' + page).mCustomScrollbar();
            var closebutton = $(".closebtn");
        }
        $('#' + page).css("top", ($(window).innerHeight() - $('#' + page).innerHeight()) / 2 + $(window).scrollTop() + "px");
        $('#' + page).css("left", ($(window).innerWidth() - $('#' + page).innerWidth()) / 2 + $(window).scrollLeft() + "px");
        $('.loading').remove();
	$('.table-mobile').each(function() {
		$(this).stacktable();
	});
        if ($(window).innerWidth() <= 480) {
            $('.cv-informatics tr').each(function() {
                var head = $(':nth-child(3)', this).clone().wrap('<p>').parent().html();
                var body = $(':nth-child(4)', this).clone().wrap('<p>').parent().html();
                $(':nth-child(4)', this).remove();
                $(':nth-child(3)', this).remove();
                $('<tr>' + head + body + '</tr>').insertAfter(this);
            });
        }

        $("a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])")
        .addClass("external")
        .attr("target","_blank");
    }).fail(function() { 
        $('body').append('<div class="page" id="' + page + '"><h1 style="text-align: center;">404 Not Found</h1><p style="text-align: center;"><a href="javascript:ClosePage(currentPage);">Click here to close this window</a></p></div>');
        $('#' + page).css("position", "absolute");
        $('#' + page).css("max-height", $(window).innerHeight() - 100 + "px");
        $('#' + page).css("max-width", $(window).innerWidth() - 100 + "px");    
        $('#' + page).css("top", ($(window).innerHeight() - $('#' + page).innerHeight()) / 2 + $(window).scrollTop() + "px");
        $('#' + page).css("left", ($(window).innerWidth() - $('#' + page).innerWidth()) / 2 + $(window).scrollLeft() + "px");
        $('.loading').remove();
    });
    if (popState) {
		history.pushState(null, "", "/" + page + hash);
		ga('send', 'pageview', "/" + page + hash);
	}
}

function ClosePage(previousPage, popState = true) {
    var hash = location.hash;
    $(".page").remove();
    $(".printable").remove();
    if (popState) {
		history.pushState(null, "", previousPage + hash);
		ga('send', 'pageview', previousPage);
	}
}

function getCurrentPage() {
    var previous = location.pathname.replace('/', '')
	if(pages.indexOf(previous) == -1)
	{  
		previous = '/'
	}
    return previous;
}
