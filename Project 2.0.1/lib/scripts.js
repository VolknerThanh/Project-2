function RedirectToDetail(idfood) {
	var link = "Details.php?idfood=" + idfood;
	location.href = link;
}
var editThisId = -1;

$(document).ready(function() {

	$('.Edit_form').hide();

	$('.btn-login').click(function() {
		var username = $('.username-login').val().trim();
		var pass = $('.password-login').val().trim();
		if(username == "" || pass == "")
			alert("Hãy điền đầy đủ thông tin !");
		else{
			$.ajax({
				url: '../admin/login.php',
				type: 'POST',
				data: {
					username: username,
					password: pass
				},
			})
			.done(function(res) {
				if(res == "false")
					alert("Tên tài khoản hoặc mật khẩu sai !");
				else{
					//alert("Đăng nhập thành công !");

					location.href = "admin.php";
				}
			});
			
		}
	});

	$('.btn-signup').click(function() {
		var names = $('.names-input').val().trim();
		var username = $('.username-input').val().trim();
		var pass = $('.password-input').val().trim();
		var confirm_pass = $('.confirm-password-input').val().trim();
		if(names == "" || username == "" || pass == "")
			alert("Hãy điền đầy đủ thông tin !");
		else if(pass != confirm_pass)
			alert("Xin xác nhận lại mật khẩu !");
		else{
			$.ajax({
				url: '../xuly.php',
				type: 'POST',
				data: {
					name : names,
					username : username,
					password : pass
				},
			})
			.done(function() {
				alert('Đăng ký tài khoản thành công !');
				location.href = "admin.php";
			});
		}
	});

	$('.btn-signout').click(function(event) {
		$.ajax({
		url: '../xuly.php',
		type: 'POST',
		data: {
			logout : true,
			},
		}).done(function(res) {
			location.reload();
		});
		
	});

	$('.btnSave-NewName').click(function() {
		ChangeName();
	});
	$('.inputEditName').keydown(function(event) {
		var ev = ev || window.event;
		var	kc = ev.keyCode || ev.which;
		if(kc == 13){ ChangeName(); }
	});
	function ChangeName(){
		var newName = $('.inputEditName').val().trim();

		if(newName== "" || newName == null){
			alert('Hãy điền đầy đủ thông tin !');
		}
		else {
			$.ajax({
				url: '../xuly.php',
				type: 'POST',
				data: { 
					methodId : editThisId,
					methodNewName : newName
				},
			})
			.done(function(res) {
				if(res == "Done"){
					alert("Đã lưu thay đổi !");
					$('.Edit_form').hide(500);
					$('.admin-methods-list').show();
					location.reload();
				}
				else{
					alert('Phương thức "'+ newName + '" này đã tồn tại trong cơ sở dữ liệu !');
				}
			});
		}
	}

	$('.btnCancel-NewName').click(function() {
		$('.Edit_form').hide(500);
		$('.admin-methods-list').show();
	});

	$('.btnTrue').click(function() {
		$.ajax({
			url: '../xuly.php',
			type: 'POST',
			data: {delId: editThisId},
		})
		.done(function(res) {
			alert("Đã lưu thay đổi !");
			$('.Delete_form').hide();
			$('.admin-methods-list').show();
			location.reload();
		});
		
	});

	$('.btnFalse').click(function() {
		$('.Delete_form').hide(500);
		$('.admin-methods-list').show();
	});

	$('.btnAddMethods').click(function() {
		$('.Add_form').show(500);
		$('.admin-methods-list').hide(200);
	});

	$('.btnAddNew').click(function() {
		var newMethod = $('.inputAddName').val().trim();
		if(newMethod == "" || newMethod == null){
			alert("Hãy điền đầy đủ thông tin !");
		}
		else {
			$.ajax({
				url: '../xuly.php',
				type: 'POST',
				data: {methodName: newMethod},
			})
			.done(function(res) {
				if(res == "done"){
					alert("Đã thêm phương thức mới !");
					$('.Add_form').hide(500);
					$('.admin-methods-list').show();
					location.reload();
				}
				else{
					alert('Phương thức "'+ newMethod + '" này đã tồn tại trong cơ sở dữ liệu !');
				}
			});
			
		}
	});

	$('.btnCancelNew').click(function() {
		$('.Add_form').hide(500);
		$('.admin-methods-list').show();
	});

});
function Edit_Method_Id(thisid){
	$('.Edit_form').show(500);
	$('.admin-methods-list').hide(200);
	editThisId = thisid;
}
function Delete_Method_Id(thisid){
	$('.Delete_form').show(500);
	$('.admin-methods-list').hide(200);
	editThisId = thisid;
}
function toInfo(thisId){
	location.href = "info.php?idmethod="+thisId;
}
