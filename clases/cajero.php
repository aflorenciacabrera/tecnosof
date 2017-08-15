<?php 
require_once("clases/persona.php");

class Cajero extends Persona
{

	public function getId()
	{
		global $db;
		$res = $db->query("SELECT id from usuarios where dni = ".$this->getDni());
		$data = $res->fetch_array();
		$dni_cajero = $data['id'];
		return $dni_cajero;
	}


	
	public function cobrar_pedido($id_pedido)
	{
		$this->generar_factura($id_pedido);
	}

	public function generarFactura($id_pedido,$tipoPago)
	{
		global $db;
		////pasar pedido a pagado
		$p = new Pedido($id_pedido);
		$p->setEstado("pagado");
		////insert factura
		$cajero_id = $this->getId();
		$res = $db->query($sql = "INSERT INTO `prueba`.`factura` (`id`, `id_pedido`, `fecha`, `id_cajero`, `tipoPago`) VALUES (NULL, $id_pedido, CURRENT_TIMESTAMP, $cajero_id, '$tipoPago')");
		if ($db->errno) 
		{
			echo $db->error;
			return false;
		}
		else if($res)
		{
			
			///buscar id
			$res = $db->query("CALL `buscarIdFactura`()");
			if ($db->errno) 
			{
				echo $db->error;
				return false;
			}
			else if($res->num_rows)
			{
				$data = $res->fetch_array();
				return $data['id'];
			}
			else
			{
				return false;
			}


		}
		else
		{
			echo "Error Al generar Facutara";
			return false;
		}

		//devolver nuevo id de factura
	}

	public function getDatosPersonales()
	{
		echo "Cajero<br>";
		parent::getDatosPersonales();
	}
}


 ?>