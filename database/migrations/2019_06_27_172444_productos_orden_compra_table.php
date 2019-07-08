<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductosOrdenCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->integer('producto_id')->nullable();
            $table->integer('cantidad')->nullable();
            $table->float('costo')->nullable();
            $table->float('total')->nullable();
            $table->string('incoterm')->nullable();
            $table->integer('leadtime')->nullable();
            $table->boolean('logo')->nullable();
            $table->boolean('box')->nullable();
            $table->boolean('instructivo')->nullable();
            $table->json('archivos')->nullable()->nullable();
            $table->string('tipo')->nullable();
            $table->date('fecha_requerida')->nullable();
            $table->foreign('orden_compra_id')->references('id')->on('orden_compra')->onDelete('cascade');
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
        Schema::dropIfExists('productos_orden_compra');
    }
}
