<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transito_orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guia')->nullable();
            $table->date('fecha_embarque')->nullable();
            $table->date('fecha_tentativa')->nullable();
            $table->string('comercual_invoce')->nullable();
            $table->string('comercial_invoce_file')->nullable();
            $table->integer('cajas')->nullable();
            $table->float('cbm')->nullable();
            $table->float('peso')->nullable();
            $table->unsignedInteger('metodo_id')->nullable();
            $table->unsignedInteger('forwarder_id')->nullable();
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->foreign('metodo_id')->references('id')->on('metodo_transito')->onDelete('cascade');
            $table->foreign('forwarder_id')->references('id')->on('forwarder')->onDelete('cascade');
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
        Schema::dropIfExists('transito_orden_compra');
    }
}
