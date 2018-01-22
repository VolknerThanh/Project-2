<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh sách nguyên liệu</title>
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	
	<div class="Materials-container">	
		<h1>Danh sách các nguyên liệu : </h1>
		<div class="Materials-list">
			<?php
				include ("db/database.php");
				$materials_list = load_materials();
				foreach($materials_list as $value)
				{
			?>
				<div class="Mrt-item">
					<p class="material_name"><?php echo $value['Material_name']; ?></p>
				</div>
			<?php
				}
			?>
		</div>
	</div>

</body>
</html>