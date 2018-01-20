<?php 

$conn = new mysqli("localhost", "root", "", "silverrain_db");

mysqli_set_charset($conn,"utf8");

function getDataBase() {

	global $conn;

	$rtn  = array();
	$res = $conn->query("select * from foodmethods");

	while( $arr = $res->fetch_assoc() ){
		$rtn[] = $arr;
	}
	return $rtn;
}

function getFoodListByMethod($id) {
	global $conn;

	$rtn  = array();
	$res = $conn->query("SELECT `FoodName` FROM `foods` WHERE `IdMethod` = $id");

	while( $arr = $res->fetch_assoc() ){
		$rtn[] = $arr;
	}
	return $rtn;
}

?>