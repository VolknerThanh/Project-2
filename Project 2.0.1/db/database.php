<?php

$conn = new mysqli("localhost", "root", "", "silverrain_db");
//$conn = new mysqli("sql209.byethost8.com", "b8_21469115", "AnonymousSilver", "b8_21469115_silverrain_db");

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

function SetID ($tableName, $idname) {
    global $conn;

    $f = false;
    $so = -1;

    $query = "SELECT * FROM $tableName";
    $stmt = $conn->prepare($query);
    
    $stmt->execute();
    $res = $stmt->get_result();

    for ($i = 1; $i <= $res->num_rows && $f == false; $i++)
    {
        $string = "SELECT * FROM $tableName WHERE $idname = " . $i;
        if ($res->num_rows == 0)
        {
            $so = $i;
            $f = true;
        }
    }
    if ($so == -1)
        $so = $res->num_rows + 1;
    return $so;
}

function SignUpAccs($name, $username, $pass){
	global $conn;
	$query = "INSERT INTO account(Id, NAMES, Username, PASSWORD) VALUES(?, ?, ?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("isss", SetID("account", "Id"), $name, $username, $pass);
	$stmt->execute();
}

function CheckAccount($username, $password){
	global $conn;
	$query = "SELECT * FROM account WHERE username =? AND PASSWORD = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows == 0)
		return "false";
	else
		return "true";
}

function CheckExistedMethodName($newname){
	global $conn;
	$query = "SELECT * FROM `foodmethods` WHERE FM_name LIKE ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $newname);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows > 0)
		return true;
	else
		return false;
}

function AddNewMethods($name){
	global $conn;

	if(CheckExistedMethodName($name) == false){
		$query = "INSERT INTO `foodmethods` (FM_id, FM_name) VALUES (?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("is", SetID("foodmethods","FM_id"), $name);
		$stmt->execute();
		return "done";
	}
	else{
		return "error";
	}
}

function Update_MethodName($newname, $thisId){
	global $conn;

	if(CheckExistedMethodName($newname) == false) {
		$query = "UPDATE foodmethods SET `FM_name` = ? WHERE `FM_id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $newname, $thisId);
		$stmt->execute();
		return "Done";
	}
	else{
		return "Error";
	}
}

function DeleteMethod($id){
	global $conn;
	$query = "DELETE FROM `foodmaterials` WHERE Food_ID = ( SELECT Idfood FROM foods WHERE `IdMethod` = ? )";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();

	$query = "DELETE FROM `foods` WHERE IdMethod = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();

	$query = "DELETE FROM `foodmethods` WHERE FM_id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();	
	return "done";
}

?>