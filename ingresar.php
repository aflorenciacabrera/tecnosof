<?php 
session_start();
require_once "conexion.php";

if (isset($_POST['user']) & isset($_POST['pass'])) 
{
	

	$usuarios = $_POST['user'];
	$contraseña = $_POST['pass'];


	$res = $db->query("SELECT * FROM usuarios WHERE user='$usuarios' AND pass='$contraseña'");

	if ($db->errno) {echo $db->error;}

	if ($res->num_rows) ///si existe
	{
		$fila = $res->fetch_array();///Recupera datos de la proxima fila
		if($fila['tipo'] == "cajero")
		{

			$_SESSION['dni_cajero'] = $fila['dni'];
			header("location: cajero.php");
		}
		else if($fila['tipo'] == "vendedor")
		{
			header("location: vendedor.php");
		}
		else
		{
			header("location: admin.php");
		}

	}
	else///no existe
	{
		echo "Usuario o Contraseña Incorrecta";
	}
}
else
{
	echo "ERROR no recibe variables";
}


?>