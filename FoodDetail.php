<?php
	include("db/database.php");

	$idfood = $_GET['idfood'];

	function ShowFoodName($id){
		global $conn;
		$query = "SELECT `FoodName` FROM `foods` WHERE `IdFood` = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc()['FoodName'];;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo ShowFoodName($idfood); ?></title>
	<link rel="stylesheet" href="css/styles.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
</head>
<body>
	
	<div class="foodDetails-container">
		<a href="FoodMaterials.php" target="_blank" class="link-to-materials">Xem những nguyên liệu có sẵn</a>
		<h1 style="margin: .5em;">Thêm nguyên liệu</h1>
		<input type="text" name="searchMaterials" class="searchMaterials" maxlength="20" placeholder="Tìm tên nguyên liệu...">

		<div class="materials-list-of-food">

		</div>
	</div>

</body>
</html>