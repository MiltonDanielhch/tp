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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id(); 
            // ------------------ Datos del operador ------------------
            
            //tipo de afiliacion
            $table->string('affiliation_type');
            //nit
            $table->string('nit');
            //rubro
            $table->string('business');
            //telefono
            $table->string('phone');

            // ------------------ Persona Juridica ------------------
            //persona juridica
            $table->string('legal_name');
            //numero de registro
            $table->string('legal_number');
            //fecha
            $table->date('legal_date');
            // ------------------ Dominio Legal ------------------
            //provincia
            $table->string('province');
            //municipio
            $table->string('municipality');
            //direccion
            $table->string('address');

            // ------------------ Representante Legal ------------------
            //nombre del representante
            $table->string('representative_name')->nullable();
            // numero de ci
            $table->string('representative_ci')->nullable();
            // expedicion
            $table->string('representative_expedition')->nullable();
            //telefono
            $table->string('representative_phone')->nullable();
            //correo
            $table->string('representative_email')->nullable();
            // Nro poder
            $table->string('representative_power_number')->nullable();
            
            
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
        Schema::dropIfExists('organizations');
    }
};
