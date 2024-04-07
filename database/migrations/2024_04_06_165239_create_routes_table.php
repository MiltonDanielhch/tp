<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            // ------------------ Datos de las rutas del Beni ------------------
            //Origen del municipio 
            $table->unsignedBigInteger('origin_id');
            //Destino del municipio
            $table->unsignedBigInteger('destination_id');
            //Resolucion de parada
            //$table->string('shudown_resolution');

            $table->foreign('origin_id')->references('id')->on('locations');
            $table->foreign('destination_id')->references('id')->on('locations');

            // ------------------ Control database ------------------
            //activo
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('routes');
    }
};
