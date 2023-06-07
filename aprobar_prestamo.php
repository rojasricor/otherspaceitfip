<?php

include_once 'verificar_sesion.php';

/**
 * [$id_prestamo description]
 * @var [type]
 */
$id_prestamo = $_GET['id_prestamo'];
/**
 * [$aprobacion_prestamo description]
 * @var [type]
 */
$aprobacion_prestamo = $_GET['aprobacion'];

if (!$id_prestamo) {
    header('Location: aprobar.php?prestamo_no_especificado');
    exit;
}

if (!$aprobacion_prestamo) {
    header('Location: aprobar.php?aprobacion_no_especificada');
    exit;
}

if ('no' === $aprobacion_prestamo) {
    /**
     * [$motivo_desaprobacion description]
     * @var [type]
     */
    $motivo_desaprobacion = $_GET['motivo_desaprobacion'];
    if (!$motivo_desaprobacion) {
        header('Location: aprobar.php?motivo_desaprobacion_no_especificada');
        exit;
    }
}

include_once 'vendor/autoload.php';
use app\SpaceItfip\Controladores\AprobacionPrestamosControlador;

if (AprobacionPrestamosControlador::aprobar($id_prestamo, $aprobacion_prestamo, $motivo_desaprobacion)) {
    header(sprintf('Location: aprobar.php?prestamo_aprobado_exitosamente&id_prestamo=%s&aprobacion=%s', $id_prestamo, $aprobacion_prestamo));
}
