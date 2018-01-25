function RedirectToDetail(idfood) {
	var link = "Details.php?idfood=" + idfood;
	location.href = link;
}
/*
$(document).ready(function() {
	    $('.btn-calc').click(function() {
		var value = $('#input-quantity').val();
		$.ajax({
			url: 'xuly.php',
			type: 'POST',
			data: {quantity: value},
		})
		.done(function() {
			console.log("success");
		});
		
	});

	$('#input-quantity').keyup(function(event) {
		var value = $('#input-quantity').val();
		$('.display-quantity').text(<?php ?>)
	});
});
*/
