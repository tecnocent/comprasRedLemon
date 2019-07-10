<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoMontoOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_monto_orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->float('pago')->nullable();
            $table->float('tipo_cambio_pago')->nullable();
            $table->string('comrpobante')->nullable();
            $table->unsignedInteger('monto_pago_id')->nullable();
            $table->foreign('monto_pago_id')->references('id')->on('monto_pago_orden_compra')->onDelete('cascade');
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
        Schema::dropIfExists('pago_monto_orden_compra');
    }
}
