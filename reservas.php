<?php
include_once 'cabecera.php';
include_once 'verificar_sesion.php';
include_once 'navegacion.php';
use app\SpaceItfip\Controladores\BienesItfipControlador;
use app\SpaceItfip\Controladores\PrestamosControlador;

// Arreglo que guarda los prestamos a mostrar
$prestamos = [];

// Si existe el parametro busqueda, la fecha de inicio y la fecha de fin, se obtienen los prestamos por bien y fecha
if (!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_fin']) && !empty($_GET['busqueda'])) {
	$prestamos = PrestamosControlador::obtenerPrestamosPorBienYFecha($_GET['busqueda'], $_GET['fecha_inicio'], $_GET['fecha_fin']);
} else {
	// Si no existen los parametros, se obtienen todos los prestamos
	$prestamos = PrestamosControlador::obtenerTodos();
}

// Zona horaria America/Bogota
date_default_timezone_set('America/Bogota');
?>
<h> HOY: </h>
<?php
$hoy = date("Y-m-d");
echo $hoy;
?>

<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Mostrar si esta disponible el espacio a prestar</h1>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</div>

	<div class="col-lg-12 mb-3">
		<?php if (isset($_GET['falta_espacio'])) { ?>
			<div class="alert alert-warning">
				Ingrese el bien o espacio a registrar *
			</div>
		<?php } ?>

		<form>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label><b>Selecione el Dia</b></label>
						<input type="date" name="fecha_inicio" value="<?php if (isset($_GET['fecha_inicio'])) {
								echo $_GET['fecha_inicio'];
							} ?>"
							class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><b>Selecione hasta que dia</b></label>
						<input type="date" name="fecha_fin" value="<?php if (isset($_GET['fecha_fin'])) {
								echo $_GET['fecha_fin'];
							} ?>"
							class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><b>Seleccione el espacio a buscar</b></label>
						<select required name="busqueda" id="busqueda"
							class="form-select btn btn-light mr-sm-2 me-2" style="width: 270px" required>
							<option value="" selected>No seleccionado</option>
							<?php foreach (BienesItfipControlador::obtenerTodos() as $bien) { ?>
								<option value="<?= $bien->id_bien ?>" <?php if (!empty($_GET['busqueda'])) if ($_GET['busqueda'] == $bien->id_bien) { ?>selected<?php } ?>><?= $bien->nombre_bien ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><b></b></label> <br>
						<button type="submit" class="btn btn-primary">Buscar</button>
					</div>
				</div>
			</div>
			<br>
		</form>

	</div>
</div>

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
			<table class="table table-striped table-light table-hover table-bordered text-center">

				<caption>Bienes y/o espacios f&iacute;sicos prestados</caption>
				
				<thead class="thead-dark">
					<tr>
						<th>Id. pr&eacute;stamo</th>
						<th>Fecha y hora de inicio</th>
						<th>Fecha y hora final</th>
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
<?php include_once 'pie.php';