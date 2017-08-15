<?php 
require_once("conexion.php");
require_once("clases/factura.php");
require_once("dompdf/dompdf_config.inc.php");
 
$factura = new Factura($_GET["f"]);

$factura->imprimir();

 ?>