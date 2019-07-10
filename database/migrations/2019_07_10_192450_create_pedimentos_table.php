<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedimento')->nullable();
            $table->unsignedInteger('orden_compra_id')->nullable();
            $table->string('pedimento_digital')->nullable();
            $table->unsignedInteger('aduana_id')->nullable();
            $table->unsignedInteger('agente_aduanal_id')->nullable();
            $table->integer('tipo_cambio_pedimento')->nullable();
            $table->integer('dta')->nullable();
            $table->integer('cnt')->nullable();
            $table->integer('igi')->nullable();
            $table->integer('prv')->nullable();
            $table->integer('iva')->nullable();
            $table->foreign('orden_compra_id')->references('id')->on('orden_compra')->onDelete('cascade');
            $table->foreign('aduana_id')->references('id')->on('aduana')->onDelete('cascade');
            $table->foreign('agente_aduanal_id')->references('id')->on('agente_aduanal')->onDelete('cascade');
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
        Schema::dropIfExists('pedimentos');
    }
}
