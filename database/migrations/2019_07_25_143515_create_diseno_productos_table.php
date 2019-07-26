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
            $table->boolean('oem')->nullable();
            $table->boolean('empaque')->nullable();
            $table->boolean('instructivo')->nullable();
            $table->date('fecha_aviso_diseño')->nullable();
            $table->string('producto_diseno')->nullable();
            $table->string('empaque_diseno')->nullable();
            $table->string('instructivo_diseno')->nullable();
            $table->string('oem_autorizado_trafico')->nullable();
            $table->date('fecha_autorizacion_trafico')->nullable();
            $table->json('archivos_fabricante')->nullable();
            $table->json('archivos_diseno')->nullable();
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
