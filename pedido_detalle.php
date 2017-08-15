<?php 
session_start();
require_once("clases/pedido.php");
?>

<html>
<head>
	<link rel="stylesheet" href="jq/jquery-ui.css">
  <script src="jq/jquery-1.11.2.min.js"></script>
  <script src="jq/jquery-ui.js"></script>
  <script type="text/javascript">
  $(document).ready(function () 
  {
  	

  	$("#ok").click(function(){
  		$("#dialog").html("Sr. Cajero: ¿Está seguro de confirmar la operación? Se generará la factura para este pedido?")

  		$( "#dialog" ).dialog({
      resizable: false,      
      modal: true,
      buttons: {
        "Si": function() {
        $("#formVerFactura").submit();
          $( this ).dialog( "close" );
        	alert("Factura Generada Con Exito")
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });








  	})



  })

  </script>
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
<h2>Detalles del Pedido</h2>

<?php
if (isset($_GET['id'])) 
{


	
	$pedido_id = $_GET['id'];
	$dni_cajero = $_SESSION['dni_cajero'];
	$pedido = new Pedido($pedido_id);
	$cajero = new Cajero($dni_cajero);
	echo '<table>
	<tr>
		<td>N°de Pedido</td>
		<td>Fecha</td>
		<td>Vendedor</td>
		<td>Cliente</td>
	</tr>';
	$pedido->getLinea();
	echo "</table>";


	/////TABLA DETALLE
	echo "<table>
	<tr>	
	<td>Producto</td>
	<td>Precio</td>
	<td>Cantidad</td>
	<td>Sub Total</td>
	</tr>
	";
	$pedido->mostrarTabla();
	echo "<tr>	
	<td></td>
	<td></td>
	<td>TOTAL</td>
	<td>".$pedido->getTotal()."</td>
	</tr>";
	echo "</table>";

	// echo '<a href="verFactura.php?id='.$pedido_id.'"><button>GENERAR FACTURA</button></a>';

?>

<form  id="formVerFactura"   action="verFactura.php">
<input type="radio" name="tipoPago" value="efectivo" checked>
	<label>Efectivo</label>
<input type="radio" name="tipoPago" value="tarjeta">
<label>Tarjeta</label></br>
<?php
echo '<input type="hidden"  name="pedido" value="'.$pedido_id.'"  >';
?>
<input type="button" id="ok" value="Generar Factura">
</form>
<div id="dialog"></div>
</body>
</html>
<?php }?>













