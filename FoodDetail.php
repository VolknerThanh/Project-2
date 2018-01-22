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
		return $result->fetch_assoc()['FoodName'];
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
	<title><?php echo ShowFoodName($idfood); ?></title>
	<link rel="stylesheet" href="css/styles.css">
	<!-- reference links -->
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

  	<script type="text/javascript">
  		var array = [];

		<?php
			$this_array = load_materials();

			forEach($this_array as $value) 
			{
		?>
			array.push("<?php echo $value['Material_name']; ?>");
		<?php
			}
		?>

		$( function() {
			$( ".searchMaterials" ).autocomplete({
			  source: array
			});
		});
  	</script>
</head>
<body>
	
	<div class="foodDetails-container">
		<a href="FoodMaterials.php" target="_blank" class="link-to-materials">Xem những nguyên liệu có sẵn</a>
		<h1 style="margin: .5em;">Thêm nguyên liệu</h1>
		<div style="display: flex; justify-content: center; align-items: center">
			<input type="text" name="searchMaterials" class="searchMaterials" maxlength="20" placeholder="Tìm tên nguyên liệu...">
			<div class="btn btn-addmtr-tofood">Thêm</div>
		</div>

		<div class="materials-list-of-food">

		</div>
	</div>

	<script type="text/javascript">
		$('.btn-addmtr-tofood')
	</script>
</body>
</html>