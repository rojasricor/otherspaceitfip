<?php

/**
 * [$correo description]
 * @var [type]
 */
$correo = ucfirst(strtolower($_POST['correo']));
/**
 * [$clave description]
 * @var [type]
 */
$clave = $_POST['clave'];

if (!$correo) {
    header('Location: login.php?correo_vacio');
    exit;
}

if (!$clave) {
    header('Location: login.php?clave_vacia');
    exit;
}

if (!preg_match('/^[_.0-9a-zA-Z-]+@[itfip]+.[edu]+.[co]{2,6}$/i', $correo)) {
    header('Location: login.php?correo_invalido');
    exit;
}

if (strlen($clave) < 8) {
    header('Location: login.php?clave_invalida');
    exit;
}

include_once 'vendor/autoload.php';
use app\SpaceItfip\Controladores\SesionControlador;

if (!SesionControlador::iniciarSesion($correo, $clave)) {
    header('Location: login.php?credenciales_incorrectas');
    exit;
} else {
    header('Location: redireccionar.php');
}
