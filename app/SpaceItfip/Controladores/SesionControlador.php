<?php

namespace app\SpaceItfip\Controladores;

class SesionControlador
{

    /**
     * [obtener description]
     * @return [type] [description]
     */
    public static function obtener(string $llave)
    {
        self::inicializarSesion();
        return $_SESSION[$llave];
    }

    /**
     * [iniciarSesion description]
     * @param  [type] $correo          [description]
     * @param  [type] $clave_ingresada [description]
     * @return [type]                  [description]
     */
    public static function iniciarSesion($correo, $clave_ingresada)
    {
        /**
         * [$datos_administrador description]
         * @var [type]
         */
        $datos_administrador = AdministradoresControlador::obtenerTodo($correo);
        if (!$datos_administrador) {
            return;
        } else {
            if (AdministradoresControlador::autenticar($clave_ingresada, $datos_administrador->contraseña_administrador)) {
                /**
                 * [$id description]
                 * @var [type]
                 */
                $id = $datos_administrador->id_administrador;
                /**
                 * [$nombres description]
                 * @var [type]
                 */
                $nombres = $datos_administrador->nombres_administrador;
                /**
                 * [$apellidos description]
                 * @var [type]
                 */
                $apellidos = $datos_administrador->apellidos_administrador;
                /**
                 * [$correo description]
                 * @var [type]
                 */
                $correo = $datos_administrador->correo_institucional_administrador;
                return self::dispersarUsuario($id, $nombres, $apellidos, $correo);
            }
        }
    }

    /**
     * [cerrarSesion description]
     * @return [type] [description]
     */
    public static function cerrarSesion()
    {
        self::inicializarSesion();
        session_destroy();
    }

    /**
     * [inicializarSesion description]
     * @return [type] [description]
     */
    public static function inicializarSesion()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

    /**
     * [dispersarUsuario description]
     * @param  [type] $id        [description]
     * @param  [type] $nombres   [description]
     * @param  [type] $apellidos [description]
     * @param  [type] $correo    [description]
     * @return [type]            [description]
     */
    public static function dispersarUsuario($id, $nombres, $apellidos, $correo)
    {
        self::inicializarSesion();
        $_SESSION['id_administrador']       = $id;
        $_SESSION['nombre_administrador']   = $nombres;
        $_SESSION['apellido_administrador'] = $apellidos;
        $_SESSION['correo_administrador']   = $correo;
        return true;
    }

    /**
     * [redireccionarSiNoHaIniciadoSesion description]
     * @return [type] [description]
     */
    public static function redireccionarSiNoHaIniciadoSesion()
    {
        self::inicializarSesion();
        if (!$_SESSION) {
            http_response_code(500);
            header('Location: login.php?iniciar_sesion');
        }
    }

}
