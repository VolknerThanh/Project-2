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
	<title>Quản lý</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script>
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Dhurjati|Grand+Hotel|Inconsolata|Italianno|Pacifico|Rochester" rel="stylesheet">
	<!--
		font-family: 'Dhurjati', sans-serif;
		font-family: 'Inconsolata', monospace;
		font-family: 'Pacifico', cursive;
		font-family: 'Rochester', cursive;
		font-family: 'Bungee Hairline', cursive;
		font-family: 'Italianno', cursive;
		font-family: 'Grand Hotel', cursive;
	-->

</head>
<body>
	

	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user">	<?php echo $_SESSION['username']; ?> </span>
	</div>

			
	<div class="methods-container">
		<h1>Khu vực quản lý</h1>
		<div class="list-box">
			<div class="box-items" onclick=" location.href='adminListAccounts.php' ">
				Tài Khoản
			</div>
			<div class="box-items" onclick=" location.href='adminListMethods.php' ">
				Phương Thức
			</div>
			<div class="box-items" onclick=" location.href='adminListMaterials.php' ">
				Nguyên Liệu
			</div>
		</div>
	</div>

	
</body>
</html>