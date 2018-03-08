<?php
	include("db/database.php");
	$idfood = $_GET['idfood'];

	if(!empty( $idfood )) {
		$name = getFoodName($idfood);
	}
	else{
		$name = "404 Not Found";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $name; ?></title>
	<!-- references -->
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.js"></script>
	<link rel="stylesheet" href="layout/styles.css">
	<link rel="stylesheet" href="layout/input.css">
</head>
<body>
	<div class="details-container">
		<h1 class="container-title">Nguyên Liệu Của <?php echo $name; ?></h1>
		<hr>
		<?php
			if(CountFoodDetail($idfood) == 0){
		?>
			<h1>Món ăn này không có chi tiết về nguyên liệu !</h1>
		<?php
			}
			else {
		?>
		<div class="changeQuantity">
			<label style="margin-right: 2em; font-size: 180%;">Nhập số lượng : </label>
			<input type="number" name="input-quantity" id="input-quantity" min="0" value="1">
			<button class="btn btn-calc">Tính Toán</button>
		</div>

		<div class="details-list">
			<?php
				$detailList = load_food_details($idfood);
				foreach ($detailList as $value) {
			?>
				<div class="details-item">
					<div class="display-name"><?php echo $value['Material_name'] ?></div>
					<div class="display-quantity"><?php echo $value['Quantity'] ?></div>
					<div class="display-unit"><?php echo $value['Material_Unit'] ?></div>
				</div>
			<?php
				}
			?>
		</div>
		<?php
			}
		?>
	</div>

	<div style="text-align: center; font-size: 180%; color: blue;">
		<a href="step.php?idfood=<?php echo $idfood; ?>" title="xem các bước làm">Xem các bước làm "<?php echo $name; ?>"</a>		
	</div>

	<script>
		$(document).ready(function() {

			var array = [];

			// store the first value from database into array for reset method if neccessary
			$('.display-quantity').each(function(index, element) {
				var thisvalue = $(element).text();
				array.push(thisvalue);
			});

			// display back the original value
			function ResetIt(){
				$('.display-quantity').each(function(index, element) {
					var _quantity = array[index];
					$(element).text(_quantity);
				});
			}

			// Change the quanity
			function Calculate() {
				var value = $('#input-quantity').val();
				ResetIt();
				if(value == null || value == ""){
					ResetIt();
				}
				else if (value <= 0) {
					alert('Giá trị không thể nhỏ hơn 0 !');
					ResetIt();
				}
				else{
					$('.display-quantity').each(function(index, element) {
						var thisvalue = $(element).text();
						$(element).text(thisvalue * value);
					});
				}
			}
			
			$('.btn-calc').click(function(event) {
				Calculate();
			});

			$('#input-quantity').keypress(function(event) {
				event = event || window.event;
				kc = event.KeyCode || event.which;
				if( kc == 13 ){
					Calculate();
				}
			});
		});
	</script>
</body>
</html>