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
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->string('licencia');
            $table->string('no_serie');
            $table->longText('observaciones')->nullable(true);
            $table->bigInteger('cat_software_id')->unsigned();
            $table->bigInteger('usuario_empresa_id')->unsigned();
            $table->timestamps();
            $table->foreign('cat_software_id')->references('id')->on('cat_software')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('software');
    }
};
