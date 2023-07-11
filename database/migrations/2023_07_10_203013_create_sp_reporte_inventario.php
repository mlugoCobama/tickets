<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared("
        DROP PROCEDURE IF EXISTS SP_reporte_inventario;
        CREATE DEFINER=`user_sistema_tickets`@`localhost` PROCEDURE `SP_reporte_inventario`(
            IN cat_empresa_id INT,
            IN area VARCHAR(255),
            IN puesto VARCHAR(255),
            IN ucoip VARCHAR(255)
        )
        BEGIN
            SELECT
                ce.nombre,
                ue.area,
                ue.puesto,
                ue.ucoip,
                ch.tipo,
                h.marca,
                h.modelo,
                h.no_serie,
                h.memoria_ram,
                h.disco_duro,
                h.procesador,
                h.caracteristicas
            FROM
                cat_empresas ce
            INNER JOIN
                usuarios_empresas ue
            ON
                ue.cat_empresa_id = ce.id
            INNER JOIN
                hardware h
            ON
                h.usuario_empresa_id =  ue.id
            INNER JOIN
                cat_hardware ch
            ON
                ch.id = h.cat_hardware_id
            WHERE
            ue.area LIKE CONCAT('%', area, '%')
            AND
            ue.puesto LIKE CONCAT('%', puesto, '%')
            AND
            ue.ucoip LIKE CONCAT('%', ucoip, '%')
            AND
            ce.id = cat_empresa_id;
        END;
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sp_reporte_inventario');
    }
};
