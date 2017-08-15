<?php 

require_once ("conexion.php");
require_once("clases/cliente.php");
require_once("clases/cajero.php");
require_once("clases/vendedor.php");
require_once("clases/detalle.php");


class Pedido
{
	private $fecha;
	private $cliente;
	private $vendedor;
	public $id;
	public $total;
	
	function __construct($id)
	{
		$this->id = $id;
		global $db;
		$res = $db->query("SELECT * FROM pedidos WHERE id = $id");		

		if ($db->errno) 
		{
			echo $db->error;
		}
		else if($res->num_rows)
		{
			//////Existe ..instanciar
			$data = $res->fetch_array();
			$this->fecha = $data['fecha'];
			$this->cliente = $data['id_cliente'];
			$this->vendedor = $data['id_vendedor'];

		}
		else
		{
			echo "Pedido no existe";
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCliente()
	{
		$c = new Cliente($this->cliente);
		return $c;
	}
	public function getVendedor()
	{
		global $db;

		$res = $db->query("SELECT dni from usuarios where id = $this->vendedor");
		$data = $res->fetch_array();
		$dni_vendedor = $data['dni'];
		$c = new Vendedor($dni_vendedor);
		return $c;
	}

	public function getFecha()
	{
		return $this->fecha;
	}

	public function getDetalle()
	{
		echo"<tr>
			<td>  ".$this->id."   </td>
			<td>".$this->fecha."</td>
			<td>  DNI: ".$this->getVendedor()->getDni()."  Nombre: ".$this->getVendedor()->getNombre()."   </td>
			<td>  DNI: ".$this->getCliente()->getDni()."  Nombre: ".$this->getCliente()->getNombre()."   </td>";
		echo '<td>  <a href="pedido_detalle.php?id='.$this->id.'"><button>Ver Pedido</button></a></td>
			</tr>';
	}

	public function getLinea()
	{
		echo"<tr>
			<td>  ".$this->id."   </td>
			<td>".$this->fecha."</td>
			<td>  DNI: ".$this->getVendedor()->getDni()."  Nombre: ".$this->getVendedor()->getNombre()."   </td>
			<td>  DNI: ".$this->getCliente()->getDni()."  Nombre: ".$this->getCliente()->getNombre()."   </td>";
		
	}

	public function addDetalle($id_producto,$cantidad)
	{
		
	}

	public function mostrarTabla()
	{

		global $db;
		$res = $db->query("SELECT id FROM pedido_detalle WHERE id_pedido = $this->id");

		$this->total = 0;

		if ($db->errno) {
			echo $db->error;
		}
		else if ($res->num_rows) 
		{
			///existe
			while ($data = $res->fetch_array()) 
			{
				$d = new Detalle($data['id']);
				$this->total = $this->total + $d->getSubTotal();
				$d->imprimirLinea();
			}

		}
		else
		{
			echo "Pedido Sin Productos";
		}


	}

	public function mostrarTablaFactura()
	{

		global $db;
		$res = $db->query("SELECT id FROM pedido_detalle WHERE id_pedido = $this->id");

		$this->total = 0;

		if ($db->errno) {
			echo $db->error;
		}
		else if ($res->num_rows) 
		{
			///existe
			$html = "";
			while ($data = $res->fetch_array()) 
			{
				$d = new Detalle($data['id']);
				$this->total = $this->total + $d->getSubTotal();
				$html.= $d->imprimirLineaFactura();
			}

			return $html;

		}
		else
		{
			echo "Pedido Sin Productos";
		}


	}

	function getTotal()
	{
		return $this->total;
	}

	function setEstado($nuevoEstado)
	{
		global $db;

		$res = $db->query("UPDATE pedidos SET estado = '$nuevoEstado' WHERE id = $this->id");
		
		if ($db->errno) {
			echo $db->error;
			// return false;
		}
		else if ($res) 
		{
			echo "Estado del Pedido Actualizado";
			return true;
		}
		else
		{
			echo "Pedido no Encontrado";
			return false;
		}
	}


}






 ?>