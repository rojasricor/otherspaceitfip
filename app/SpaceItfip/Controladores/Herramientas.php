<?php

namespace app\SpaceItfip\Controladores;

use Exception;

class Herramientas
{

    /**
     * [obtenerVariablesDeEntorno description]
     * @param  [type] $llave [description]
     * @return [type]      [description]
     */
    public static function obtenerVariablesDeEntorno($llave)
    {
        if (defined('_ENV_CACHE')) {
            /**
             * [$variables description]
             * @var [type]
             */
            $variables = _ENV_CACHE;
        } else {
            /**
             * [$archivo description]
             * @var [type]
             */
            $archivo = 'env.php';
            /**
             * [$_f description]
             * @var integer
             */
            if (!file_exists($archivo)) {
                throw new Exception("El archivo de variables de entorno ($archivo) no existe. Por favor crearlo");
            }
            $variables = parse_ini_file($archivo);
            define('_ENV_CACHE', $variables);
        }
        if (isset($variables[$llave])) {
            return $variables[$llave];
        } else {
            throw new Exception("La llave especificada ($llave) no existen en el archivo de las variables de entorno");
        }
    }
}
