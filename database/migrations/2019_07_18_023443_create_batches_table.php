<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->unsigned(); // producto
            $table->unsignedBigInteger('user_id')->unsigned(); // ususario
            $table->unsignedBigInteger('provider_id')->unsigned();// proveedor
            // foreing keys catalogue
            $table->unsignedBigInteger('line_id')->unsigned(); //linea
            $table->unsignedBigInteger('storage_id')->unsigned();//almacen
            $table->unsignedBigInteger('industry_id')->unsigned()->nullable();// industria
            $table->unsignedBigInteger('payment_status_id')->unsigned()->nullable(); // estado de pago
            $table->unsignedBigInteger('payment_type_id')->unsigned()->nullable();// tipo de pago

            $table->string('code');// codigo de lote
            $table->string('sanitary_registration');// codigo
            $table->mediumText('description')->nullable();// descripción
            $table->integer('initial_stock'); // stock inicial
            $table->integer('stock'); // stock 
            $table->decimal('batch_price',8,2); // precio del lote 
            $table->decimal('wholesaler_price',8,2); // precio para mayoristas
            $table->date('entry_date'); // fecha de entrada en deposito
            $table->date('expiration_date');// fecha de espiración del lote
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO'); // estado
            $table->timestamps();
            //RELACTIONS

            $table->foreign('product_id')->references('id')->on('products') //producto
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')//usuario
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('provider_id')->references('id')->on('providers')// proveedor
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('line_id')->references('id')->on('catalogues')// linea de catalogos
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('storage_id')->references('id')->on('catalogues')//almacen de catalogos
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('industry_id')->references('id')->on('catalogues')//industria catalogos
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('payment_status_id')->references('id')->on('catalogues')// estado de pago catalogos
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('payment_type_id')->references('id')->on('catalogues')// tipo de pago catalogos
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
        Schema::dropIfExists('batches');
    }
}
