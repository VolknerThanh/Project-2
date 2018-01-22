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

if( !empty($_POST['content'])){
	echo CheckExistInDB($_POST['content']);
}

function CheckExistInDB($name){
	global $conn;

	$query = "SELECT * FROM `materials` WHERE `Material_name` = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $name);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows == 0)
		return "No";
	else
		return "Yes";
}


if( !empty($_POST['thiscontent']) && !empty($_POST['idfood'])){
	echo CheckExistInList($_POST['idfood'], Find_materials_id($_POST['thiscontent']));
}

function Find_materials_id ($name) {
	global $conn;

	$query = "SELECT * FROM `materials` WHERE `Material_name` = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $name);
	$stmt->execute();
	$res = $stmt->get_result();
	return $res->fetch_assoc()['IdMaterial'];
}

function CheckExistInList($idf, $mtr) {
	global $conn;

	$query = "SELECT * FROM `foodmaterials` WHERE `Food_ID` = ? AND `Material_ID` = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('ii', $idf, $mtr);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows > 0)
		return "Yes";
	else
		return $mtr;
}

?>