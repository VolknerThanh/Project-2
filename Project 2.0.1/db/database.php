<?php

$conn = new mysqli("localhost", "root", "", "silverrain_db");

mysqli_set_charset($conn, "utf8");

function getDataByTable($tableName) {
	global $conn;
	$array = array();
	$res = $conn->query("SELECT * FROM $tableName");
	while($arr = $res->fetch_assoc()){
		$array[] = $arr;
	}
	return $array;
}

function getMethodName ($id) {
	global $conn;

	$query = "SELECT `FM_name` FROM `foodmethods` WHERE `FM_id` = $id";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	
	return $result->fetch_assoc()['FM_name'];
}

function getFoodName ($id) {
	global $conn;

	$query = "SELECT `FoodName` FROM `foods` WHERE `IdFood` = $id";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	
	return $result->fetch_assoc()['FoodName'];
}

function load_foods_by_method($idmethod) {
	global $conn;
	
	$array = array();
	$res = $conn->query("SELECT * FROM foods WHERE IdMethod = $idmethod");
	while($arr = $res->fetch_assoc()){
		$array[] = $arr;
	}
	return $array;
}

function load_food_details($idfood) {
	global $conn;
	
	$array = array();
	$res = $conn->query("SELECT `Material_name`, `Quantity`, `Material_Unit` FROM `materials`, `foodmaterials` WHERE `materials`.`IdMaterial` = `foodmaterials`.`Material_ID` AND `foodmaterials`.`Food_ID` = $idfood");
	while($arr = $res->fetch_assoc()){
		$array[] = $arr;
	}
	return $array;
}

function CountFoodInMethod($idmethod){
	global $conn;

	$query = "SELECT * FROM `foods` WHERE `IdMethod` = $idmethod";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	
	return $result->num_rows;
}

function CountFoodDetail($idfood) {
	global $conn;

	$query = "SELECT * FROM `foodmaterials` WHERE `Food_ID` = $idfood";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	
		return $result->num_rows;
}
?>