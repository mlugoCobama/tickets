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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('correo_id')->unsigned();
            $table->bigInteger('quien_asigna')->unsigned();
            $table->bigInteger('asignado_a')->unsigned();
            $table->dateTime('fecha_asignacion')->nullable();
            $table->bigInteger('area_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->longText('solucion')->nullable();
            $table->foreign('correo_id')->references('id')->on('correos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('quien_asigna')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('asignado_a')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
