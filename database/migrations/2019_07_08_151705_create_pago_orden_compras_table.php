<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->float('monto')->nullable();
            $table->string('comprobante_monto')->nullable();
            $table->float('tipo_cambio')->nullable();
            $table->integer('bfcv')->nullable();
            $table->float('pago')->nullable();
            $table->string('comprobante_pago')->nullable();
            $table->float('tipo_cambio_pago')->nullable();
            $table->float('total_pagado')->nullable();
            $table->float('restante')->nullable();
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->foreign('orden_compra_id')->references('id')->on('orden_compra')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_orden_compra');
    }
}
