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
        Schema::table('reasignacion', function (Blueprint $table) {
            $table->bigInteger('estatus_id')->unsigned()->after('ticket_id');
            $table->foreign('estatus_id')->references('id')->on('estatus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reasignacion', function (Blueprint $table) {
            $table->dropColumn(['estatus_id']);
        });
    }
};
