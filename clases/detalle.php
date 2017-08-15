<?php 
require_once("clases/pedido.php");
require_once("clases/producto.php");

/**
* 
*/
class Detalle
{

	private $id_pedido;
	private $id_producto;
	private $cantidad;
	private $precioUnidad;
	
	function __construct($id_detalle)
	{
		global $db;
		$res = $db->query("SELECT * FROM pedido_detalle WHERE id = $id_detalle");
		if ($db->errno) 
		{
			echo $db->error;
		}
		else if ($res->num_rows) 
		{
			//existe
			$data = $res->fetch_array();
			$this->id_pedido = $data['id_pedido'];
			$this->id_producto = $data['id_producto'];
			$this->cantidad = $data['cantidad'];
			$this->precioUnidad = $data['precio_unidad'];

		}
		else
		{
			echo "Detalle no Existe";
		}
	}

	function imprimirLinea()
	{
		echo '<tr>
		<td>'.$this->getProducto()->getDescripcion().'</td>
		<td>'.$this->getPrecio().'</td>
		<td>'.$this->getCantidad().'</td>
		<td>'.$this->getSubTotal().'</td>
		</tr>';
	}

	function imprimirLineaFactura()
	{
		return '<tr >
							<td>'.$this->id_producto.'</td>
							<td>'.$this->getProducto()->getDescripcion().'</td>
							<td>'.$this->getCantidad().'</td>
							<td>'.$this->getPrecio().'</td>
							<td>'.$this->getSubTotal().'</td>
						</tr>';
	}

	function getPedido()
	{
		$p = new Pedido($this->id_pedido);
		return $p;
	}

	function getProducto()
	{
		$p = new Producto($this->id_producto);
		return $p;
	}

	function getCantidad()
	{
		return $this->cantidad;
	}

	function getPrecio()
	{
		return $this->precioUnidad;
	}

	function getSubTotal()
	{
		return $this->cantidad * $this->precioUnidad;
	}


}















 ?>