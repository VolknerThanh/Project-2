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
?>