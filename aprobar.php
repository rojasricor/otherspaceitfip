<?php
include_once 'cabecera.php';
include_once 'verificar_sesion.php';
include_once 'navegacion.php';
use app\SpaceItfip\Controladores\PrestamosControlador;
/**
 * [$prestamos_pendientes description]
 * @var [type]
 */
$prestamos_pendientes = !empty($_GET['busqueda'])
? PrestamosControlador::obtenerPendientesPorBien($_GET['busqueda'])
: PrestamosControlador::obtenerPendientes();
?>
<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Aprobaci&oacute;n de bienes o espacios f&iacute;sicos</h1>
	</div>
	<div class="col-12 mb-5">
		<?php if (isset($_GET['prestamo_no_especificado'])) { ?>
			<div class="alert alert-danger">
				Aprobaci&oacute;n incorrecta *
			</div>
		<?php } ?>
		<?php if (isset($_GET['aprobacion_no_especificada'])) { ?>
			<div class="alert alert-danger">
				Aprobaci&oacute;n incorrecta, porque aprobaci&oacute;n no fue especificada *
			</div>
		<?php } ?>
		<?php if (isset($_GET['motivo_desaprobacion_no_especificada'])) { ?>
			<div class="alert alert-danger">
				Aprobaci&oacute;n incorrecta, porque motivo de desaprobaci&oacute;n no fue especificado *
			</div>
		<?php } ?>
		<?php if (isset($_GET['prestamo_aprobado_exitosamente']) && !empty($_GET['id_prestamo']) && !empty($_GET['aprobacion'])) {
			if ($_GET['aprobacion'] === 'si') { ?>
				<div class="alert alert-success">
					Registro de espacio f&iacute;sico marcado como "aprobado", id de aprobacion: <?=$_GET['id_prestamo']?>
				</div>
			<?php } elseif ($_GET['aprobacion'] === 'no') { ?>
				<div class="alert alert-warning">
					Registro de espacio f&iacute;sico marcado como "no aprobado", con id de aprobacion: <?=$_GET['id_prestamo']?>
				</div>
			<?php } ?>
		<?php } ?>
		<?php if (!$prestamos_pendientes) { ?>
			<div class="alert alert-primary">
				Por el momento no hay prestamos pendientes para aprobar, gracias
			</div>
		<?php } else { ?>
			<div class="table-responsive">
				<table class="table table-light table-hover table-bordered text-center">
					<caption>Bienes y/o espacios f&iacute;sicos pendientes de aprobaci&oacute;n</caption>
					<thead>
						<tr>
							<th>Id. pr&eacute;stamo</th>
							<th>Fecha registro</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
							<th>Elemento solicitado</th>
							<th>Solicitante</th>
							<th>C&eacute;dula</th>
							<th>Descripci&oacute;n Bien(es)</th>
							<th>Finalidad</th>
							<th>Realizar aprobaci&oacute;n</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($prestamos_pendientes as $prestamo_pendiente) { ?>
							<tr>
								<td><?=$prestamo_pendiente->id_prestamo?></td>
								<td><?=$prestamo_pendiente->fecha_solicitud_bien?></td>
								<td><?=$prestamo_pendiente->fecha_entrega_bien?></td>
								<td><?=$prestamo_pendiente->fecha_fin_bien?></td>
								<td><?=$prestamo_pendiente->nombre_bien?></td>
								<td><?=$prestamo_pendiente->nombre_del_solicitante?></td>
								<td><?=$prestamo_pendiente->numero_documento_del_solicitante?></td>
								<td><?=$prestamo_pendiente->descripcion_prestamo?></td>
								<td><?=$prestamo_pendiente->finalidad_prestamo?></td>
								<td>
									<a class="btn btn-danger" onclick="desaprobar(event, this)" href="aprobar_prestamo.php?id_prestamo=<?=$prestamo_pendiente->id_prestamo?>&aprobacion=no" style="background: #f00"><i class="fa fa-check"></i></a>
									<a class="btn btn-primary" href="aprobar_prestamo.php?id_prestamo=<?=$prestamo_pendiente->id_prestamo?>&aprobacion=si"><i class="fa fa-check-double"></i></a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>
	</div>
</div>

<script>
	function desaprobar(e, desaprobar_boton) {
		e.preventDefault();
		const motivo_desaprobacion = prompt("Escribe el motivo por el cual no se va a aprobar este bien o espacios físico del ITFIP.\n\n"),
		URI = `${desaprobar_boton.href}&motivo_desaprobacion=${motivo_desaprobacion}`;
		if (!motivo_desaprobacion) {
			e.preventDefault();
			alert("No especificó el motivo de desaprobación, por favor intente nuevamente.\n\n")
		} else {
			location.href = URI;
		}
	}
</script>

<?php include_once 'pie.php';