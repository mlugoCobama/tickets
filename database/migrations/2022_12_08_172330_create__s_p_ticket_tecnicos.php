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
            CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ticket_tecnicos`( IN cat_empresa_id INT )
            BEGIN
                IF cat_empresa_id=0
                    THEN
                        SELECT
                            U.name,
                            COUNT(DISTINCT T.correo_id) AS total
                        FROM
                            users as U
                        INNER JOIN
                            tickets as T
                        ON
                            T.asignado_a = U.id
                        GROUP BY
                            T.asignado_a;
                ELSE
                        SELECT
                            U.name,
                            COUNT(DISTINCT T.correo_id) AS total
                        FROM
                            users as U
                        INNER JOIN
                            tickets as T
                        ON
                            T.asignado_a = U.id
                        AND T.cat_empresa_id = cat_empresa_id
                        GROUP BY
                            T.asignado_a;
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
