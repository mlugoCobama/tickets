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
            DROP PROCEDURE IF EXISTS SP_ticket_areas;
            CREATE DEFINER=`user_sistema_tickets`@`localhost` PROCEDURE `SP_ticket_areas`( IN cat_empresa_id INT )
            BEGIN
                IF cat_empresa_id=0
                    THEN
                        SELECT
                            A.nombre,
                            COUNT(DISTINCT T.correo_id) as total
                        FROM
                            areas A
                        INNER JOIN
                            tickets T
                        ON
                            T.area_id = A.id
                        GROUP BY
                            T.area_id;
                ELSE
                        SELECT
                            A.nombre,
                            COUNT(DISTINCT T.correo_id) as total
                        FROM
                            areas A
                        INNER JOIN
                            tickets T
                        ON
                            T.area_id = A.id
                        AND T.cat_empresa_id = cat_empresa_id
                        GROUP BY
                            T.area_id;
                END IF;
            END;;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SP_ticket_tecnicos');
    }
};
