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
        Schema::create('usuarios_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('titular');
            $table->string('area');
            $table->string('puesto');
            $table->string('ucoip');
            $table->string('usuario_as')->nullable(true);
            $table->string('ip');
            $table->string('extension');
            $table->string('movil')->nullable(true);
            $table->tinyInteger('activo')->default(1);
            $table->bigInteger('cat_empresa_id')->unsigned();
            $table->timestamps();
            $table->foreign('cat_empresa_id')->references('id')->on('cat_empresas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('usuarios_empresas');
    }
};
