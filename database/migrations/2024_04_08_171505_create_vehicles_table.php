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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
           // ------------------ Datos de los vehiculos ------------------
            //foto
            $table->string('photo');
            //clase de vehiculo 
            $table->string('class');
            //socios que pueden usar los vehiculos
            $table->unsignedBigInteger('associate_id');
            $table->foreign('associate_id')->references('id')->on('associates');
            //ruat
            $table->string('ruat');
            //marca
            $table->string('brand');
            //motor
            $table->string('motor');
            //año del vehiculo
            $table->string('year');
            //numero de chasis
            $table->string('number_chassis')->unique();
            //numero de placas
            $table->string('number_plate')->unique();
            //crpva
            $table->string('crpva');
            //soat
            $table->string('soat');
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
        Schema::dropIfExists('vehicles');
    }
};
