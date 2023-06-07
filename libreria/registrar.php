<?php
include_once 'cabecera.php';
include_once 'verificar_sesion.php';
include_once 'navegacion.php';
use app\SpaceItfip\Controladores\BienesItfipControlador;
?>
<div class="row">
	<div class="col-12 mb-3">
		<h1 class="h2">Registrar pr&eacute;stamo de bienes o espacios f&iacute;sicos</h1>
	</div>
	<div class="col-lg-12 mb-3">
		<form action="guardar_registro.php" method="post" class="form-control bg-light mb-5">
			<?php if (isset($_GET['bien_no_seleccionado'])) { ?>
				<div class="alert alert-warning">
					Seleccione el bien o elemento a prestar *
				</div>
			<?php } ?>
			<?php if (isset($_GET['hora_fin_invalida']) && !empty($_GET['err']) && !empty($_GET['exp'])) { ?>
				<div class="alert alert-warning">
					Hora de finalizaci&oacute;n de la actividad es inv&aacute;lida para <?=$_GET['err']?> porque la fecha de inicio es <?=$_GET['exp']?> *
				</div>
			<?php } ?>
			<?php if (isset($_GET['falta_solicitante'])) { ?>
				<div class="alert alert-warning">
					Ingrese el nombre del responsable de la solicitud *
				</div>
			<?php } ?>
			<?php if (isset($_GET['cedula_invalida']) && !empty($_GET['err'])) { ?>
				<div class="alert alert-warning">
					El n&uacute;mero de documento <?=$_GET['err']?> es inv&aacute;lido *
				</div>
			<?php } ?>
			<?php if (isset($_GET['falta_direccion'])) { ?>
				<div class="alert alert-warning">
					Ingrese la direcci&oacute;n del solicitante *
				</div>
			<?php } ?>
			<?php if (isset($_GET['telefono_invalido']) && !empty($_GET['err'])) { ?>
				<div class="alert alert-warning">
					El n&uacute;mero de tel&eacute;fono <?=$_GET['err']?> es inv&aacute;lido *
				</div>
			<?php } ?>
			<?php if (isset($_GET['falta_descripcion'])) { ?>
				<div class="alert alert-warning">
					Ingrese la descripci&oacute;n del bien o elemento a prestar *
				</div>
			<?php } ?>
			<?php if (isset($_GET['falta_finalidad'])) { ?>
				<div class="alert alert-warning">
					Ingrese la finalidad con la que se har&aacute; el pr&eacute;stamo de dicho bien *
				</div>
			<?php } ?>
			<?php if (isset($_GET['registro_prestamo_exitoso'])) { ?>
				<div class="alert alert-success">
					Pr&eacute;stamo registrado exitosamente, pendiente para su posterior aprobaci&oacute;n
				</div>
			<?php } ?>
			<?php if (isset($_GET['espacio_ocupado'])) { ?>
				<div class="alert alert-danger">
					El espacio ya se encuentra prestado en esa fecha y hora
				</div>
			<?php } ?>
			<div class="col-12 mb-3">
				<div class="table-responsive">
					<table class="table table-hover">
						<caption>Registrar pr&eacute;stamo</caption>
						<tr>
							<th colspan="3">
								<div class="form-floating mb-3">
									<select required name="bien" class="form-select btn btn-light mr-sm-2">
										<option disabled value='unset' selected>No seleccionado</option>
										<?php foreach(BienesItfipControlador::obtenerTodos() as $bien) { ?>
											<option value="<?=$bien->id_bien?>"><?=$bien->nombre_bien?></option>
										<?php } ?>
									</select>
									<label class="form-label" for="bien">Espacio f&iacute;sico: </label>
								</div>
							</th>
						</tr>
						<tr>
							<th>
								<div class="form-floating mb-3">
									<input name="fecha_entrega" class="form-control" type="date">
									<label class="form-label" for="fecha_entrega">Fecha de entrega elemento solicitado: </label>
								</div>
							</th>
							<th>
								<div class="form-floating mb-3">
									<input name="hora_entrega" class="form-control" type="time">
									<label class="form-label" for="hora_entrega">Hora de entrega elemento solicitado (Inicio actividad): </label>
								</div>
							</th>
							<th>
								<div class="form-floating mb-3">
									<input name="hora_fin" class="form-control" type="time">
									<label class="form-label" for="hora_fin">Hora de finalizaci&oacute;n de la actividad: </label>
								</div>
							</th>
						</tr>
						<tr>
							<th colspan="3">
								<div class="form-floating mb-3">
									<input required name="solicitante" class="form-control" type="text">
									<label class="form-label" for="solicitante">Nombre responsable de la solicitud: </label>
								</div>
							</th>
						</tr>
						<tr>
							<th>
								<div class="form-floating mb-3">
									<input required name="cedula" class="form-control" type="number" maxlength="10">
									<label class="form-label" for="cedula">No. Documento de Identidad: </label>
								</div>
							</th>
							<th>
								<div class="form-floating mb-3">
									<input required name="telefono" class="form-control" type="number" maxlength="10">
									<label class="form-label" for="telefono">Tel&eacute;fono: </label>
								</div>
							</th>
							<th>
								<div class="form-floating mb-3">
									<input required name="direccion" class="form-control" type="text">
									<label class="form-label" for="direccion">Direcci&oacute;n: </label>
								</div>
							</th>
						</tr>
						<tr>

						</tr>
						<tr>
							<th colspan="2">
								<div class="form-floating mb-3">
									<textarea required name="descripcion" class="form-control" autocomplete="off" style="height: 100px"></textarea>
									<label class="form-label" for="descripcion">DESCRIPCI&Oacute;N DEL BIEN O ESPACIOS F&Iacute;SICOS, N&Uacute;MERO DE INVENTARIO: </label>
								</div>
							</th>
							<th>
								<div class="form-floating mb-3">
									<textarea required name="finalidad" class="form-control" autocomplete="off" style="height: 100px"></textarea>
									<label class="form-label" for="finalidad">FINALIDAD: </label>
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
<?php include_once 'pie.php';