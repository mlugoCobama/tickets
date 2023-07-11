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
            DROP PROCEDURE IF EXISTS SP_ticket_empresas;
            CREATE DEFINER=`user_sistema_tickets`@`localhost` PROCEDURE `SP_ticket_empresas`()
            BEGIN
                SELECT
                    E.nombre,
                    COUNT(DISTINCT T.correo_id) AS total
                FROM
                    cat_empresas E
                INNER JOIN
                    tickets T
                ON
                    T.cat_empresa_id = E.id
                GROUP BY
                    T.cat_empresa_id;
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
        Schema::dropIfExists('SP_ticket_empresas');
    }
};
