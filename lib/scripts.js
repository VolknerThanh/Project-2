$(document).ready(function() {
	var count = 0;
	$('.btn-add').click(function() {
		var this_num = "no_" + count;
		
		var addTextBox = `
		<div id=`+this_num+`>
			<input type="text" name="Material-input" class="Material-input" placeholder="Enter material name">
			<i class="fa fa-close btn-close" onclick="$('#`+this_num+`').remove();" style="font-size:35px"></i>
		</div>
		`;

		// Kiểm tra chưa điền vào textbox sẽ không cho thêm mới
		var CheckNull = true;
		$('.Material-input').each(function(i, el) {
			if($(el).val() == null || $(el).val() == "") {
				CheckNull = false;
				return;
			}
		});

		if( CheckNull ){
			$('#input-container').append(addTextBox);
			count++;
		}
		else{
			alert('please fill the box !');
		}
	});


	$('.btn-save').click(function() {
		
		var CheckNull = true;
		$('.Material-input').each(function(i, el) {
			if($(el).val() == null || $(el).val() == "") {
				CheckNull = false;
				return;
			}
		});

		if( CheckNull ){
			// get all element with same class
			$('.Material-input').each(function(i, el) {
				alert(i + ":" + $(this).val());
			});
		}
		else{
			alert('please fill the box !');
		}
	});


	$('.add-methods').click(function() {
		$('.fill-information').show(1000);
	});

	
	$('.btn-cancel').click(function() {
		$('.fill-information').hide(500);
	});

	/* ------ food ------ */
	$('.btn-addfood').click(function() {
		$('.add-food-form').show(500);
	});
	$('.button-cancel-addfood').click(function() {
		$('.add-food-form').hide(500);
	});
	$('.btn-del-food').click(function() {
		$('.DeleteConfirm').show(500);
	});
	$('.button-cancel-confirm').click(function() {
		$('.DeleteConfirm').hide(1000);
	});
});
