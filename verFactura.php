<?php
session_start();
require_once("clases/cajero.php");
require_once("clases/factura.php");
require_once("clases/pedido.php");


if (isset($_GET['tipoPago'])  & isset($_GET['pedido']) ) 
{
	


$id_pedido = $_GET['pedido'];
$tipoPago = $_GET['tipoPago'];
$cajero = new Cajero($_SESSION["dni_cajero"]);

$idFactura = $cajero->generarFactura($id_pedido,$tipoPago);

if ($idFactura) 
{
	header("location: imprimir.php?f=".$idFactura);
}















}

?>