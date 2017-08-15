<?php 

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_base = "prueba";


//Conexion a la bese de datos
$db = new mysqli($db_host,$db_user,$db_pass,$db_base);

///verificar verificacion
if ($db->errno) 
{
	echo "Error".$db->error;
}
else
{
	// echo "Conexion Correcta";
}












 ?>