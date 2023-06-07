<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPACEITFIP | Iniciar sesi&oacute;n</title>
	<link rel="icon" href="img/Space_itfip_logotype.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: flex;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			max-width: 330px;
			padding: 15px;
		}

		.form-signin .form-floating:focus-within {
			z-index: 2;
		}

		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>
<body class="text-center">

	<main class="form-signin w-100 m-auto">
		<?php if (isset($_GET['correo_vacio'])) { ?>
			<div class="alert alert-warning">
				Ingrese el correo institucional *
			</div>
		<?php } ?>
		<?php if (isset($_GET['clave_vacia'])) { ?>
			<div class="alert alert-warning">
				Ingrese la contrase&ntilde;a *
			</div>
		<?php } ?>
		<?php if (isset($_GET['correo_invalido'])) { ?>
			<div class="alert alert-warning">
				El correo no es v&aacute;lido debe ser @itfip.edu.co *
			</div>
		<?php } ?>
		<?php if (isset($_GET['clave_invalida'])) { ?>
			<div class="alert alert-warning">
				La contrase&ntilde;a debe tener m&iacute;nimo 8 caracteres *
			</div>
		<?php } ?>
		<?php if (isset($_GET['credenciales_incorrectas'])) { ?>
			<div class="alert alert-danger">
				El correo ingresado o la contrase&ntilde;a son incorrectas *
			</div>
		<?php } ?>
		<?php if (isset($_GET['sesion_cerrada'])) { ?>
			<div class="alert alert-success">
				Has cerrado sesi&oacute;n
			</div>
		<?php } ?>
		<?php if (isset($_GET['iniciar_sesion'])) { ?>
			<div class="alert alert-primary">
				Bienvenido, por favor inicia sesi&oacute;n
			</div>
		<?php } ?>
		<form action="iniciar_sesion.php" method="post">
			<img class="mb-4" src="img/Space_itfip_logotype.png" alt="Logo SpaceItfip" width="72" height="72">
			<h1 class="h2 mb-3 fw-normal">SpaceITFIP</h1>
			<span>
				S&oacute;ftware para pr&eacute;stamo y retiros de elementos y/o pr&eacute;stamo de espacios f&iacute;sicos del ITFIP.
			</span>
			<div class="form-floating mt-2">
				<input required name="correo" type="email" class="form-control" placeholder="name@itfip.edu.co">
				<label for="floatingInput">Correo institucional: </label>
			</div>
			<div class="form-floating">
				<input required name="clave" type="password" class="form-control" placeholder="Contrase&ntilde;a">
				<label for="floatingPassword">Contrase&ntilde;a: </label>
			</div>

			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" name="recordarme"> Recuerdame
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary">Iniciar Sesi&oacute;n</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2022</p>
		</form>
	</main>

</body>
</html>