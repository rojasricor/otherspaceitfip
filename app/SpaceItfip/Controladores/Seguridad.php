<?php

namespace app\SpaceItfip\Controladores;

class Seguridad
{

    /**
     * [encriptarClave description]
     * @param  [type] $clave [description]
     * @return [type]        [description]
     */
    public static function encriptarClave($clave)
    {
        return password_hash(self::prepararPatronClave($clave), PASSWORD_BCRYPT);
    }

    /**
     * [verificarClave description]
     * @param  [type] $clave  [description]
     * @param  [type] $patron [description]
     * @return [type]         [description]
     */
    public static function verificarClave($clave, $patron)
    {
        return password_verify(self::prepararPatronClave($clave), $patron);
    }

    /**
     * [prepararPatronClave description]
     * @param  [type] $clave [description]
     * @return [type]        [description]
     */
    public static function prepararPatronClave($clave)
    {
        return hash('sha256', $clave);
    }

}
