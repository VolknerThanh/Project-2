<?php 
session_start();
if( !isset($_SESSION['username']))
	header('Location: login.php');

include ("../db/database.php");

if(!empty($_GET['idfood'])){
	$idfood = $_GET['idfood'];
	$foodname = getFoodName($idfood);

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
	<script src="../lib/scripts.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

	<style>
		.prevImg, .nextImg{
	        top: 55%;
		}
	</style>

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

	<div class="steps-container" style="padding: 0 0">
		<h1 class="container-title">Các bước làm <?php echo $foodname; ?></h1>
		
		<div class="slideShow">
			<!-- step dots -->
			<div class="imageDot-container">
			<?php 
				$imgSteps = loadStepByFoodId($idfood);
				foreach ($imgSteps as $value) { ?>
				<div class="imageStep" onclick="currentSlide(<?php echo $value['Step']; ?>)";>
					<div><?php echo $value['Step']; ?></div>
				</div>	
				<?php }
			?>
			</div>
			<br>
			<!-- Slide Images -->
			<?php
				foreach ($imgSteps as $value) { ?>
				<div class="image">
					<img src="../<?php echo $value["Link"]; ?>" alt="Bước <?php echo $value["Step"]; ?>">
				</div> <?php }
			?>
			<!-- button next / previous -->
			<div class="prevImg" onclick="nextSlide(-1);">&#10094;</div>
			<div class="nextImg" onclick="nextSlide(1);">&#10095;</div>
			<!-- describe -->
			<h1>Miêu tả cách làm : </h1>
			<div class="describe-container">
			<?php 
				foreach ($imgSteps as $value) { ?>
				<div class="describe">
					<span><?php echo $value['Summary']; ?></span>
				</div>
				<?php }
			?>
			</div>
			<script src="../lib/image.js"></script>
		</div>
	</div>
	
</body>
</html>
<?php } else { ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ERROR</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script>
</head>
<body>
	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user"><?php echo $_SESSION['username']; ?> </span>
	</div>

	<h1 style="text-align: center; font-size: 5em">404 NOT FOUND !</h1>
</body>
</html>

<?php } ?>