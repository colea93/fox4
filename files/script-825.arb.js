$(document).ready(function() {
	$('.zodiac').click(function() {
		$('.step_1').hide();
		$('.step_2').show();
		$('html,body').scrollTop(0);
		var zodacForms = $(this).attr('title').split(',');;
		$('.zodacForms_1').text(zodacForms[0]);
		$('.zodacForms_2').text(zodacForms[1]);
		$('.zodacForms_3').text(zodacForms[2]);
	});
});