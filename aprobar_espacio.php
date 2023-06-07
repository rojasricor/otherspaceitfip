<?php

include_once 'verificar_sesion.php';

/**
 * [$id_prestamo description]
 * @var [type]
 */
$id_bien = $_GET['id_bien'];
/**
 * [$aprobacion_prestamo description]
 * @var [type]
 */
$habilitar = $_GET['habilitar'];

/*if (!$id_prestamo) {
    header('Location: aprobar.php?prestamo_no_especificado');
    exit;
}

if (!$aprobacion_prestamo) {
    header('Location: aprobar.php?aprobacion_no_especificada');
    exit;
}*/

use app\SpaceItfip\Controladores\BienesItfipControlador;

if ('no' === $habilitar) {

    if (BienesItfipControlador::habilitar($id_bien,$habilitar)) {
        header('Location: Generar.php?Espacio_Inhabilitado');
        return;
    }
}

if('si' === $habilitar) {

    if (BienesItfipControlador::habilitarsi($id_bien,$habilitar)) {
        header('Location: Generar.php?Espacio_Habilitado');
        return;
    }
}

