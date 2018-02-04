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
	$res = $conn->query("SELECT `IdMaterial`, `Material_name`, `Quantity`, `Material_Unit` FROM `materials`, `foodmaterials` WHERE `materials`.`IdMaterial` = `foodmaterials`.`Material_ID` AND `foodmaterials`.`Food_ID` = $idfood");
	while($arr = $res->fetch_assoc()){
		$array[] = $arr;
	}
	return $array;
}

function get_MTRid_by_name($MaterialName){
	global $conn;
	$query = "SELECT IdMaterial FROM materials WHERE Material_name = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $MaterialName);
	$stmt->execute();
	$res = $stmt->get_result();
	return $res->fetch_assoc()['IdMaterial'];
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
        $cmd = $conn->prepare($string);
	    $cmd->execute();
	    $result = $cmd->get_result();
        if ($result->num_rows == 0)
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

/* ======================================================================== */
/* ======================================================================== */
/* ======================== function check existed ======================== */


function CheckExistedToAdd($tablename, $_thisname, $name){
	global $conn;
	$query = "SELECT * FROM $tablename WHERE $_thisname LIKE ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $name);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows > 0)
		return true;
	else
		return false;
}

function CheckExistedToUpdate($tablename, $_thisname, $name, $idname, $id){
	global $conn;
	$query = "SELECT * FROM $tablename WHERE $_thisname LIKE ? AND $idname != ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss", $name, $id);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows != 0)
		return true;
	else
		return false;
}
/* ======================================================================== */
/* ======================================================================== */
/* ======================================================================== */


function AddNewMethods($name){
	global $conn;

	if(CheckExistedToAdd("foodmethods","FM_name",$name) == false){
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

	if(CheckExistedToUpdate("foodmethods","FM_name", $newname, "FM_id", $thisId) == false) {
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

function DeleteAccounts($AccId){
	global $conn;
	$query = "DELETE FROM account WHERE Id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $AccId);
	$stmt->execute();	
	return "done";
}

function AddAccounts($AccName, $AccUsername, $AccPassword){
	if(CheckExistedToAdd("account","Username",$AccUsername) == false){
		global $conn;
		$query = "INSERT INTO account (Id, NAMES, Username, PASSWORD) VALUES(?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("isss", SetID("account", "Id"), $AccName, $AccUsername, $AccPassword);
		$stmt->execute();
		return "done";
	}
	else{
		return "error";
	}
}

function UpdateAccounts($AccId, $AccName, $AccUsername, $AccPassword){
	if(CheckExistedToUpdate("account","Username",$AccUsername,"Id",$AccId) == false){
		global $conn;
		$query = "UPDATE account SET NAMES = ?, username = ?, PASSWORD = ? WHERE Id = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssi", $AccName, $AccUsername, $AccPassword, $AccId);
		$stmt->execute();
		return "done";
	}
	else{
		return "error";
	}
}

function DeleteMaterials($mtr_id){
	global $conn;

	$fmtr_cmd = "DELETE FROM foodmaterials WHERE `Material_ID` = ?";
	$stmt = $conn->prepare($fmtr_cmd);
	$stmt->bind_param("i", $mtr_id);
	$stmt->execute();

	$mtr_cmd = "DELETE FROM materials WHERE `IdMaterial` = ?";
	$stmt = $conn->prepare($mtr_cmd);
	$stmt->bind_param("i", $mtr_id);
	$stmt->execute();
}

function AddMaterials($mtr_name, $mtr_unit){
	global $conn;

	if(CheckExistedToAdd("materials","Material_name",$mtr_name) == false){
		$query = "INSERT INTO materials (IdMaterial, Material_name, Material_Unit) VALUES (?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("iss", SetID("materials","IdMaterial"), $mtr_name, $mtr_unit);
		$stmt->execute();
		return "done";
	}
	else
		return "error";
}

function EditMaterials($mtr_id, $mtr_name, $mtr_unit){
	global $conn;

	if(CheckExistedToUpdate("materials","Material_name",$mtr_name,"IdMaterial",$mtr_id) == false){
		$query = "UPDATE materials SET Material_name = ?, Material_Unit = ? WHERE IdMaterial = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ssi", $mtr_name, $mtr_unit,$mtr_id);
		$stmt->execute();
		return "done";
	}
	else
		return "error";
}

function AddFoods($foodName, $methodID){
	global $conn;

	if(CheckExistedToAdd('foods', 'FoodName', $foodName)== false){
		$query = "INSERT INTO foods (IdFood, FoodName, IdMethod) VALUES (?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("isi", SetID("foods","Idfood"), $foodName, $methodID);
		$stmt->execute();
		return "done";
	}
	else
		return "error";
}

function EditFoods($foodName, $foodID){
	global $conn;

	if(CheckExistedToUpdate("foods", "FoodName", $foodName, "IdFood", $foodID) == false) {
		$query = "UPDATE foods SET FoodName = ? WHERE IdFood = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $foodName, $foodID);
		$stmt->execute();
		return "done";
	}
	else
		return "error";
}

function DeleteFoods($idfood){
	global $conn;

	$query_1 = "DELETE FROM foodmaterials WHERE Food_ID = ?";
	$cmd_1 = $conn->prepare($query_1);
	$cmd_1->bind_param("i", $idfood);
	$cmd_1->execute();

	$query_2 = "DELETE FROM foods WHERE IdFood = ?";
	$cmd_2 = $conn->prepare($query_2);
	$cmd_2->bind_param("i", $idfood);
	$cmd_2->execute();
}

function CheckExistedToAddDetailsInFood($foodID, $materialID){
	global $conn;

	$query = "SELECT * FROM foodmaterials WHERE Food_ID = ? AND Material_ID = ?";
	$cmd = $conn->prepare($query);
	$cmd->bind_param("ii", $foodID, $materialID);
	$cmd->execute();
	$res = $cmd->get_result();
	if($res->num_rows != 0)
		return true;
	else
		return false;
}
function CheckExistedFromMaterialList($name){
	global $conn;
	$query = "SELECT * FROM materials WHERE Material_name = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $name);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res->num_rows != 0)
		return false;
	else
		return true;

}
function AddDetailsInFood($IdMaterial, $IdFood, $Quantity){
	global $conn;
	$standard = 0;
	if(CheckExistedToAddDetailsInFood($IdFood, $IdMaterial) == false){
		
		$query = "INSERT INTO foodmaterials (Food_ID, Material_ID, Quantity, isStandard) VALUES (?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("iidi", $IdFood, $IdMaterial, $Quantity, $standard);
		$stmt->execute();

		return "done";
	}
	else
		return "error";
}

function CheckExistedToUpdateDetailsInFood($idfood, $newID){
	global $conn;

	$query = "SELECT * FROM foodmaterials WHERE Food_ID = ? AND Material_ID = ?";
	$cmd = $conn->prepare($query);
	$cmd->bind_param("ii", $idfood, $newID);
	$cmd->execute();
	$res = $cmd->get_result();
	if($res->num_rows != 0)
		return true;
	else
		return false;
}

function EditDetailsInFood($newID, $currentID, $IdFood, $Quantity){
	global $conn;
	$standard = 0;
	if(CheckExistedToUpdateDetailsInFood($IdFood, $newID) == false){
		$query = "UPDATE foodmaterials SET Material_ID = ?, Quantity = ? WHERE Food_ID = ? AND Material_ID = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("iiii", $newID, $Quantity, $IdFood, $currentID);
		$stmt->execute();

		return "done";
	}
	else
		return "error";
}

function DeleteDetails($IDFOOD, $IDMTR){
	global $conn;

	$query = "DELETE FROM foodmaterials WHERE Food_ID = ? AND Material_ID = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ii", $IDFOOD, $IDMTR);
	$stmt->execute();
	return "done";
}

?>