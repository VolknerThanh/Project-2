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
	<style type="text/css" media="screen">
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
			background-color: #20ad33;
		}
		.noti-fail{
			background-color: #ff1e3c;
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
        ?><div class="noti noti-success"><?php echo "File is an image - " . $check["mime"] . "."; ?></div><?php
        $uploadOk = 1;
    } else {
        ?><div class="noti noti-fail"><?php echo "File is not an image."; ?></div><?php
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    ?><div class="noti noti-fail"><?php echo "Sorry, file already exists."; ?></div><?php
    $uploadOk = 0;
}
// Check file size
if ($_FILES["uploadInput"]["size"] > 25000000) {
    ?><div class="noti noti-fail"><?php echo "Sorry, your file is too large."; ?></div><?php
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    ?><div class="noti noti-fail"><?php echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; ?></div><?php
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    ?><div class="noti noti-fail"><?php echo "Sorry, your file was not uploaded."; ?></div><?php
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploadInput"]["tmp_name"], $target_file)) {
        ?><div class="noti noti-success"><?php  echo "The file ". basename( $_FILES["uploadInput"]["name"]). " has been uploaded.";?></div><?php
    } else {
        ?><div class="noti noti-fail"><?php echo "Sorry, there was an error uploading your file."; ?></div><?php
    }
}
?>

</body>
</html>