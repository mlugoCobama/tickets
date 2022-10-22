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
        Schema::create('reasignacion', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('solicitante_id')->unsigned();
            $table->string('comentario');
            $table->bigInteger('asignado_id')->unsigned();
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('ticket_id')->unsigned();
            $table->tinyInteger('confirmado')->unsigned()->default(0);
            $table->foreign('solicitante_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('asignado_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reasignacion');
    }
};
