<?php
session_start();
if( !isset($_SESSION['username']))
	header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Upload Hình Ảnh</title>
	<link rel="stylesheet" href="../layout/styles.css">
	<style type="text/css" media="screen">
		.btn_back{
			width: 15%;
			text-align: center;
			background-color: #6b7172;
			text-transform: uppercase;
			margin-top: 1em;
		}
		.noti{
			margin: 0.5em;
			padding: 1em;
			font-size: 120%;
			font-weight: 600;
			color: white;
			border-radius: 10px;
			border: 1px solid #565656;
		}
		.noti-success{
			background-color: #34a858;
		}
		.noti-fail{
			background-color: #a34646;
		}
	</style>
</head>
<body>

<?php

$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["uploadInput"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploadInput"]["tmp_name"]);
    if($check !== false) {
        ?><div class="noti noti-success"><?php echo "File là dạng ảnh - " . $check["mime"] . "."; ?></div><?php
        $uploadOk = 1;
    } else {
        ?><div class="noti noti-fail"><?php echo "File không là dạng ảnh"; ?></div><?php
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    ?><div class="noti noti-fail"><?php echo "File đã tồn tại !"; ?></div><?php
    $uploadOk = 0;
}
// Check file size
if ($_FILES["uploadInput"]["size"] > 20000000) {
    ?><div class="noti noti-fail"><?php echo "File vượt quá kích thước 20MB !"; ?></div><?php
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    ?><div class="noti noti-fail"><?php echo "Chỉ cho phép các file JPG, JPEG, PNG & GIF !"; ?></div><?php
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    ?><div class="noti noti-fail"><?php echo "File không upload được !"; ?></div><?php
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploadInput"]["tmp_name"], $target_file)) {
        ?><div class="noti noti-success"><?php  echo "File [". basename( $_FILES["uploadInput"]["name"]). "] đã được upload !";?></div><?php
    } else {
        ?><div class="noti noti-fail"><?php echo "Xảy ra lỗi khi upload file này !"; ?></div><?php
    }
}
?>

	
<div style="display: flex; align-items: center; justify-content: center;">
	<div class="btn btn_back" onclick="location.href = 'adminListImages.php'">
		trở lại
	</div>
</div>

</body>
</html>