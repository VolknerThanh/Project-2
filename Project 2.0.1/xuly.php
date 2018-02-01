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
?>