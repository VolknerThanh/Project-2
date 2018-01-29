<?php
session_start();


include("../db/database.php");

if( !empty($_POST['username']) && !empty($_POST['password']) ){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(CheckAccount($username, $password) == "false")
		echo CheckAccount($username, $password);
	else{

		$_SESSION['username'] = $username;
		echo CheckAccount($username, $password);
	}
	die();
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng Nhập</title>
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/main.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script>
</head>
<body>



	<div class="login-container">
		<?php 

			$query = "SELECT * FROM account";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->get_result();

			if($res->num_rows == 0) {
		?>

			<h1 class="container-title">Đăng Ký Tài Khoản Admin</h1>

			
				<table class="signup-form">
					<tbody>
						<tr>
							<td><label>Họ và tên : </label></td>
							<td><input type="text" name="names-input" class="names-input UserInfo" placeholder="Nhập tên..."></td>
						</tr>
						<tr>
							<td><label>Tên đăng nhập : </label></td>
							<td><input type="text" name="username-input" class="username-input UserInfo" placeholder="Nhập tên đăng nhập..."></td>
						</tr>
						<tr>
							<td><label>Mật Khẩu : </label></td>
							<td><input type="password" name="password-input" class="password-input UserInfo" placeholder="Nhập mật khẩu..."></td>
						</tr>
						<tr>
							<td><label>Xác nhận mật khẩu : </label></td>
							<td><input type="password" name="confirm-password-input" class="confirm-password-input UserInfo" placeholder="Xác nhận mật khẩu..."></td>
						</tr>
						<tr>
							<td></td>
							<td><div class="btn btn-signup">Đăng ký</div></td>
						</tr>
					</tbody>
				</table>
			
			

		<?php
			} else {
		?>

			<h1 class="container-title">Đăng Nhập Tài Khoản Admin</h1>

			<table class="login-form">
				<tbody>
					<tr>
						<td><label>Tên đăng nhập : </label></td>
						<td><input type="text" name="username-login" class="username-login UserInfo" placeholder="Nhập tên đăng nhập..."></td>
					</tr>
					<tr>
						<td><label>Mật Khẩu : </label></td>
						<td><input type="password" name="password-login" class="password-login UserInfo" placeholder="Nhập mật khẩu..."></td>
					</tr>
					<tr>
					</tr>
						<td></td>
						<td><div class="btn btn-login">Đăng nhập</div></td>
				</tbody>
			</table>

		<?php
			}
		?>

	</div>
	
	

</body>
</html>