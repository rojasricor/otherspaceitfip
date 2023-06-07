<?php

namespace app\SpaceItfip\Controladores;

class AdministradoresControlador
{

    /**
     * [obtenerTodos description]
     * @return [type] [description]
     */
    public static function obtenerTodos()
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->query("SELECT * FROM administradores_spaceitfip");
        return $estamento->fetchAll();
    }

    /**
     * [obtenerTodo description]
     * @param  [type] $correo [description]
     * @return [type]         [description]
     */
    public static function obtenerTodo($correo)
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("SELECT * FROM administradores_spaceitfip WHERE correo_institucional_administrador = ?");
        $estamento->execute([$correo]);
        return $estamento->fetchObject();
    }

    /**
     * [actualizarClave description]
     * @param  [type] $id    [description]
     * @param  [type] $clave [description]
     * @return [type]        [description]
     */
    public static function actualizarClave($id, $clave)
    {
        /**
         * [$clave_encriptada description]
         * @var [type]
         */
        $clave_encriptada = Seguridad::encriptarClave($clave);
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("UPDATE administradores_spaceitfip SET contraseña_administrador = ? WHERE id_administrador = ?");
        $estamento->execute([$clave_encriptada, $id]);
    }

    /**
     * [autenticar description]
     * @param  [type] $clave_ingresada     [description]
     * @param  [type] $clave_base_de_datos [description]
     * @return [type]                      [description]
     */
    public static function autenticar($clave_ingresada, $clave_base_de_datos)
    {
        return Seguridad::verificarClave($clave_ingresada, $clave_base_de_datos);
    }

}
