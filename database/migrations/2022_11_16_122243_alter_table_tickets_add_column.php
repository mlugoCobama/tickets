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
        Schema::table('tickets', function (Blueprint $table) {
            $table->bigInteger('cat_empresa_id')->unsigned()->after('asignado_a');

            $table->foreign('cat_empresa_id')->references('id')->on('cat_empresas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_empresas', function (Blueprint $table) {
            $table->dropColumn('cat_empresa_id');
        });
    }
};
