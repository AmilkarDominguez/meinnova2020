<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('collector_id')->unsigned();
            $table->unsignedBigInteger('sale_id')->unsigned();
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->decimal('payment',8,2); // cantida cobrada
            $table->string('receipt_number');
            $table->date('entry_date'); // fecha de entrada en deposito
            $table->timestamps();
            //RELACTIONS
            $table->foreign('collector_id')->references('id')->on('collectors') //sale
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('sale_id')->references('id')->on('sales') //producto
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
