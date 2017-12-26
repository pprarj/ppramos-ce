$(function() {
	$('.menu-mobile').click(function(event) {
		event.stopPropagation();
		$('.menu-dropdown').toggle();
	});
	
	$(document).click(function(){
		$('.menu-dropdown').hide();
	});
});