<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date'); // fecha de registro
            $table->decimal('total',8,2); // total
            $table->unsignedBigInteger('client_id')->unsigned(); //cliente
            $table->unsignedBigInteger('user_id')->unsigned()->nullable(); //usuario
            $table->unsignedBigInteger('seller_id')->unsigned(); //vendedor
            $table->unsignedBigInteger('payment_status_id')->unsigned()->nullable(); // estado de pago

            //DISCOUNTS
            $table->decimal('discount',8,2)->nullable();; // descuento
            $table->date('expiration_discount')->nullable();// fecha de espiración del descuento
            $table->decimal('total_discount',8,2)->nullable();; // descuento
            $table->decimal('receive',8,2)->nullable();; // descuento
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->timestamps();

            //RELACTIONS

            $table->foreign('client_id')->references('id')->on('clients') //cliente
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('seller_id')->references('id')->on('sellers') //vendedor
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('payment_status_id')->references('id')->on('catalogues')// estado de pago catalogos
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
        Schema::dropIfExists('sales');
    }
}
