<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Quản lý</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>OK</h1>
	Chúc mừng bạn có username là <?php echo $_SESSION['username'];  ?>
</body>
</html>