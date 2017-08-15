<?php


require_once("clases/persona.php");

class Vendedor extends Persona
{
	public function generarPedido($idCliente)
	{

		$p = new Pedido($id_pedido);
		return $p;
	}

	public function cancelarPedido($id_pedido)
	{

	}

	public function restaurarPedido($id_pedido)
	{

	}

	public function getDatosPersonales()
	{
		echo "<b>Vendedor</b><br>";
		parent::getDatosPersonales();
	}

	public function generarCliente()
	{
	
	}


}


?>

