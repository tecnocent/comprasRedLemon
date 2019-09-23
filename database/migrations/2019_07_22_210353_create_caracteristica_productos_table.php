<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristica_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->nullable();
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->string('especificaciones_producto')->nullable();
            $table->string('especificaciones_electricas')->nullable();
            $table->string('link_amazon')->nullable();
            $table->string('link_alibaba')->nullable();
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
        Schema::dropIfExists('caracteristica_productos');
    }
}
