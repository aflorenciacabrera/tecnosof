<?php 
require_once ("conexion.php");


class Persona
{
	private $nombre;
	private $dni;
	private $telefono;
	private $domicilio;

	function __construct($dni)
	{
		global $db;
		$res = $db->query("SELECT * FROM personas WHERE dni = $dni");
		if($db->errno)
		{
			echo $db->error;
		}
		else if($res->num_rows)
		{
			$fila = $res->fetch_array();
			$this->nombre = $fila['nombre'];
			$this->dni = $fila['dni'];
			$this->telefono = $fila['telefono'];
			$this->domicilio = $fila['domicilio'];
		}
		else
		{
			echo "Dni Incorrecto";
		}
	}


	public function getNombre()
	{
		return $this->nombre;
	}

	public function getDni()
	{
		return $this->dni;
	}
	public function getTelefono()
	{
		return $this->telefono;
	}
	public function getDomicilio()
	{
		return $this->domicilio;
	}

	public function getDatosPersonales()
	{
		echo "Nombre:".$this->getNombre()."<br>";
		echo "Dni:".$this->getDni()."<br>";
		echo "telefono:".$this->getTelefono()."<br>";
		echo "domicilio:".$this->getDomicilio()."<br>";
	}

}


?>	