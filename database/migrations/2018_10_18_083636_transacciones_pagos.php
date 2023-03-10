<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransaccionesPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_payco');
            $table->integer('codigo_respuesta');
            $table->string('respuesta');
            $table->longText('data');
            $table->bigInteger('sesion_evento_id', unsigned: true);
            $table->unsignedInteger('cliente_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones_pagos');
    }
}
