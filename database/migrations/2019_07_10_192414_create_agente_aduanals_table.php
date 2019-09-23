<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenteAduanalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agente_aduanal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('aduana_id')->nullable();
            $table->string('nombre');
            $table->string('apelldos');
            $table->foreign('aduana_id')->references('id')->on('aduana')->onDelete('cascade');
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
        Schema::dropIfExists('agente_aduanal');
    }
}
