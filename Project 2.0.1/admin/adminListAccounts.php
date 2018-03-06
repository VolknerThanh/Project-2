<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tài Khoản</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script>
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Dhurjati|Grand+Hotel|Inconsolata|Italianno|Pacifico|Rochester" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user"><?php echo $_SESSION['username']; ?> </span>
		<a href="index.php" title="trang chủ"><i class="fa fa-home" style="font-size:200%; color:white;"></i></a>
	</div>

	<div class="accounts-container">
		<h1 class="container-title">Danh Sách Các Tài Khoản Được Phép Truy Cập</h1>
		<div class="admin-accounts-list">
			<div class="btn btnAddAccounts">Thêm Tài Khoản</div>
			<br>
			<table>
				<tbody>
					<tr>
						<td class="TableTitle" style="width: 24%">Names</td>
						<td class="TableTitle" style="width: 26%">Username</td>
						<td class="TableTitle" style="width: 33%">Password</td>
						<td class="TableTitle" style="width: 18%">Options</td>
					</tr>
					<?php
						include("../db/database.php");
						$accountsList = getDataByTable("account");
						foreach ($accountsList as $value) {
							$accId = $value['Id'];
							$accName = $value['Names'];
							$accUserName = $value['Username'];
							$accPassword = $value['Password'];
					?>
					<tr>
						<td><div class="AccountItems" style="background-color: #b7b7b7"><?php echo $accName;?></div></td>
						<td><div class="AccountItems" style="background-color: #898989"><?php echo $accUserName;?></div></td>
						<td><div class="AccountItems" style="background-color: #b7b7b7"><?php echo $accPassword;?></div></td>
						<td>
							<i class="fa fa-edit" onclick="Update_Acc_Id(<?php echo $accId; ?>)" style="font-size: 1.8em;"></i>
							<i class="material-icons" onclick="Delete_Acc_Id('<?php echo $accId; ?>');" style="font-size:1.8em;">delete</i>
						</td>
					</tr>
					<?php
						}
					?>

				</tbody>
			</table>

		</div>
	</div>
	
	<div class="Add_Acc_form">
			<h1 style="text-align: center; font-size: 3em;">Thêm tài khoản</h1>
			<br>
			<center>
				<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập thông tin tài khoản mới :</label>
				<input class="inputAccAddName" type="text" name="inputAccAddName" placeholder="Họ tên ... ">
				<input class="inputAccAddUsername" type="text" name="inputAccAddUsername" placeholder="Tên đăng nhập ... ">
				<input class="inputAccAddPassword" type="password" maxlength="20" name="inputAccAddPassword" placeholder="Mật khẩu... ">
				<input class="inputAccConfirmPass" type="password" maxlength="20" name="inputAccConfirmPass" placeholder="Xác nhận mật khẩu... ">
				<button class="btn btnSaveNewAcc">Lưu</button>
				<button class="btn btnCancelNewAcc">Hủy</button>
			</center>
		</div>

		<div class="Edit_Acc_form">
			<h1 style="text-align: center; font-size: 3em;">Sửa thông tin tài khoản</h1>
			<br>
			<center>
				<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập thông tin cần sửa</label>
				<input class="inputAccUpdateName" type="text" name="inputAccUpdateName" placeholder="Họ tên ... ">
				<input class="inputAccUpdateUsername" type="text" name="inputAccUpdateUsername" placeholder="Tên đăng nhập ... ">
				<input class="inputAccUpdatePassword" type="password" maxlength="20" name="inputAccUpdatePassword" placeholder="Mật khẩu... ">
				<input class="inputAccUpdateConfirmPass" type="password" maxlength="20" name="inputAccUpdateConfirmPass" placeholder="Xác nhận mật khẩu... ">
				<button class="btn btnSaveUpdateAcc">Lưu</button>
				<button class="btn btnCancelUpdateAcc">Hủy</button>
			</center>
		</div>

		<div class="Delete_Acc_form">
			<h1 style="text-align: center; font-size: 3em;">Xóa tài khoản</h1>
			<br>
			<br>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Xác nhận xóa tài khoản này</label>	
			<center>
				<button class="btn btnAcc_Confirm">Xóa</button>
				<button class="btn btnAcc_Cancel">Hủy</button>
			</center>
		</div>

</body>
</html>