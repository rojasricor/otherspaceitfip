<?php
include_once 'cabecera.php';
include_once 'verificar_sesion.php';
include_once 'navegacion.php';
use app\SpaceItfip\Controladores\BienesItfipControlador;
?>
<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Registrar Bienes o Espacios F&iacute;sicos</h1>
	</div>
	<div class="col-lg-12 mb-3">
		<form action="guardar_espacio.php" method="post" class="form-control bg-light mb-5">
		<?php if (isset($_GET['falta_espacio'])) { ?>
				<div class="alert alert-warning">
					Ingrese el bien o espacio a registrar *
				</div>
			<?php } ?>
			<form action="guardar_espacio.php" method="post" class="form-control bg-light mb-5">
			<div class="col-12 mb-3">
				<div class="table-responsive">
					<table class="table table-hover">
						<caption>Registrar Bien o Espacio</caption>
						<tr>
							<th colspan="3">
								<div class="form-floating mb-3">
									<input required name="espacio" class="form-control" type="text">
									<label class="form-label" for="espacio">Nombre del espacio o bien: </label>
								</div>
							</th>
						</tr>
		            </table>
					<div class="form-group ml-2 mb-3">
						<button class="btn btn-danger" style="background: #f00;">Registrar</button>
					</div>	
		       </div>
		    </div>			
        </form>
    </div>
</div>

<?php
use app\SpaceItfip\Controladores\PrestamosControlador;
/**
 * [$prestamos description]
 * @var [type]
 */
$prestamos = !empty($_GET['busqueda'])
? PrestamosControlador::obtenerPorBien($_GET['busqueda'])
: PrestamosControlador::obtenerTodos();
// var_dump($prestamos);$activo=0;


?>
<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Deshabilitar o Habilitar Bienes o Espacios F&iacute;sicos</h1>
	</div>
	<div class="col-12 mb-5">
		<?php if (!$prestamos) { ?>
			<div class="alert alert-primary">
				No se encontr&oacute; ning&uacute;n registro
			</div>
		<?php } else { ?>
			<div class="table-responsive">
				<table class="table table-light table-hover table-bordered text-center">
					<caption>Bienes y/o espacios f&iacute;sicos </caption>
					<thead>
						<tr>
							<th>Id.bien</th>
							<th>Espacio solicitado</th>
							<th>Deshabilitar o Habilitar</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach (BienesItfipControlador::obtenerBienesAdministrar() as $bien) { ?>
						
							<tr>
							    <td><?=$bien->id_bien?></td>
								<td><?=$bien->nombre_bien?></td>
								<td>
									<?php if ($bien->estado === 1) { ?>
										<a class="btn btn-danger" href="aprobar_espacio.php?id_bien=<?=$bien->id_bien?>&habilitar=no" style="background: #f00"><i class="fa fa-check"></i></a>
										
									<?php } ?>
									<?php if ($bien->estado === 0) { ?>
										<a class="btn btn-primary" href="aprobar_espacio.php?id_bien=<?=$bien->id_bien?>&habilitar=si"><i class="fa fa-check-double"></i></a>
									<?php } ?>
								</td>
								<td>
									<?php if ($bien->estado === 1) { 
									$activo='Activo';

									echo $activo;
								}else{ 
									$Inactivo='Inactivo';
								    echo $Inactivo;

								}?> </td>
							</tr>
						<?php } ?>
						
					</tbody>
				</table>
			</div>
		<?php } ?>
	</div>
</div>

<?php include_once 'pie.php';