<?php 
session_start();
if( !isset($_SESSION['username']))
	header('Location: login.php');

include ("../db/database.php");

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
	<title>Hình ảnh</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/image.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<span class="user"><?php echo $_SESSION['username']; ?> </span>
		<a href="index.php" title="trang chủ"><i class="fa fa-home" style="font-size:200%; color:white;"></i></a>
	</div>

	<div class="ImagesContainer">
		<fieldset style="width: 100%">
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<legend>Tải hình ảnh lên</legend>
				<input type="file" name="uploadInput" class="uploadInput">
				<br>
				<input type="submit" name="sbm_btn" class="sbm_btn" value="Upload">
			</form>
		</fieldset>
			
	</div>


	
</body>
</html>