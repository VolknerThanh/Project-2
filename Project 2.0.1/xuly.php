<?php 
session_start();
include ('db/database.php');

$name = "";
$username = "";
$password = "";

if( !empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password'])){
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	SignUpAccs($name, $username, $password);
}
else if (isset($_POST["logout"])){
	unset($_SESSION["username"]);
}


if(!empty($_POST['methodId']) && !empty($_POST['methodNewName'])){
	echo Update_MethodName($_POST['methodNewName'], $_POST['methodId']);
}

if(!empty($_POST['delId'])){
	echo DeleteMethod($_POST['delId']);
}

if(!empty( $_POST['methodName'] )){
	echo AddNewMethods($_POST['methodName']);
}

if(!empty( $_POST['delAccId'] )){
	echo DeleteAccounts($_POST['delAccId']);
}

if(!empty($_POST['Accname']) && !empty($_POST['Accusername']) && !empty($_POST['Accpassword'])){
	echo AddAccounts($_POST['Accname'], $_POST['Accusername'], $_POST['Accpassword']);
}

if(!empty($_POST['updateId']) && !empty($_POST['updateName']) && !empty($_POST['updateUN']) && !empty($_POST['updatePass'])){
	echo UpdateAccounts($_POST['updateId'], $_POST['updateName'], $_POST['updateUN'], $_POST['updatePass']);
}

if( !empty($_POST['Mtr_Id'])){
	DeleteMaterials($_POST['Mtr_Id']);
}
else if(!empty($_POST['mtr_name']) && !empty($_POST['mtr_unit'])){
	echo AddMaterials($_POST['mtr_name'], $_POST['mtr_unit']);
}
else if(!empty($_POST['editName']) && !empty($_POST['editUnit']) && !empty($_POST['editId'])){
	echo EditMaterials($_POST['editId'],$_POST['editName'],$_POST['editUnit']);
}


if( !empty($_POST['foodname']) && !empty($_POST['foodmethodid']))
	echo AddFoods($_POST['foodname'],$_POST['foodmethodid']);

if( !empty($_POST['editContent']) && !empty($_POST['FoodID']) )
	echo EditFoods($_POST['editContent'], $_POST['FoodID']);
if(!empty($_POST['DelFoodID']))
	DeleteFoods($_POST['DelFoodID']);

if(!empty($_POST['_thisName']) && !empty($_POST['_thisQuan']) && !empty($_POST['_thisFoodId'])){
	if(CheckExistedFromMaterialList($_POST['_thisName']))
		echo "NOT EXIST";
	else {
		$_thisId = get_MTRid_by_name($_POST['_thisName']);
		echo AddDetailsInFood($_thisId, $_POST['_thisFoodId'], $_POST['_thisQuan']);
	}
}

if(!empty($_POST['_EditName']) && !empty($_POST['_EditQuan']) && !empty($_POST['_EditFoodId']) && !empty($_POST['_currentMTR_ID'])){
	if(CheckExistedFromMaterialList($_POST['_EditName']))
		echo "NOT EXIST";
	else{
		$_newId = get_MTRid_by_name($_POST['_EditName']);
		echo EditDetailsInFood($_newId, $_POST['_currentMTR_ID'], $_POST['_EditFoodId'], $_POST['_EditQuan']);
	}
}

if(!empty($_POST['DelId_MTR']) && !empty($_POST['DelId_food'])){
	echo DeleteDetails($_POST['DelId_food'], $_POST['DelId_MTR']);
}


?>