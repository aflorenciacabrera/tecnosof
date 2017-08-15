<?php 

require_once("clases/persona.php");


/**
* 
*/
class Cliente extends Persona
{
	public function verPedidos()
	{
		///
	}

	public function getDatosPersonales()
	{
		echo "<b>Cliente</b><br>";
		parent::getDatosPersonales();
	}
}














 ?>