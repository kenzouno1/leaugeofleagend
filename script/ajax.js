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
	$('.modal').modal('hide');
	$('input[type=hidden]').val(dir);
	});

	$('#submit').click(function(event) {
		var charname = $('#charname').val();
		var pos = $('#pos').val();
		var rank = $('#rank').val();
		var img = $('input[type=hidden]').val();
		createImage(charname,pos,rank,img);
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
});
}

function createImage(charname,position,rank,img){
$.ajax({
	url: 'createImage.php',
	type: 'POST',
	data: {
			'charname':charname,
			'pos':position,
			'rank':rank,
			'champ' :img	
		},
})
.done(function(data_html) {
	console.log(data_html);
$('.success').html(data_html);
});

}
