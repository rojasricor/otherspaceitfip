<?php

namespace app\SpaceItfip\Controladores;

use PDO;

class BaseDeDatos
{

    /**
     * [obtener description]
     * @return [type] [description]
     */
    public static function obtener()
    {
        /**
         * [$clave description]
         * @var [type]
         */
        $clave = Herramientas::obtenerVariablesDeEntorno('CLAVE_MYSQL');
        /**
         * [$usuario description]
         * @var [type]
         */
        $usuario = Herramientas::obtenerVariablesDeEntorno('USUARIO_MYSQL');
        /**
         * [$nombre_base_de_datos description]
         * @var [type]
         */
        $nombre_base_de_datos = Herramientas::obtenerVariablesDeEntorno('BASE_DE_DATOS_MYSQL');
        /**
         * [$servidor description]
         * @var [type]
         */
        $servidor = Herramientas::obtenerVariablesDeEntorno('SERVIDOR_MYSQL');
        /**
         * [$base_de_datos description]
         * @var PDO
         */
        $base_de_datos = new PDO('mysql:host=' . $servidor . ';dbname=' . $nombre_base_de_datos, $usuario, $clave);
        $base_de_datos->query('set names utf8;');
        $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $base_de_datos;
    }

}
