<?php 
session_start();
if( !isset($_SESSION['username']))
	header('Location: login.php');

if(!empty($_GET['idfood'])){
	$idfood = $_GET['idfood'];

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include ("../db/database.php");
$foodName = getFoodName($idfood);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $foodName ?></title>
	<link rel="stylesheet" href="../layout/styles.css">
	<link rel="stylesheet" href="../layout/main.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
	<script src="../lib/jquery-3.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../lib/scripts.js"></script>
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Dhurjati|Grand+Hotel|Inconsolata|Italianno|Pacifico|Rochester" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Scripts -->
	<script>
		var array = [];
		<?php 
			$this_array = getDataByTable("materials");
			forEach($this_array as $value) {
				$MTR_name = $value['Material_name'];
		?>
			array.push("<?php echo $MTR_name; ?>");
		
		<?php } ?>
		
		$( function() {
			$('.inputAddDetails').autocomplete({
				source: array
			});
			$('.inputEditDetails').autocomplete({
				source: array
			});
		});
	</script>

</head>
<body>

	<div class="menu-bar">
		<div class="btn btn-signout">Đăng xuất</div>
		<span class="user"><?php echo $_SESSION['username']; ?> </span>
		<a href="index.php" title="trang chủ"><i class="fa fa-home" style="font-size:200%; color:white;"></i></a>
	</div>

	<div class="details-container">
		<h1 class="container-title">Chi Tiết Món <?php echo $foodName ?></h1>
		<div class="admin-details-list">
			<div class="btn btnAddFoodMTR" onclick="AddDetails(<?php echo $idfood ?>);">Thêm Nguyên Liệu Cho Món Này</div>
			<br>
			<table>
				<tbody>
					<tr>
						<td class="TableTitle" style="width: 35%">Nguyên Liệu</td>
						<td class="TableTitle" style="width: 20%; padding: .5em .2em;">Số Lượng</td>
						<td class="TableTitle" style="width: 23%">Đơn Vị</td>
						<td class="TableTitle" style="width: 22%; padding: .5em .2em;">Chức Năng</td>
					</tr>
				<?php
					$detailList = load_food_details($idfood);
					foreach ($detailList as $value) {
						$MTR_id = $value['IdMaterial'];
						$MTR_name = $value['Material_name'];
						$MTR_quan = $value['Quantity'];
						$MTR_unit = $value['Material_Unit'];
				?>
				<tr>
					<td><div class="admin-details-item" style="background-color: #a02a0c;"><?php echo $MTR_name ?></div></td>
					<td><div class="admin-details-item" style="background-color: #201544"><?php echo $MTR_quan ?></div></td>
					<td><div class="admin-details-item" style="background-color: #371947"><?php echo $MTR_unit ?></div></td>
					<td>
						<i class="fa fa-edit" onclick="EditDetails(<?php echo $MTR_id ?>,<?php echo $idfood ?>);" style="font-size: 2.5em; margin: 0.5em"></i>
						<i class="material-icons" onclick="DeleteDetails(<?php echo $MTR_id ?>,<?php echo $idfood ?>);" style="font-size: 2.5em; margin: 0.5em">delete</i>
					</td>
				</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="Add_details_form">
		<h1 style="text-align: center; font-size: 3em;">Thêm Nguyên Liệu Cho Món Này</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập tên nguyên liệu :</label>
			<div class="ui-widget">
				<input class="inputAddDetails" type="text" name="inputAddDetails" placeholder="Nhập tên nguyên liệu ... ">
			</div>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập khối lượng nguyên liệu :</label>
			<input type="number" class="inputAddDetailsQuan" name="inputAddDetailsQuan" placeholder="Nhập khối lượng ...">
			<button class="btn btnSaveAddDetails">Lưu</button>
			<button class="btn btnCancelAddDetails">Hủy</button>
		</center>
	</div>

	<div class="Edit_details_form">
		<h1 style="text-align: center; font-size: 3em;">Thay Đổi Nguyên Liệu Cho Món Này</h1>
		<br>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập tên nguyên liệu :</label>
			<div class="ui-widget">
				<input class="inputEditDetails" type="text" name="inputEditDetails" placeholder="Nhập tên nguyên liệu ... ">
			</div>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Nhập khối lượng nguyên liệu :</label>
			<input type="number" class="inputEditDetailsQuan" name="inputEditDetailsQuan" placeholder="Nhập khối lượng ...">
			<button class="btn btnSaveEditDetails">Lưu</button>
			<button class="btn btnCancelEditDetails">Hủy</button>
		</center>
	</div>

	<div class="Delete_details_form">
		<h1 style="text-align: center; font-size: 3em;">Loại Bỏ Nguyên Liệu</h1>
		<br>
		<h2 style="color: red">* Lưu ý : Đây là thao tác loại bỏ nguyên liệu khỏi món ăn này, không phải xóa dữ liệu của nguyên liệu này !</h2>
		<center>
			<label style="float:left; margin:1em 5em .5em .8em; font-size: 2em;">Xác nhận xóa nguyên liệu này :</label>
			<button class="btn btnSaveDeleteDetails">Loại</button>
			<button class="btn btnCancelDeleteDetails">Hủy</button>
		</center>
	</div>

	<div>
		<!-- 
			- link dan den slide hinh anh
			- gui bang get ( idfood )
		 -->
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