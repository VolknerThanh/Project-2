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
	<title>Phương thức</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/input.css">
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

	<div class="methods-container">
		<h1 class="container-title">Danh Sách Các Phương Thức</h1>
		<div class="admin-methods-list">
			<div class="btn btnAddMethods">Thêm phương thức</div>
			<?php
				include("../db/database.php");
				$methodList = getDataByTable("foodmethods");
				foreach ($methodList as $value) {
					$method_name = $value['FM_name'];
					$method_id = $value['FM_id'];
			?>
				<div class="methods-wrapper">
					<div class="admin-methods-item" title="click vào để xem thông tin" onclick="toInfo('<?php echo $method_id ?>');">
						<?php echo $method_name; ?>
					</div>
					<i class="fa fa-edit" onclick="Edit_Method_Id('<?php echo $method_id; ?>'); " style="font-size: 3em; margin: 1em"></i>
					<i class="material-icons" onclick="Delete_Method_Id('<?php echo $method_id; ?>');" style="font-size:3em; margin: 1em">delete</i>
				</div>
			<?php
				}
			?>
		</div>

		<div class="Add_form">
			<h1 style="text-align: center; font-size: 3em;">Thêm phương thức</h1>
			<br>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập tên cần thêm</label>
			<input class="inputAddName" type="text" name="inputAddName" placeholder="Nhập tên ... ">
			<button class="btn btnAddNew">Lưu</button>
			<button class="btn btnCancelNew">Hủy</button>
		</div>

		<div class="Edit_form">
			<h1 style="text-align: center; font-size: 3em;">Sửa tên phương thức</h1>
			<br>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập tên cần sửa</label>
			<input class="inputEditName" type="text" name="inputEditName" placeholder="Nhập tên ... ">
			<button class="btn btnSave-NewName">Lưu</button>
			<button class="btn btnCancel-NewName">Hủy</button>
		</div>

		<div class="Delete_form">
			<h1 style="text-align: center; font-size: 3em;">Xóa phương thức</h1>
			<br>
			<br>
			<h2 style="color: red">* Lưu ý : nếu xóa phương thức này, những món ăn thuộc phương thức này cũng sẽ bị xóa theo !</h2>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Xác nhận xóa phương thức này</label>
			<button class="btn btnTrue">Xóa</button>
			<button class="btn btnFalse">Hủy</button>
		</div>


	</div>

	

</body>
</html>