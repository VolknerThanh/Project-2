function RedirectToDetail(idfood) {
	var link = "Details.php?idfood=" + idfood;
	location.href = link;
}
var editThisId = -1;
var AccId = -1;
var mtr_id = -1;
var foodId = -1;

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
					$('.Add_Acc_form').hide(500);
					$('.admin-accounts-list').show();
					location.reload();
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
			$('.admin-accounts-list').show();
			$('.Delete_Acc_form').hide();
			location.reload();
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
					$('.Edit_Acc_form').hide(500);
					$('.admin-accounts-list').show();
					location.reload();
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

   // ============== Materials ==============

    $('.btnAddMaterials').click(function() {
		$('.Add_mtr_form').show();
		$('.admin-materials-list').hide(200);
    });

    $('.btnCancelAddMTR').click(function() {
		$('.Add_mtr_form').hide(500);
		$('.admin-materials-list').show();
    });
    $('.btnCancelEditMTR').click(function() {
		$('.Edit_mtr_form').hide(500);
		$('.admin-materials-list').show();
    });
    $('.btnCancelDelMTR').click(function() {
		$('.Delete_mtr_form').hide(500);
		$('.admin-materials-list').show();
    });

    $('.btnDelMTR').click(function() {
    	$.ajax({
    		url: '../xuly.php',
    		type: 'POST',
    		data: { Mtr_Id : mtr_id },
    	})
    	.done(function(res) {
    		alert("Đã xóa nguyên liệu này !");
			$('.Delete_mtr_form').hide(500);
			$('.admin-materials-list').show();
    		location.reload();
    	});
    });

    $('.btnAddMTR').click(function() {
    	var mtrName = $('.inputAddMTRname').val().trim();
    	var mtrUnit = $('.inputAddMTRunit').val().trim();
    	if(mtrName == "" || mtrUnit == "")
    		alert("Hãy điền đầy đủ thông tin !");
    	else{
    		$.ajax({
    			url: '../xuly.php',
    			type: 'POST',
    			data: {
    				mtr_name : mtrName,
    				mtr_unit : mtrUnit
    			},
    		})
    		.done(function(res) {
    			if(res == "done"){
    				alert('Đã lưu vào cơ sở dữ liệu !');
					$('.Add_mtr_form').hide(500);
					$('.admin-materials-list').show();
    				location.reload();
    			}
    			else
    				alert('Nguyên liệu "'+mtrName+'" đã tồn tại !');
    		});
    	}
    });
    $('.btnEditMTR').click(function() {
    	var edit_name = $('.inputEditMTRname').val().trim();
    	var edit_unit = $('.inputEditMTRunit').val().trim();
    	if(edit_name == "" || edit_unit == "")
    		alert('Hãy điền đầy đủ thông tin !');
    	else{
    		$.ajax({
    			url: '../xuly.php',
    			type: 'POST',
    			data: {
    				editName: edit_name,
    				editUnit: edit_unit,
    				editId: mtr_id
    			},
    		})
    		.done(function(res) {
    			if(res == "done"){
    				alert("Đã lưu thay đổi !");
					$('.Add_mtr_form').hide(500);
					$('.admin-materials-list').show();
    				location.reload();
    			}
    			else
    				alert('Nguyên liệu "'+edit_name+'" đã tồn tại !');
    		});
    		
    	}
    });

    /* --------- FOODS ----------*/

    $('.btnAddFoods').click(function() {
    	$('.Add_foods_form').show();
    	$('.admin-foods-list').hide(200);
    });
    $('.btnCancelAddFoods').click(function() {
    	$('.Add_foods_form').hide(500);
    	$('.admin-foods-list').show();
    });
    $('.btnCancelEditFoods').click(function() {
    	$('.Edit_foods_form').hide(500);
    	$('.admin-foods-list').show();
    });
    $('.btnCancelDeleteFoods').click(function() {
    	$('.Delete_foods_form').hide(500);
    	$('.admin-foods-list').show();
    });

    $('.btnSaveEditFoods').click(function() {
    	var inputEditFood = $('.inputEditFoodName').val().trim();
    	if(inputEditFood == "")
    		alert('Hãy điền đầy đủ thông tin !');
    	else {
    		$.ajax({
    			url: '../xuly.php',
    			type: 'POST',
    			data: {
    				editContent: inputEditFood,
    				FoodID : foodId
    			},
    		})
    		.done(function(res) {
    			if(res == "done"){
    				alert('Đã lưu thay đổi !');
			    	$('.Edit_foods_form').hide(500);
			    	$('.admin-foods-list').show();
    				location.reload();
    			}
    			else {
    				alert("Món ăn tên '" + inputEditFood + "' đã tồn tại !");
    			}
    		});
    	}
    });

    $('.btnDeleteFoods').click(function() {
    	$.ajax({
    		url: '../xuly.php',
    		type: 'POST',
    		data: {DelFoodID: foodId},
    	})
    	.done(function() {
    		alert("Đã xóa món này !");
	    	$('.Delete_foods_form').hide(500);
	    	$('.admin-foods-list').show();
			location.reload();
    	});
    });

    /* ============================================= */
    /* ===================Details=================== */

    $('.btnAddFoodMTR').click(function() {
    	$('.Add_details_form').show();
    	$('.admin-details-list').hide(200);
    });


});

/* =========================================== */
/* =========================================== */
/* =========================================== */
/* =========================================== */
/* =========================================== */

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
	location.href = "adminListFoods.php?idmethod="+thisId;
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
function Edit_MTR(thisID){
	$('.Edit_mtr_form').show();
	$('.admin-materials-list').hide(200);
	mtr_id = thisID;
}
function Delete_MTR(thisID){
	$('.Delete_mtr_form').show();
	$('.admin-materials-list').hide(200);
	mtr_id = thisID;
}
function ToDetails(foodID){
	location.href = "adminListFoodsDetails.php?idfood="+foodID;	
}
function Edit_food(ThisId){
	$('.Edit_foods_form').show();
	$('.admin-foods-list').hide(200);
	foodId = ThisId;
}
function Delete_food(ThisId){
	$('.Delete_foods_form').show();
	$('.admin-foods-list').hide(200);
	foodId = ThisId;
}