<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->dateTime('fecha');
			$table->char('moneda',3);
			$table->decimal('tipo_cambio',8,2);
			$table->integer('cliente');
			$table->integer('producto1');
			$table->integer('producto2');
			$table->integer('producto3');
			$table->decimal('subtotal',10,2);
			$table->decimal('descuento',10,2);
			$table->decimal('impuestos',10,2);
			$table->decimal('total',10,2);
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
        Schema::dropIfExists('factura');
    }
}
