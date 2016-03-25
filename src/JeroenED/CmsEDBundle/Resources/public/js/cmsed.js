$(document).ready(function() {
	$("#dialog").dialog({
		autoOpen: false,
		modal: true
	});
	$(".confirmLink").click(function(e) {
		$('#dialog').html($(this).data('text'));
		e.preventDefault();
		var targetUrl = $(this).data('link');
		$("#dialog").dialog({
			buttons: {
				"Confirm": function() {
					window.location.href = targetUrl;
				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}
		});
		$("#dialog").dialog("open");
	});
	$("nav").height($(document).height() - 150);
});


function loadCKeditor(instance) {
    CKEDITOR.replace( instance, {
        customConfig: '/bundles/jeroenedcmsed/js/ckeditor.js',
        extraPlugins: 'codemirror',
        bodyClass: 'reveal'
    });
}
function UrlExists(url)
{
    if(url == '') return false;
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}