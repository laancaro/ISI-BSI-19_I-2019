<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentoTable extends Migration
{
    public function up()
    {
        Schema::create('medicamento', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nombre',100);
            $table->string('descripcion',250);
            $table->bigInteger('casa_farmaceutica');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicamento');
    }
}
