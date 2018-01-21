<?php 

include ("db/database.php");

if( !empty($_POST['delId'])){
	DeleteThisFood( $_POST['delId'] );
}

function DeleteThisFood($id) {
	global $conn;

	$query = "DELETE FROM foods WHERE IdFood = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id);
	$stmt->execute();
}



?>