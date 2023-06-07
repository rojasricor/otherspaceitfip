<?php

namespace app\SpaceItfip\Controladores;

class BienesItfipControlador
{

	/**
	 * [obtenerTodos description]
	 * @return [type] [description]
	 */
    public static function obtenerTodos()
    {
        // Obtener la conexión a la base de datos
        $base_de_datos = BaseDeDatos::obtener();

        // Obtener todos los bienes_itfip donde el estado sea habilitado (1)
        $estamento = $base_de_datos->query("SELECT * FROM bienes_itfip WHERE estado = 1");

        // Retornar los bienes_itfip habilitados
        return $estamento->fetchAll();
    }

    public static function obtenerBienesAdministrar()
    {
        // Obtener la conexión a la base de datos
        $base_de_datos = BaseDeDatos::obtener();

        // Obtener todos los bienes_itfip
        $estamento = $base_de_datos->query("SELECT * FROM bienes_itfip");

        // Retornar los bienes_itfip
        return $estamento->fetchAll();
    }

    public static function habilitar($id_bien,$habilitar)
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
        $estamento = $base_de_datos->prepare("UPDATE bienes_itfip SET estado = '0' WHERE bienes_itfip.id_bien=?");
        return $estamento->execute([$id_bien]);
        /**
         * [$estamento description]
         * @var [type]
         */
        /*$estamento = $base_de_datos->prepare("UPDATE registro_prestamos_bienes_itfip SET aprobacion_pendiente = 'no' WHERE registro_prestamos_bienes_itfip.id_prestamo = ?");
        return $estamento->execute([$id_prestamo]);*/
    }

    public static function habilitarsi($id_bien,$habilitar)
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
        $estamento = $base_de_datos->prepare("UPDATE bienes_itfip SET estado = '1' WHERE bienes_itfip.id_bien=?");
        return $estamento->execute([$id_bien]);
        /**
         * [$estamento description]
         * @var [type]
         */
        /*$estamento = $base_de_datos->prepare("UPDATE registro_prestamos_bienes_itfip SET aprobacion_pendiente = 'no' WHERE registro_prestamos_bienes_itfip.id_prestamo = ?");
        return $estamento->execute([$id_prestamo]);*/
    }

}
