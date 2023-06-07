<?php

namespace app\SpaceItfip\Controladores;

use date;

date_default_timezone_set('America/Bogota');

class TiempoControlador
{

    /**
     * [fechaHoy description]
     * @return [type] [description]
     */
    public static function fechaHoy()
    {
        return date('Y-m-d');
    }

    /**
     * [horaActual description]
     * @return [type] [description]
     */
    public static function horaActual()
    {
        return date('h:i:s');
    }

    /**
     * [fechaHoraHoy description]
     * @return [type] [description]
     */
    public static function fechaHoraHoy()
    {
        return self::fechaHoy() . '_' . self::horaActual();
    }

    /**
     * [mesActual description]
     * @return [type] [description]
     */
    public static function mesActual()
    {
        return date('F');
    }

}
