<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdenesCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('guia')->nullable();
            $table->float('total')->nullable();
            $table->float('pagado')->nullable();
            $table->string('metodo_envio')->nullable();
            $table->string('identificador')->nullable();
            $table->string('encargdo_interno')->nullable();
            $table->unsignedInteger('proveedor_id')->nullable();
            $table->integer('almacen_id')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('tipo_compra')->nullable();
            $table->string('requerimiento')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('providers');
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
        Schema::dropIfExists('orden_compra');
    }
}
