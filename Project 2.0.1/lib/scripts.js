function RedirectToDetail(idfood) {
	var link = "Details.php?idfood=" + idfood;
	location.href = link;
}
$(document).ready(function() {
	
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
				alert(res);
				if(res == "false")
					alert("Tên tài khoản hoặc mật khẩu sai !");
				else{
					alert("Đăng nhập thành công !");

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
});