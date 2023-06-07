<?php

namespace app\SpaceItfip\Controladores;

class AprobacionPrestamosControlador
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
        $estamento = $base_de_datos->query("SELECT * FROM aprobacion_prestamos_bienes_itfip");
        return $estamento->fetchAll();
    }

    /**
     * [aprobar description]
     * @param  [type] $id_prestamo [description]
     * @return [type]              [description]
     */
    public static function aprobar($id_prestamo, $aprobacion_prestamo, $motivo_desaprobacion)
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$fecha_aprobacion_bien description]
         * @var [type]
         */
        $fecha_aprobacion_bien = TiempoControlador::fechaHoraHoy();
        /**
         * [$estamento description]
         * @var [type]
         */
        $motivo_desaprobacion = $motivo_desaprobacion ?? '';
        $estamento = $base_de_datos->prepare("INSERT INTO aprobacion_prestamos_bienes_itfip (fecha_aprobacion_bien, id_prestamo, aprobacion_prestamo, observacion_prestamo) VALUES (?, ?, ?, ?)");
        $estamento->execute([$fecha_aprobacion_bien, $id_prestamo, $aprobacion_prestamo, $motivo_desaprobacion]);
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("UPDATE registro_prestamos_bienes_itfip SET aprobacion_pendiente = 'no' WHERE registro_prestamos_bienes_itfip.id_prestamo = ?");
        return $estamento->execute([$id_prestamo]);
    }

}
