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