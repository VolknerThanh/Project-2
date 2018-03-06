<?php 

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("db/database.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Các phương thức</title>
	<!-- references -->
	<link rel="stylesheet" href="layout/styles.css">
	<link rel="stylesheet" href="layout/main.css">	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="lib/scripts.js"></script>

	<script>
		var array = [];
		<?php
			$this_array = getDataByTable("Foods");
			foreach ($this_array as $value) {
		?>
			array.push("<?php echo $value["FoodName"] ?>");
		<?php
			}
		?>
		$( function() {
			$('.searchFoodDetails').autocomplete({
				source:array
			});
		}); 
	</script>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.methods-container').hide();
		});
	</script>
	<div style="margin: 1.5em;">
		<div class="ui-widget" style="display: flex; justify-content: center; align-items: center;">
			<input type="text" style="width: 100%; padding: 0.3em auto" class="searchFoodDetails" name="searchFoodDetails" placeholder="Nhập vào tên món ăn">
		</div>
		<br>
		<div style="display: flex; justify-content: center; align-items: center;"><div class="btn btnSearchDetails">Search</div></div>
	</div>
	<div style="display: flex; align-items: center; justify-content: center">
		<div class="btn btnShowOrHideOption" onclick="$('.methods-container').toggle();">
			Ẩn / hiện các tùy chọn khác
		</div>
	</div>

	<div class="methods-container">
		<h1 class="container-title">Danh Sách Các Phương Thức</h1>
		<div class="methods-list">
			<?php
				//include("db/database.php");
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

	<script type="text/javascript">

		function CheckExistedInDB(thiselement, thisarray){
			var isExisted = false;
			thisarray.some( function(element, index) {
				if(element == thiselement){
					isExisted = true;
				}
			});
			return isExisted;
		}

		$(document).ready(function() {
			
			$('.btnSearchDetails').click(function() {
				var inputcontents =  $('.searchFoodDetails').val().trim();
				if(inputcontents == '' || inputcontents == null)
					alert("Hãy điền tên món ăn đầy đủ !");
				else{
					
					if(CheckExistedInDB(inputcontents, array)) {
						$.ajax({
							url: 'xuly.php',
							type: 'POST',
							data: {SearchFoodName: inputcontents},
						})
						.done(function(res) {
							location.href = "Details.php?idfood="+res;
						});
					}
					else
						alert("Không tìm thấy món ăn tên '" + inputcontents +"' !");
				}
			});
		});
	</script>
</body>
</html>