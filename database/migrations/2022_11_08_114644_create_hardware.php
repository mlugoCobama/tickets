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
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('no_serie');
            $table->string('memoria_ram')->nullable(true);
            $table->string('disco_duro')->nullable(true);
            $table->string('procesador')->nullable(true);
            $table->longText('caracteristicas')->nullable(true);
            $table->longText('observaciones')->nullable(true);
            $table->bigInteger('cat_hardware_id')->unsigned();
            $table->bigInteger('usuario_empresa_id')->unsigned();
            $table->timestamps();
            $table->foreign('cat_hardware_id')->references('id')->on('cat_hardware')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usuario_empresa_id')->references('id')->on('usuarios_empresas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('hardware');
    }
};
