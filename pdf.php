<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
		tbody > tr > td {
  text-align: center;
}
		</script>
</head>
<body>
<?php
include_once 'cabecera.php';
include_once 'verificar_sesion.php';
use app\SpaceItfip\Controladores\PrestamosControlador;
/**
 * [$prestamos description]
 * @var [type]
 */
$prestamos = !empty($_GET['busqueda'])
? PrestamosControlador::obtenerPorBien($_GET['busqueda'])
: PrestamosControlador::obtenerTodos();
// var_dump($prestamos);
?>
<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Bienes o espacios f&iacute;sicos prestados</h1>
		
	</div>
	<div class="col-12 mb-5">
		<?php if (!$prestamos) { ?>
			<div class="alert alert-primary">
				No se encontr&oacute; ning&uacute;n registro
			</div>
		<?php } else { ?>
			<div class="table-responsive">
				<table border="1" class="table table-light table-hover table-bordered text-center">
					<thead >
						<tr>
							<th>Id. pr&eacute;stamo</th>
							<th>Fecha registro</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
							<th>Elemento solicitado</th>
							<th>Solicitante</th>
							<th>C&eacute;dula</th>
							<th>Direcci&oacute;n</th>
							<th>Tel&eacute;fono</th>
							<th>Descripci&oacute;n Bien(es)</th>
							<th>Finalidad</th>
							<th>Aprobaci&oacute;n</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($prestamos as $prestamo) { ?>
					<tr>
								<td><?=$prestamo->id_prestamo?></td>
								<td><?=$prestamo->fecha_solicitud_bien?></td>
								<td><?=$prestamo->fecha_entrega_bien?></td>
								<td><?=$prestamo->fecha_fin_bien?></td>
								<td><?=$prestamo->nombre_bien?></td>
								<td><?=$prestamo->nombre_del_solicitante?></td>
								<td><?=$prestamo->numero_documento_del_solicitante?></td>
								<td><?=$prestamo->direccion_del_solicitante?></td>
								<td><?=$prestamo->telefono_del_solicitante?></td>
								<td><?=$prestamo->descripcion_prestamo?></td>
								<td><?=$prestamo->finalidad_prestamo?></td>
								<td ><?='si' === $prestamo->aprobacion_prestamo ? 
								'<font color= "green">Aprobado</font>' : '<font color="red">No aprobado</font>'?></td>
								
							</tr>
						<?php } ?>
					</tbody>
					
						
				</table>
				
			</div>
			
		<?php } ?>
	</div>

</div>

</body>
</html>
<?php

$html=ob_get_clean();
//echo $html;

require_once 'libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//$dompdf->setPaper('letter');
//formato carta se muestra como una lista

$dompdf->setPaper('A4', 'landscape');
//si son como certificados en horizontal con otra posicion

$dompdf->render();

$dompdf->stream("archivo_de_los_prestamos_itfip.pdf", array("Attachment" => false));

?>