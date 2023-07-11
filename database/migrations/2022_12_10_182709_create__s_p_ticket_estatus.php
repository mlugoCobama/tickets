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
            DROP PROCEDURE IF EXISTS SP_ticket_estatus;
            CREATE DEFINER=`user_sistema_tickets`@`localhost` PROCEDURE `SP_ticket_estatus`( IN cat_empresa_id INT )
            BEGIN
                IF cat_empresa_id=0
                    THEN
                        SELECT
                            E.nombre,
                            COUNT(DISTINCT T.correo_id) AS total
                        FROM
                            estatus E
                        INNER JOIN
                            tickets T
                        ON
                            T.status = E.id
                        GROUP BY
                            T.status;
                ELSE
                    SELECT
                        E.nombre,
                        COUNT(DISTINCT T.correo_id) AS total
                    FROM
                        estatus E
                    INNER JOIN
                        tickets T
                    ON
                        T.status = E.id
                    WHERE
                        T.cat_empresa_id = cat_empresa_id
                    GROUP BY
                        T.status;
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
        Schema::dropIfExists('SP_ticket_estatus');
    }
};
