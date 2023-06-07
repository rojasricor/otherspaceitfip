<?php

include_once 'vendor/autoload.php';
use app\SpaceItfip\Controladores\SesionControlador;

SesionControlador::cerrarSesion();

header('Location: login.php?sesion_cerrada');
