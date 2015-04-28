jQuery(document).ready(function($) {
	
	$('.btnsearch').click(function(event) {
		searchChamp($('#txtsearch').val());
	});
	$('.selectimg').click(function(event) {
		searchChamp('');
	});
	$('.cham-avt').on('click', '#img-champ', function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		showimage(dir);
	});

	$('.cham-avt').on('click', '.cover', function(event) {
		event.preventDefault();
	var dir = $(this).data('dir');
	$('.selectimg img').attr({
		src: dir,
		width:'324',
		height:'100',
	});
	});
});

function searchChamp(name){
	$.ajax({
		url: 'function/search.php',
		type: 'POST',
		data: {'txtsearch': name},
	})
	.done(function(data_champ) {
		$('.cham-avt').html(data_champ);
	});
}

function showimage(dir){
	$.ajax({
		url: 'function/getImage.php',
		data: {'dir': dir},
	})
	.done(function(data_image) {
			$('.cham-avt').html(data_image);
	})
}

