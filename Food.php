<?php
	include ("db/database.php");

	if( !empty( $_POST['value']) ){
		echo CheckExist($_POST['value']);
		die();
	}

	function CheckExist($name) {
		global $conn;
		$query = "SELECT * FROM `foods` WHERE `FoodName` = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('s', $name);
		$stmt->execute();
		$res = $stmt->get_result();
		if($res->num_rows!=0){
			return "Existed";
		}
		else{
			$sql = "INSERT INTO `foods` (`IdFood`, `IdMethod`, `FoodName`) VALUES (?, ?, ?);";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('iis', SetId("foods"), $_POST['id'], $_POST['value']);
			$stmt->execute();
		}
	}
?>

<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<?php

	if(!empty( $_GET['id'])) {
		$name = getMethodName($_GET['id']);
	}
	else{
		$name = "404 Not Found";
	}
		
	function getMethodName ($id) {
		global $conn;

		$query = "SELECT `FM_name` FROM `foodmethods` WHERE `FM_id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		return $result->fetch_assoc()['FM_name'];
	}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>phương thức <?php echo $name ?></title>
	<meta charset="utf-8">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


	<div class="food-container">
		<h1 style="text-align: center;">Các món theo phương thức <?php echo $name; ?></h1>
		<br>
		
		<div class="btn btn-addfood">
			<i class="fa fa-plus" style="font-size:15px; color:#fff"></i>
		</div>

		<div class="foods-list">
			<?php
				$foodlist = getFoodListByMethod($_GET['id']);
				foreach ($foodlist as $value) {
			?>
			<div class="food" id="foodNo_<?php echo $value['IdFood'] ?>_<?php echo $value['IdMethod'] ?>">
				<a href="FoodDetail.php?idfood=<?php echo $value['IdFood']; ?>" class="food-name"><?php echo $value['FoodName'] ?></a>
				<i class="fa fa-close btn-del-food" onclick='getInfo("<?php echo $value['IdFood'] ?>", "<?php echo $value['IdMethod'] ?>");'></i>
			</div>
			<?php
				}
			?>
		</div>
	</div>
		
	<div class="add-food-form">
		<h1>Thêm món ăn</h1>
		<br>
		<br>
		<br>
		<input type="text" name="Food-input" class="Food-input" placeholder="Nhập tên món ăn">
		<br>
		<br>
		<br>
		<div style="display: flex; margin-left: 4em;">
			<div class="btn button-save-addfood">Lưu</div>
			<div class="btn button-cancel-addfood">Hủy</div>
		</div>
	</div>

	<div class="DeleteConfirm">
		<h1 id="ConfirmTitle">Xác nhận xóa món ăn</h1>
		<div style="display: flex; margin: 4em;">
			<div class="btn button-confirm">Xác nhận</div>
			<div class="btn button-cancel-confirm">Hủy</div>
		</div>
	</div>

	<script type="text/javascript">
		
		$(document).ready(function() {

			function SaveIt() {
				var isNull = false;
				var isExisted = false;
				var input_value = $('.Food-input').val();

				if( input_value == null || input_value == "") {
					alert('Hãy điền đầy đủ tên món ăn vào khung!');
					isNull = true;
					return;
				}
				else {
					$.ajax({
						url: 'Food.php',
						type: 'POST',
						data: { value : input_value, id : "<?php echo $_GET['id']; ?>"},
					})
					.done(function(res) {
						if(res == "Existed"){
							isExisted = true;
							alert('Tên món ăn đã tồn tại!');
						}
						else{
							alert('Thêm thành công!');
							$('.add-food-form').hide(500);

							location.reload();
						}
					});
				}
			}

			$('.button-save-addfood').click(function() {
				SaveIt();
			});

			$('.Food-input').keypress(function(event) {
				event = event || window.event;
				kc = event.KeyCode || event.which;
				if(kc == 13)
					SaveIt();
			});
		});

		function DeleteFood(idfood) {
			$.ajax({
				url: 'xuly.php',
				type: 'POST',
				data: {delId: idfood},
			})
			.done(function() {
				alert('Xóa thành công!');
			});
		}

		/* 2 biến này chứa giá trị của div món ăn cần xóa trên dòng lặp */
		var _idfood;
		var _idmethod;
		// hàm lấy thông tin từ vòng lặp
		function getInfo(idf, idm){
			_idfood = idf;
			_idmethod = idm;
		}
		// nút xác nhận - thay thế nút xóa ( fa-close )
		$('.button-confirm').click(function() {

			// xóa trong client
			var cmd = "#foodNo_" + _idfood + "_" + _idmethod;
			$(cmd).remove();

			// xóa trong database
			DeleteFood(_idfood);

			$('.DeleteConfirm').hide(1000);
		});


	</script>
</body>
</html>