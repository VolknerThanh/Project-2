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
	<title>Nguyên Liệu</title>
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
	</div>

	<div class="details-container">
		<h1 class="container-title">Danh Sách Các Nguyên Liệu</h1>
		<div class="admin-materials-list">
			<div class="btn btnAddMaterials">Thêm nguyên liệu</div>
			<br><br>
			<table>
				<tbody>
					<tr>
						<td class="TableTitle" style="width: 50%">Tên nguyên liệu</td>
						<td class="TableTitle" style="width: 20%">Đơn vị</td>
						<td class="TableTitle" style="width: 30%">Cài đặt</td>
					</tr>
				<?php
					include ("../db/database.php");
					$materialsList = getDataByTable("materials");
					foreach ($materialsList as $value) {
						$mtr_name = $value['Material_name'];
						$mtr_id = $value['IdMaterial'];
						$mtr_unit = $value['Material_Unit'];
				?>
				<tr>
					<td><div class="admin-Material-Item" style="background-color: #583d59;"><?php echo $mtr_name; ?></div></td>
					<td><div class="admin-Material-Item" style="background-color: #511623"><?php echo $mtr_unit; ?></div></td>
					<td>
						<i class="fa fa-edit" onclick="Edit_MTR(<?php echo $mtr_id; ?>);" style="font-size: 2em; margin: 1em"></i>
						<i class="material-icons" onclick="Delete_MTR(<?php echo $mtr_id; ?>);" style="font-size: 2em; margin: 1em">delete</i>
					</td>
				</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="Add_mtr_form">
		<h1 style="text-align: center; font-size: 3em;">Thêm nguyên liệu mới</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập thông tin nguyên liệu mới: </label>
			<input class="inputAddMTRname" type="text" name="inputAddMTRname" placeholder="Nhập tên nguyên liệu ... ">
			<input class="inputAddMTRunit" type="text" name="inputAddMTRunit" placeholder="Nhập tên đơn vị ... ">
			<button class="btn btnAddMTR">Lưu</button>
			<button class="btn btnCancelAddMTR">Hủy</button>
		</center>
	</div>

	<div class="Edit_mtr_form">
		<h1 style="text-align: center; font-size: 3em;">Cập nhật nguyên liệu</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập thông tin cần thay đổi: </label>
			<input class="inputEditMTRname" type="text" name="inputEditMTRname" placeholder="Nhập tên nguyên liệu ... ">
			<input class="inputEditMTRunit" type="text" name="inputEditMTRunit" placeholder="Nhập tên đơn vị ... ">
			<button class="btn btnEditMTR">Lưu</button>
			<button class="btn btnCancelEditMTR">Hủy</button>
		</center>
	</div>

	<div class="Delete_mtr_form">
		<h1 style="text-align: center; font-size: 3em;">Xóa nguyên liệu</h1>
		<br>
		<center>
			<h2 style="color: red">* Lưu ý : nếu xóa nguyên liệu này, những món ăn chứa nguyên liệu này cũng sẽ bị xóa theo !</h2>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Xác nhận xóa nguyên liệu này: </label>
			<button class="btn btnDelMTR">Xóa</button>
			<button class="btn btnCancelDelMTR">Hủy</button>
		</center>
	</div>

</body>
</html>