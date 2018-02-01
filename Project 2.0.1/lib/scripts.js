function RedirectToDetail(idfood) {
	var link = "Details.php?idfood=" + idfood;
	location.href = link;
}
var editThisId = -1;
var AccId = -1;

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

	/* ---------- Methods ---------- */

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

	/* ----------- Accounts ---------- */

	$('.btnAddAccounts').click(function() {
		$('.Add_Acc_form').show(500);
		$('.admin-accounts-list').hide(200);
	});

	$('.btnCancelNewAcc').click(function() {
		$('.Add_Acc_form').hide(500);
		$('.admin-accounts-list').show();
	});

	$('.btnSaveNewAcc').click(function() {
		var accName = $('.inputAccAddName').val().trim();
		var accUN = $('.inputAccAddUsername').val().trim();
		var accPass = $('.inputAccAddPassword').val().trim();
		var accConf = $('.inputAccConfirmPass').val().trim();
		if(accName == "" || accUN == "" || accPass == "" || accConf == ""){
			alert("Hãy điền đầy đủ thông tin !");
		}
		else if(accPass != accConf){
			alert("Xác nhận lại mật khẩu !");
		}
		else{
			$.ajax({
				url: '../xuly.php',
				type: 'POST',
				data: {
					Accname : accName,
					Accusername : accUN,
					Accpassword : accPass
				},
			})
			.done(function(res) {
				if(res == "done"){
					alert('Đã lưu tài khoản vào cơ sở dữ liệu !');
					location.reload();
					$('.Add_Acc_form').hide(500);
					$('.admin-accounts-list').show();
				}
				else{
					alert("Tên đăng nhập '" + accUN + "' đã tồn tại ! thử lại");
				}
			});
			
		}
	});

	$('.btnAcc_Confirm').click(function(){
		$.ajax({
			url: '../xuly.php',
			type: 'POST',
			data: {delAccId: AccId},
		})
		.done(function(res) {
			alert("Đã xóa tài khoản !");
			location.reload();
			$('.Delete_Acc_form').hide();
			$('.admin-accounts-list').show();
		});
	});

	$('.btnAcc_Cancel').click(function() {
		$('.Delete_Acc_form').hide(500);
		$('.admin-accounts-list').show();
	});

	$('.btnSaveUpdateAcc').click(function() {
		var upd_name = $('.inputAccUpdateName').val().trim();
		var upd_UN = $('.inputAccUpdateUsername').val().trim();
		var upd_pass = $('.inputAccUpdatePassword').val().trim();
		var upd_con = $('.inputAccUpdateConfirmPass').val().trim();
		if(upd_name == "" || upd_UN == "" || upd_pass == "" || upd_con == ""){
			alert("Hãy điền đầy đủ thông tin !");
		}
		else if(upd_pass != upd_con){
			alert("Xác nhận lại mật khẩu !");
		}
		else{
			$.ajax({
				url: '../xuly.php',
				type: 'POST',
				data: {
					updateId : AccId,
					updateName : upd_name,
					updateUN : upd_UN,
					updatePass : upd_pass
				},
			})
			.done(function(res) {
				if(res == "done"){
					alert("Đã lưu thay đổi !");
					location.reload();
					$('.Edit_Acc_form').hide(500);
					$('.admin-accounts-list').show();
				}
				else{
					alert("Tên đăng nhập đã tồn tại !");
				}
			});
		}
	});

	$('.btnCancelUpdateAcc').click(function() {
		$('.Edit_Acc_form').hide(500);
		$('.admin-accounts-list').show();
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
function Delete_Acc_Id(thisid){
	$('.Delete_Acc_form').show();
	$('.admin-accounts-list').hide(200);
	AccId = thisid;
}
function Update_Acc_Id(thisId){
	$('.Edit_Acc_form').show();
	$('.admin-accounts-list').hide(200);
	AccId = thisId;
}