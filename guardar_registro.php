<?php

/**
 * [$bien description]
 * @var [type]
 */
$bien = $_POST['bien'];
/**
 * [$fecha_entrega description]
 * @var [type]
 */
$fecha_entrega = $_POST['fecha_entrega'];
/**
 * [$hora_entrega description]
 * @var [type]
 */
$hora_entrega = $_POST['hora_entrega'];
/**
 * [$hora_fin description]
 * @var [type]
 */
$hora_fin = $_POST['hora_fin'];
/**
 * [$solicitante description]
 * @var [type]
 */
$solicitante = ucwords(strtolower($_POST['solicitante']));
/**
 * [$cedula description]
 * @var [type]
 */
$cedula = (int) $_POST['cedula'];
/**
 * [$direccion description]
 * @var [type]
 */
$direccion = ucwords(strtolower($_POST['direccion']));
/**
 * [$telefono description]
 * @var [type]
 */
$telefono = (int) $_POST['telefono'];
/**
 * [$descripcion description]
 * @var [type]
 */
$descripcion = ucfirst(strtolower($_POST['descripcion']));
/**
 * [$finalidad description]
 * @var [type]
 */
$finalidad = ucfirst(strtolower($_POST['finalidad']));

if (!$bien) {
    header('Location: registrar.php?bien_no_seleccionado');
    exit;
}

if (strtotime($hora_fin) === strtotime($hora_entrega)
    ||
    strtotime($hora_fin) < strtotime($hora_entrega)) {
    header(sprintf('Location: registrar.php?hora_fin_invalida&err=%s&exp=%s', $_POST['hora_fin'], $_POST['hora_entrega']));
    exit;
}

if (!$solicitante ) {
    header('Location: registrar.php?falta_solicitante');
    exit;
}

if (!$cedula
    ||
    strlen($cedula) < 8
    ||
    strlen($cedula) > 10
    ||
    !is_numeric($cedula)) {
    header(sprintf('Location: guardar_registro.php?'));
    exit;
}

if (!$direccion) {
    header('Location: registrar.php?falta_direccion');
    exit;
}

/*if(!$telefono){
    header('Location: registrar.php?falta_telefono');
       

}*/


//if (!$telefono
    /*||
    strlen($telefono) !== 10
    ||
    !is_numeric($telefono)) {
    
    //print "<script>alert('Error inmvalido');</script>";
    header(sprintf('Location: guardar_registro.php'));
    exit;
}*/

if (!$descripcion) {
    header('Location: registrar.php?falta_descripcion');
    exit;
}

if (!$finalidad) {
    header('Location: registrar.php?falta_finalidad');
    exit;
}

include 'vendor/autoload.php';
use app\SpaceItfip\Controladores\PrestamosControlador;

/**
 * [$fecha_entrega_bien description]
 * @var string
 */
$fecha_entrega_bien = "$fecha_entrega $hora_entrega";
/**
 * [$fecha_fin_bien description]
 * @var string
 */
$fecha_fin_bien = "$fecha_entrega $hora_fin";
/**
 * [$request description]
 * @var [type]
 */
$request = PrestamosControlador::verificarSiEstaDisponible($fecha_entrega_bien, $fecha_fin_bien);
/**
 * [$esta_disponible description]
 * @var [type]
 */
$esta_disponible = $request['disponibilidad'];

if (!$esta_disponible) {
    header('Location: registrar.php?espacio_ocupado');
    exit;
}

PrestamosControlador::registrar($bien, $solicitante, $fecha_entrega_bien, $fecha_fin_bien, $cedula, $direccion, $telefono, $descripcion, $finalidad);
header('Location: registrar.php?registro_prestamo_exitoso');
