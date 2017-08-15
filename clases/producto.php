<?php 

require_once "conexion.php";

class Producto
{


	public $id;
	public $precio;
	public $descripcion;
	public $stock;

	function __construct($id)
	{
		global $db;

		$res = $db->query("SELECT * from productos WHERE id = $id");
		if ($db->errno) 
		{
			echo $db->error;
		}
		elseif ($res->num_rows) 
		{
			$data = $res->fetch_array();
			///existe
			$this->id = $id;
			$this->precio = $data['precio'];
			$this->descripcion = $data['descripcion'];
			$this->stock = $data['stock'];
		}
		else
		{
			echo "Producto No Existe";
		}
	}

	function verProducto()
	{
			echo "descripcion: ".$this->descripcion."<br>";
			echo "precio: ".$this->precio."<br>";
			echo "stock: ".$this->stock."<br>";
	}

	function getDescripcion()
	{
		return $this->descripcion;
	}

	function actualizarStock($cant)
	{
		if ($cant <=  $this->stock) 
		{
			global $db;
			$n = $this->stock - $cant;
			$res = $db->query("UPDATE productos SET stock = $n");
			if ($db->errno) {
				echo $db->error;
				return false;
			}
			else if ($res->affected_rows) 
			{
				echo "Stock Actualizado";
				return true;
			}
			else
			{
				echo "Error Al Actualizar Stock";
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}





 ?>