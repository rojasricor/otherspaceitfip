<?php

include_once 'vendor/autoload.php';
use app\SpaceItfip\Controladores\SesionControlador;

SesionControlador::redireccionarSiNoHaIniciadoSesion();

/**
 * [$id description]
 * @var [type]
 */
$id = $_SESSION['id_administrador'];
/**
 * [$admin1_2 description]
 * @var [type]
 */
$admin1_2 = 1 === $id || 2 === $id;
/**
 * [$administrador_3 description]
 * @var [type]
 */
$administrador_3 = 3 === $id;
