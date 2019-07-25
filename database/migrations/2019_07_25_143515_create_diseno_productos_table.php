<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisenoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseno_producto_orden', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->integer('producto_id')->nullable();
            $table->boolean('logo')->nullable();
            $table->boolean('box')->nullable();
            $table->boolean('instructivo')->nullable();
            $table->string('archivo_fabricante')->nullable();
            $table->string('archivo_diseno')->nullable();
            $table->string('tipo')->nullable();
            $table->date('fecha_requerida')->nullable();
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
        Schema::dropIfExists('diseno_producto_orden');
    }
}
