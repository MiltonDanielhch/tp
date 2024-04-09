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
        Schema::create('drives', function (Blueprint $table) {
            $table->id();
           // nombre completo
           $table->string('full_name');
           // foto
           $table->string('photo')->nullable();
           // telefono
           $table->string('phone');
           // ci
           $table->string('ci')->unique();
           // expedicion ci
           $table->string('expedition_ci');
           // categoria
           $table->string('category');
           // nro de licencia
           $table->string('license_number')->unique();
           // fecha de vencimiento
           $table->date('expiration_date');
           // activo
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
        Schema::dropIfExists('drives');
    }
};
