<?php

/**
 * [$espacio description]
 * @var [type]
 */
$espacio = ucwords(strtolower($_POST['espacio']));

if (!$espacio) {
  header('Location: Generar.php?falta_espacio');
     if (!is_string($espacio)){
       header(sprintf('Location: guardar_espacio.php?'));
       exit;
    }
  exit;
}

/*if (!is_string($espacio)){
    header('Location: guardar_registro.php?');
    exit;
}*/

include 'vendor/autoload.php';
use app\SpaceItfip\Controladores\PrestamosControlador;

PrestamosControlador::registrarbien($espacio);
header('Location: Generar.php?registro_del_bien_exitoso');

