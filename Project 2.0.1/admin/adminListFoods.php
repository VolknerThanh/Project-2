<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}
if(!empty($_GET['idmethod'])){
	$idmethod = $_GET['idmethod'];

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("../db/database.php");
$_methodName = getMethodName($idmethod);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>phương thức <?php echo $_methodName; ?></title>
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="../layout/input.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="../lib/scripts.js"></script>
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Dhurjati|Grand+Hotel|Inconsolata|Italianno|Pacifico|Rochester" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user"><?php echo $_SESSION['username']; ?> </span>
		<a href="index.php" title="trang chủ"><i class="fa fa-home" style="font-size:200%; color:white;"></i></a>
	</div>
	
	<div class="foods-container">
		<h1 class="container-title">Danh Sách Các Món</h1>
		<div class="admin-foods-list">
			<div class="btn btnAddFoods">Thêm Món Cho Phương Thức Này</div>
			<br>
			<table>
				<tbody>
					<tr>
						<td class="TableTitle" style="width: 70%">Tên Món Ăn</td>
						<td class="TableTitle" style="width: 30%">Chức Năng</td>
					</tr>
					<?php
						$foodList = load_foods_by_method($idmethod);
						foreach ($foodList as $value) {
							$food_name = $value['FoodName'];
							$food_id = $value['IdFood'];
							$method_id = $value['IdMethod'];
					?>

					<tr>
						<td>
							<div class="admin-foods-item" onclick="ToDetails(<?php echo $food_id; ?>);" style="background-color: #60281f;">
								<?php echo $food_name; ?>
							</div>
						</td>
						<td>
							<i class="fa fa-edit" onclick="Edit_food(<?php echo $food_id; ?>);" style="font-size: 2.5em; margin: 1em"></i>
							<i class="material-icons" onclick="Delete_food(<?php echo $food_id; ?>);" style="font-size: 2.5em; margin: 1em">delete</i>
						</td>
					</tr>

					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="Add_foods_form">
		<h1 style="text-align: center; font-size: 3em;">Thêm món ăn theo phương thức</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập tên món ăn :</label>
			<input class="inputAddFoodName" type="text" name="inputAddFoodName" placeholder="Nhập tên món ... ">
			<button class="btn btnSaveAddFoods">Lưu</button>
			<button class="btn btnCancelAddFoods">Hủy</button>
		</center>
	</div>

	<div class="Edit_foods_form">
		<h1 style="text-align: center; font-size: 3em; width: 100%">Sửa Tên Món Ăn</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Sửa tên món ăn :</label>
			<input class="inputEditFoodName" type="text" name="inputEditFoodName" placeholder="Nhập tên món ... ">
			<button class="btn btnSaveEditFoods">Lưu</button>
			<button class="btn btnCancelEditFoods">Hủy</button>
		</center>
	</div>

	<div class="Delete_foods_form">
		<h1 style="text-align: center; font-size: 3em; width: 100%">Xóa Món Ăn Này</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Xác nhận xóa món này :</label>
			<button class="btn btnDeleteFoods">Xóa</button>
			<button class="btn btnCancelDeleteFoods">Hủy</button>
		</center>
	</div>

	<script type="text/javascript">
		$('.btnSaveAddFoods').click(function() {
    	var FoodInfo = $('.inputAddFoodName').val().trim();

    	if(FoodInfo == "")
    		alert('Hãy điền đầy đủ thông tin !');
    	else {
    		$.ajax({
    			url: '../xuly.php',
    			type: 'POST',
    			data: {
    				foodname: FoodInfo,
    				foodmethodid: <?php echo $idmethod ?>
    			},
    		})
    		.done(function(res) {
    			if(res == "done"){
    				alert('Đã lưu thay đổi !');
			    	$('.Add_foods_form').hide(500);
			    	$('.admin-foods-list').show();
    				location.reload();
    			}
    			else {
    				alert("Món ăn tên '" + FoodInfo + "' đã tồn tại !");
    			}
    		});
    		
    	}
    });
	</script>
</body>
</html>

<?php 
} else {
?>

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