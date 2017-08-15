<?php
session_start();
require_once "conexion.php";
require_once "clases/cajero.php";
require_once "clases/pedido.php";
$cajero = new Cajero($_SESSION['dni_cajero']);



function tabla_pedido()
{
	global $db;
	$res = $db->query("SELECT * FROM pedidos WHERE estado = 'aceptado'");
	if ($db->errno) {
		echo $db->error;
	}
	else if ($res->num_rows) 
	{	//existe
		while ($data = $res->fetch_array()) 
		{
			$p = new Pedido($data["id"]);
			$p->getDetalle();
			
		}
	}
	else
	{
		echo "No se Encontraron Pedidos";
	}
}


?>

<html>
<head>
	<title></title>
	<style type="text/css">
	table{
		width: 100%;
		border:1px solid black;
		text-align: center;
	}
	</style>
</head>
<body>
<?php
echo "<h1>Cajero: ".$cajero->getNombre()."</h1><br><h2>Pedidos Aceptados</h2>";
?>
<table>
	<tr>
		<td>N°de Pedido</td>
		<td>Fecha</td>
		<td>Vendedor</td>
		<td>Cliente</td>
		<td>Ver Pedido</td>
	</tr>
<?php
tabla_pedido();
?>
</table>

</body>
</html>