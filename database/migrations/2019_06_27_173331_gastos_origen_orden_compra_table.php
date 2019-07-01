<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GastosOrigenOrdenCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_origen_orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->unsignedInteger('tipo_gasto_id')->nullable();
            $table->float('costo')->nullable();
            $table->string('notas')->nullable();
            $table->json('comprobante')->nullable();
            $table->foreign('orden_compra_id')->references('id')->on('orden_compra');
            $table->foreign('tipo_gasto_id')->references('id')->on('cost_origin');
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
        Schema::dropIfExists('gasto_origen_orden_compra');
    }
}
