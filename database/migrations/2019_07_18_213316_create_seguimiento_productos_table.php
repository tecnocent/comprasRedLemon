<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->integer('producto_id')->nullable();
            $table->string('foto_preproduccion')->nullable();
            $table->string('foto_produccion')->nullable();
            $table->string('foto_oem_uno')->nullable();
            $table->string('foto_oem_dos')->nullable();
            $table->string('foto_oem_tres')->nullable();
            $table->string('foto_empaquetado')->nullable();
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
        Schema::dropIfExists('seguimiento_productos');
    }
}
