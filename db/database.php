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
	$res = $conn->query("SELECT * FROM `foods` WHERE `IdMethod` = $id");

	while( $arr = $res->fetch_assoc() ){
		$rtn[] = $arr;
	}
	return $rtn;
}

function SetID ($tableName) {
    global $conn;

    $f = false;
    $so = -1;

    $query = "SELECT * FROM $tableName";
    $stmt = $conn->prepare($query);
    
    $stmt->execute();
    $res = $stmt->get_result();

    for ($i = 1; $i <= $res->num_rows && $f == false; $i++)
    {
        $string = "SELECT * FROM $tableName WHERE `id` = " . $i;
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

function load_materials(){
	global $conn;

	$rtn  = array();
	$res = $conn->query("SELECT Material_name FROM `materials`");

	while( $arr = $res->fetch_assoc() ){
		$rtn[] = $arr;
	}
	return $rtn;
}

?>