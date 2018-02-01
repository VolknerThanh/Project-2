<?php 

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
	<title>Các phương thức</title>
	<!-- references -->
	<link rel="stylesheet" href="layout/styles.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
</head>
<body>
	<div class="methods-container">
		<h1 class="container-title">Danh Sách Các Phương Thức</h1>
		<div class="methods-list">
			<?php
				include("db/database.php");
				$methodList = getDataByTable("foodmethods");
				foreach ($methodList as $value) {
			?>
				<div class="methods-item" onclick="location.href='Food.php?idmethod=<?php echo $value['FM_id'] ?>'">
					<?php echo $value['FM_name']; ?>
				</div>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>