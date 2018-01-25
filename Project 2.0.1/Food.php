<?php
	include("db/database.php");

	if(!empty( $_GET['idmethod'])) {
		$name = getMethodName($_GET['idmethod']);
	}
	else{
		$name = "404 Not Found";
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>phương thức <?php echo $name ?></title>
	<!-- references -->
	<link rel="stylesheet" href="layout/styles.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
</head>
<body>
	
	<div class="foods-container">
		<h1 class="container-title">Các Món Theo Phương Thức <?php echo $name ?></h1>
		<?php
			if(CountFoodInMethod($_GET['idmethod']) == 0){
		?>
			<h1>Không có món ăn trong phương thức này !</h1>
		<?php
			}
			else {
		?>
			<div class="foods-list">
				<?php
					$foodList = load_foods_by_method($_GET['idmethod']);
					foreach ($foodList as $value) {
				?>
				<div class="foods-item" onclick="RedirectToDetail(<?php echo $value['IdFood']; ?>);">
					<?php echo $value['FoodName'] ?>
				</div>
				<?php
					}
				?>
			</div>
		<?php
			}
		?>
	</div>

</body>
</html>