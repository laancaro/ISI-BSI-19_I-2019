<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajador', function (Blueprint $table) {     
     $table->string('nombre',50); 
     $table->char('cedula',9)->primary();
     $table->string('provincia',50); 
     $table->string('canton',50); 
     $table->string('distrito',50); 
     $table->string('direccion'); 
     $table->integer('telefono'); 
     $table->integer('celular'); 
     $table->string('correo',255); 
     $table->string('ocupacion',50); 
     $table->tinyInteger('grado_academico'); 
     $table->date('fecha_nacimiento'); 
     $table->string('banco',200); 
     $table->string('num_cuenta_banco',25); 
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
        Schema::dropIfExists('trabajador');
    }
}
