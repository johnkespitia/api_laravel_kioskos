<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre',100)->nullable(false);
            $table->string('segundo_nombre',100);
            $table->string('primer_apellido',100)->nullable(false);
            $table->string('segundo_apellido',100);
            $table->string('numero_documento',12)->nullable(false)->unique();
            $table->integer('tipo_documento_id')->unsigned()->nullable(false);
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('persona', function (Blueprint $table) {
            //
        //});
    }
}
