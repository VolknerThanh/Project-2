<?php

include("db/database.php");

if(!empty($_GET['idfood'])){
	$foodid = $_GET['idfood'];
	$foodname = getFoodName($foodid);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $foodname; ?></title>
	<link rel="stylesheet" href="layout/styles.css">
	<link rel="stylesheet" href="layout/main.css">
	<link rel="stylesheet" href="layout/image.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
</head>
<body>
	
	<div class="steps-container" style="padding: 0 0">
		<h1 class="container-title">Các bước làm <?php echo $foodname; ?></h1>
		
		<div class="slideShow">
			<!-- Slide Images -->
			<?php
				$imgSteps = loadStepByFoodId($foodid);
				foreach ($imgSteps as $value) { ?>
				<div class="image">
					<img src="<?php echo $value["Link"]; ?>" alt="Bước <?php echo $value["Step"]; ?>">
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
			<!-- step dots -->
			<div class="imageDot-container">
			<?php 
				foreach ($imgSteps as $value) { ?>
				<div class="imageStep" onclick="currentSlide(<?php echo $value['Step']; ?>)";>
					<div><?php echo $value['Step']; ?></div>
				</div>	
				<?php }
			?>
			</div>
			<script src="lib/image.js"></script>
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
</head>
<body>
	<h1 style="text-align: center; font-size: 200%">404 Not Found</h1>
</body>
</html>
<?php } ?>