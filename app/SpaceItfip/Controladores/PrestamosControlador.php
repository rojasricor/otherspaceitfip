<?php

namespace app\SpaceItfip\Controladores;

class PrestamosControlador
{
    public static function obtenerPrestamosPorBienYFecha(
        string $id_bien,
        string $fecha_inicio,
        string $fecha_fin
    ): array
    {
        // Obtener la conexion a la base de datos
        $base_de_datos = BaseDeDatos::obtener();

        // Consulta para obtener los prestamos por el id del bien y la fecha de inicio y fin
        $estamento = $base_de_datos->prepare("SELECT * FROM registro_prestamos_bienes_itfip, bienes_itfip, aprobacion_prestamos_bienes_itfip WHERE registro_prestamos_bienes_itfip.id_bien = bienes_itfip.id_bien AND aprobacion_prestamos_bienes_itfip.id_prestamo = registro_prestamos_bienes_itfip.id_prestamo AND registro_prestamos_bienes_itfip.id_bien = ? AND (registro_prestamos_bienes_itfip.fecha_entrega_bien BETWEEN ? AND ?) AND (registro_prestamos_bienes_itfip.fecha_fin_bien BETWEEN ? AND ?) ORDER BY registro_prestamos_bienes_itfip.id_prestamo ASC;");

        // Ejecutar la consulta
        $estamento->execute([
            $id_bien,
            $fecha_inicio,
            $fecha_fin,
            $fecha_inicio,
            $fecha_fin
        ]);

        // retornar los resultados
        return $estamento->fetchAll();
    }

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
        $estamento = $base_de_datos->query("SELECT * FROM registro_prestamos_bienes_itfip rpbi, bienes_itfip bi, aprobacion_prestamos_bienes_itfip apbi WHERE rpbi.id_bien = bi.id_bien AND apbi.id_prestamo = rpbi.id_prestamo ORDER BY rpbi.id_prestamo ASC");
        return $estamento->fetchAll();
    }

    /**
     * [obtenerPorBien description]
     * @param  [type] $id_bien [description]
     * @return [type]          [description]
     */
    public static function obtenerPorBien($id_bien)
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
        $estamento = $base_de_datos->prepare("SELECT * FROM registro_prestamos_bienes_itfip rpbi, bienes_itfip bi, aprobacion_prestamos_bienes_itfip apbi WHERE rpbi.id_bien = ? AND rpbi.id_bien = bi.id_bien AND apbi.id_prestamo = rpbi.id_prestamo ORDER BY rpbi.id_prestamo ASC");
        $estamento->execute([$id_bien]);
        return $estamento->fetchAll();
    }

    /**
     * [obtenerPendientesPorBien description]
     * @param  [type] $id_bien [description]
     * @return [type]          [description]
     */
    public static function obtenerPendientesPorBien($id_bien)
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$pendiente description]
         * @var string
         */
        $pendiente = 'si';
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("SELECT * FROM registro_prestamos_bienes_itfip rpbi, bienes_itfip bi WHERE rpbi.id_bien = ? AND rpbi.id_bien = bi.id_bien AND rpbi.aprobacion_pendiente = ? ORDER BY rpbi.id_prestamo ASC");
        $estamento->execute([$id_bien, $pendiente]);
        return $estamento->fetchAll();
    }

    /**
     * [obtenerPendientes description]
     * @return [type] [description]
     */
    public static function obtenerPendientes()
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$pendiente description]
         * @var string
         */
        $pendiente = 'si';
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("SELECT * FROM registro_prestamos_bienes_itfip rpbi, bienes_itfip bi WHERE rpbi.id_bien = bi.id_bien AND rpbi.aprobacion_pendiente = ? ORDER BY rpbi.id_prestamo ASC");
        $estamento->execute([$pendiente]);
        return $estamento->fetchAll();
    }

    

    /**
     * [registrar description]
     * @param  [type] $bien        [description]
     * @param  [type] $solicitante [description]
     * @param  [type] $cedula      [description]
     * @param  [type] $direccion   [description]
     * @param  [type] $telefono    [description]
     * @param  [type] $descripcion [description]
     * @param  [type] $finalidad   [description]
     * @return [type]              [description]
     */
    public static function registrar($bien, $solicitante, $fecha_entrega_bien, $fecha_fin_bien, $cedula, $direccion, $telefono, $descripcion, $finalidad)
    {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$fecha_solicitud_bien description]
         * @var [type]
         */
        $fecha_solicitud_bien = TiempoControlador::fechaHoraHoy();
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("INSERT INTO registro_prestamos_bienes_itfip (fecha_solicitud_bien, id_bien, fecha_entrega_bien, fecha_fin_bien, nombre_del_solicitante, numero_documento_del_solicitante, direccion_del_solicitante, telefono_del_solicitante, descripcion_prestamo, finalidad_prestamo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $estamento->execute([$fecha_solicitud_bien, $bien, $fecha_entrega_bien, $fecha_fin_bien, $solicitante, $cedula, $direccion, $telefono, $descripcion, $finalidad]);
    }

    public static function registrarbien($espacio)
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
        $estamento = $base_de_datos->prepare("INSERT INTO bienes_itfip(nombre_bien) VALUES (?)");
        return $estamento->execute([$espacio]);
    }


    /**
     * [verificarSiEstaDisponible description]
     * @param  [type] $fecha_entrega_bien [description]
     * @param  [type] $fecha_fin_bien     [description]
     * @return [type]                     [description]
     */
    public static function verificarSiEstaDisponible($fecha_entrega_bien, $fecha_fin_bien) {
        /**
         * [$base_de_datos description]
         * @var [type]
         */
        $base_de_datos = BaseDeDatos::obtener();
        /**
         * [$aprobacion_prestamo description]
         * @var string
         */
        $aprobacion_prestamo = 'si';
        /**
         * [$execute description]
         * @var [type]
         */
        $execute = [
            $fecha_entrega_bien,
            $fecha_fin_bien,
            $aprobacion_prestamo
        ];
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("SELECT rpbi.id_prestamo, rpbi.fecha_entrega_bien, rpbi.fecha_fin_bien FROM registro_prestamos_bienes_itfip rpbi, aprobacion_prestamos_bienes_itfip apbi WHERE (rpbi.fecha_entrega_bien BETWEEN ? AND ?) AND rpbi.id_prestamo = apbi.id_prestamo AND apbi.aprobacion_prestamo = ?");
        $estamento->execute($execute);
        /**
         * [$val1 description]
         * @var [type]
         */
        $val1 = $estamento->fetchAll();
        /**
         * [$estamento description]
         * @var [type]
         */
        $estamento = $base_de_datos->prepare("SELECT rpbi.id_prestamo, rpbi.fecha_entrega_bien, rpbi.fecha_fin_bien FROM registro_prestamos_bienes_itfip rpbi, aprobacion_prestamos_bienes_itfip apbi WHERE (rpbi.fecha_fin_bien BETWEEN ? AND ?) AND rpbi.id_prestamo = apbi.id_prestamo AND apbi.aprobacion_prestamo = ?");
        $estamento->execute($execute);
        /**
         * [$val2 description]
         * @var [type]
         */
        $val2 = $estamento->fetchAll();
        return $val1 || $val2 ? [
            'disponibilidad' => false,
            'recomendaciones' => [
                $val1,
                $val2
            ]
        ] : ['disponibilidad' => true];
    }

}
