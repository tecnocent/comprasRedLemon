<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasificacionAduanerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificacion_aduaneras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->nullable();
            $table->integer('clasificacion_arancelaria')->nullable();
            $table->unsignedInteger('orden_compra_id')->nullsble();
            $table->string('nom_1')->nullable();
            $table->string('nom_2')->nullable();
            $table->string('nom_3')->nullable();
            $table->string('nom_4')->nullable();
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
        Schema::dropIfExists('clasificacion_aduaneras');
    }
}
