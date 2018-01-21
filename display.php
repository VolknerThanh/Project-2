<?php 
	include ('db/database.php');

	if(!empty( $_POST['_name']) ){
		AddMethod($_POST['_name']);
		echo ShowId($_POST['_name']);

		die();
	}

	function AddMethod($name){
		
		global $conn;

		$sql = "INSERT INTO `foodmethods` (`FM_name`) VALUES(?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $name);
		$stmt->execute();
	}
		
	function ShowId($name){
		global $conn;

		$sql = "SELECT (`FM_id`) FROM `foodmethods` where (`FM_name`) = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $name);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc()['FM_id'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Danh sách phương thức</title>
	<meta charset="utf-8">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="lib/scripts.php"></script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="display-container">
		<div class="list-methods">
			
			<div class="add-methods">
				<i class="fa fa-plus" style="font-size:24px; color:#fff"></i>
			</div>
			
			<?php 
				//include ("db/database.php");
				$db = getDataBase();
				foreach ($db as $value) {
			?>

			<a href="Food.php?id=<?php echo $value["FM_id"]; ?>" class="methods">
				<h2> <?php echo $value["FM_name"]; ?> </h2>
			</a>

			<?php 
				} 
			?>
		</div>
	</div>

	<div class="fill-information">
		<h1>Thêm Thông Tin</h1>
		<div class="Infor-container">
			<input type="text" name="Methods-input" id="Methods-input" placeholder="Nhập tên phương thức">
			<div style="display: flex; position: relative; left:20%;">
				<div class="btn btn-ok">Lưu</div>
				<div class="btn btn-cancel">Hủy</div>
			</div>
		</div>
	</div>


</body>

	<script>
		
		$('.btn-ok').click(function() {
		if($('#Methods-input').val() == null || $('#Methods-input').val() == "")
			alert('please fill the box');
		else{
		

			var name = $('#Methods-input').val();

			$.ajax({
				url: 'display.php',
				type: 'POST',
				data: {_name: name},
			})
			.done(function(res) {
				//alert(res);
				var addMethod = `
				<a href="Food.php?id=`+ res +`" class="methods">
					<h2>`+ $('#Methods-input').val() +`</h2>
				</a>
				`;
				$('.list-methods').append(addMethod);
			})
			.fail(function() {
				console.log("error");
			});

			$('.fill-information').hide(500);
		}
	});

	</script>
</html>