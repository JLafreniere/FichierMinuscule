<?php
include_once 'connexion_bd.php';
include_once 'formater_champ.php';
 function phpSelectQuery($query){

    $mysqli = connexion();

	$myArray = array();
	if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_array()) {

            $myArray[] = $row;
    }

    echo json_encode($myArray);
	}

	
	$mysqli->close();
	}


	function phpQuery($query){
    $mysqli = connexion();
	$myArray = array();
	if ($result = $mysqli->query($query)) {
	$mysqli->close();
	}
	
}

	function phpSelectReturnSingleName($query){
    $mysqli = connexion();
	$myArray = array();
	if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_array()) {
        return $row['nom']; 
        
    }
     
	}

	
	$mysqli->close();
	}

	function alert($message){
		echo "<script>alert('".$message."')</script>";
	}







?>