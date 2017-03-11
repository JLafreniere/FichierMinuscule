<?php
function connexion()
{
	//$conn = new mysqli('localhost','concep14_root','admin','concep14_bd_application');
	$conn = new mysqli('localhost','root','','bd_application');
	mysqli_set_charset( $conn, 'utf8');
	
	return $conn;
}
?>
