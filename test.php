<?php
	if(!empty( $_POST['mail']) ){
		$email = $_POST['mail'];

		// kiểm tra định dạng email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			echo("'$email' correct!");
		else
			echo("'$email' is not a valid mail address!");

		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<title>Test</title>
</head>
<body>
	
	<input type="text" name="test-input" id="test-input" placeholder="type your mail here...">
	<input type="submit" name="submit" value="Click" onclick="ClickMe();">
		

	<script>
		function ClickMe(){
			var email = $('#test-input').val();
			//alert(email);

			$.ajax({
				url: 'test.php',
				type: 'POST',
				data: {mail: email},
			})
			.done(function(result) {
				alert(result);
			})
			.fail(function() {
				alert("error");
			});
			
		}
	</script>


	
			
	
</body>
</html>