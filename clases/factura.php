<?php 
// require_once("clases/conexion.php");
require_once("clases/pedido.php");
require_once("clases/cajero.php");

class factura
{
	public $cajero;
	public $pedido;
	public $fecha;
	public $tipoPago;
	public $id;

	function __construct($id_factura)
	{
		$this->id = $id_factura;
		global $db;
		$res = $db->query("SELECT * FROM factura WHERE id = $id_factura");
		if ($db->errno) 
		{
			echo $db->error;
		}
		else if($res->num_rows)
		{
			//exite
		     $data = $res->fetch_array();
			 $this->cajero = $data['id_cajero'];
			 $this->pedido = $data['id_pedido'];
			 $this->fecha = $data['fecha'];
			 $this->tipoPago = $data['tipoPago'];

		}
		else
		{
			echo "Factura no Existe";
		}
	}

	public function getPedido()
	{
		$p = new Pedido($this->pedido);
		return $p;
	}

	public function getCajero()
	{

	}

	public function getFecha()
	{

	}

	public function getTipoPago()
	{
		
	}

	public function imprimir()
	{

		$p = $this->getPedido();

						$html = '<html>
						<head>
						<style>

						p{
						height:5px;
						}
						</style>

						</head>
						<body>

						<table border="1" style="text-align:center;width:100%;border: thin solid;">
						<tr>
						<td>ORIGINAL</td>
						</tr>
						</table>


						<table border="1" style="text-align:center;width:100%;border: thin solid;">
							<tr>
							<td style="width:40%;">LOGO</td>
							<td style="width:10%;">B</td>
							<td style="width:40%;">FACTURA</td>
						</tr>
						</table>

						<table border="1" style="font-size: 0.8em;width:100%;border: thin solid;">
							<tr>
								<td style="width:50%;">
									<p><b>Nombre:</b> Tecno Soft</p>
									<p><b>Direccion Comercial:Roca 139</b></p>
									<p><b>Condicion Frente al IVA: IVA responsable inscripto</b></p>
									
								</td>
								<td style="width:50%;">
									<p><b>Fecha de Emision: </b>'.$this->fecha.'</p>
									<p><b>CUIT/DNI:</b>xx-00000000-x</p>
									<p><b>Fecha de Inicio de Actividades</b>30/04/2015</p>
									
								</td>
								
							</tr>

							<tr>
								<td style="width:50%;">
									<p><b>CUIT:</b>'.$this->getPedido()->getCliente()->getDni().'</p>
									<p><b>Condicion frente al IVA:</b>IVA Sujeto Exento</p>
									<p><b>Condicion de venta:</b>Cuenta Corriente</p>
								</td>
								<td style="width:50%;">
									<p><b>Apellido y Nombre:</b>'.$this->getPedido()->getCliente()->getNombre().'</p>
									<p><b>Domicilio:</b>'.$this->getPedido()->getCliente()->getDomicilio().'</p>
									<p><b>Nro de Pedido:</b>'.$this->getPedido()->id.'</p>
								</td>
								
							</tr>
						</table>





						<table border="1" style="text-align:center; width:100%;">
						<tr >
							<td>Codigo</td>
							<td>Producto/Servicio</td>
							<td>Cantidad</td>
							<td>Precio Unidad</td>
							<td>SubTotal</td>
						</tr>';
						$html.= $p->mostrarTablaFactura();
						for ($i=0; $i < 22; $i++) { 
							$html.='<tr>
							<td>&nbsp;</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
						</tr>';
						}

						$html.='
						</table>
						<table id="detalle" border="1" style="text-align:center; width:100%;border:thin solid;">
						<tr>
						<td style="text-align:right;">
						TOTAL: $'.$p->getTotal().'
						</td>
						</tr>

						</table>
						<table id="detalle" border="1" style="text-align:center; width:100%;border:thin solid;">
						<tr>
								<td>
								<p></p>
								<p></p>
								<p></p>
								<p></p>
								</td>
						</tr>

						</table>


						</body>
						</html>';
						 
						//Creamos la instancia
						$dompdf = new DOMPDF();
						 
						//Cargamos nuestro código HTML
						// $dompdf->load_html($html);
						$dompdf->load_html($html);
						 
						//Hacemos la conversion de HTML a PDF
						$dompdf->set_paper("A4");
						$dompdf->render();
						 
						//El nombre con el que deseamos guardar el archivo generado
							// $dompdf->stream("nombre.pdf");
						 $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));






	}
}



















 ?>