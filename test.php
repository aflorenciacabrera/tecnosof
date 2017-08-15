<?php 

require_once("clases/factura.php");

$f = new Factura(9);

echo $f->getPedido()->getId();


 ?>