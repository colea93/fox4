$('.zod').click(function(event){
	event.preventDefault();
	$('#fo').removeClass('hidden');
	var id  = $(this).attr('href'),
	top = $(id).offset().top;
	$('body,html').animate({scrollTop: top}, 1500);
	var znak_name = $(this).attr('title');
	$('#name_zn').text(znak_name);
	$('.name_znnn').text(znak_name);
});

// $('a[href="#verh_vib"], #no').click(function(e){
// 	e.preventDefault();
// 	const target = $('#verh_vib').offset().top - 200;
// 	$('body,html').animate({scrollTop: target}, 1500);
// })

$( "#yes" ).click(function( event ) {
  event.preventDefault();});
		$('#yes').click(function(){
			$('#fo').hide(300);
				 $('#fo-1').removeClass('hidden');
});

$( "#yes-1" ).click(function( event ) {
  event.preventDefault();});
		$('#yes-1').click(function(){
			$('#fo-1').hide(300);
		     $('#fo-2').removeClass('hidden');
});

$( "#yes-2" ).click(function( event ) {
  event.preventDefault();});
		$('#yes-2').click(function(){
			$('#fo-2').hide(300);
		     $('#fo-3').removeClass('hidden');

});

$( "#yes-3" ).click(function( event ) {
	const input = $(this).parent().find('#exampleInputEmail2')[0];
	if (input.validity.valid) {
		event.preventDefault();
		var name = $('#exampleInputEmail2').val();
		$('.name_im').text(name);
		$('.name_al').val(name);
		$('#fo-3').hide(300);
		$('#fo-4').removeClass('hidden');
		setTimeout(function(){$('.first').fadeOut()}, 3500);
		setTimeout(function(){$('#fo-4').fadeOut()}, 3500);
		setTimeout(function(){$('#verh_vib').fadeOut()}, 3500);
		setTimeout(function(){$('#article-post').fadeOut()}, 3500);
		setTimeout(function(){$('#fo-5').removeClass('hidden')}, 3500);
		setTimeout(function(){$('.first').addClass("hidden")}, 3500);
		$(window).scrollTop(1000);
		setTimeout(function(){$(window).scrollTop(0)}, 3500);
	}
});

$('#fo-5 #article-post a').click(function(e) {
	e.preventDefault();
	const target = $('#zakaz').offset().top;
	$('body,html').animate({scrollTop: target}, 1500);
})