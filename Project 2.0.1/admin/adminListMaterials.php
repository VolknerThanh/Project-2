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
			<?php
				include ("..db/database.php");
				$materialsList = getDataByTable("materials");
				$foreach ($materialsList as $value) {
					$mtr_name = $value['Material_name'];
					$mtr_id = $value['IdMaterial'];
					$mtr_unit = $value['Material_Unit'];
			?>
			<div class="methods-wrapper">
				<div class="admin-methods-item" onclick="toInfo('<?php echo $method_id ?>');">
					<?php echo $method_name; ?>
				</div>
				<i class="fa fa-edit" onclick="Edit_Method_Id('<?php echo $method_id; ?>'); " style="font-size: 3em; margin: 1em"></i>
				<i class="material-icons" onclick="Delete_Method_Id('<?php echo $method_id; ?>');" style="font-size:3em; margin: 1em">delete</i>
			</div>

			<?php
				}
			?>
		</div>
	</div>



</body>
</html>