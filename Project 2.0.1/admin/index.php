<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("../db/database.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Quản lý</title>
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/input.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
				$('.searchFoodDetailsAdmin').autocomplete({
					source:array
				});
			}); 
		</script>

</head>
<body>
	
	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user">	<?php echo $_SESSION['username']; ?> </span>
		<a href="index.php" title="trang chủ"><i class="fa fa-home" style="font-size:200%; color:white;"></i></a>
	</div>

	<div style="margin: 1.5em;">
		<div class="ui-widget" style="display: flex; justify-content: center; align-items: center;">
			<input type="text" style="width: 100%; padding: 0.3em auto" class="searchFoodDetailsAdmin" name="searchFoodDetailsAdmin" placeholder="Nhập vào tên món ăn">
		</div>
		<br>
		<div style="display: flex; justify-content: center; align-items: center;"><div class="btn btnSearchDetailsAdmin">Search</div></div>
	</div>

			
	<div class="methods-container">
		<h1>Khu vực quản lý</h1>
		<div class="list-box">
			<div class="box-items" onclick=" location.href='adminListAccounts.php' ">
				Tài Khoản
			</div>
			<div class="box-items" onclick=" location.href='adminListMethods.php' ">
				Phương Thức
			</div>
			<div class="box-items" onclick=" location.href='adminListMaterials.php' ">
				Nguyên Liệu
			</div>
			<div class="box-items" onclick=" location.href='adminListImages.php' ">
				Hình Ảnh
			</div>
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
			
			$('.btnSearchDetailsAdmin').click(function() {
				var inputcontents =  $('.searchFoodDetailsAdmin').val().trim();
				if(inputcontents == '' || inputcontents == null)
					alert("Hãy điền tên món ăn đầy đủ !");
				else{
					
					if(CheckExistedInDB(inputcontents, array)) {
						$.ajax({
							url: '../xuly.php',
							type: 'POST',
							data: {SearchFoodName: inputcontents},
						})
						.done(function(res) {
							location.href = "adminListFoodsDetails.php?idfood="+res;
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