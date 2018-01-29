<?php 
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



?>