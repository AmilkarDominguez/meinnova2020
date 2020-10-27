<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sale_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_product');// nombre del producto
            $table->integer('amount')->nullable();// cantidad
            $table->decimal('subtotal',8,2); // subtotal
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->timestamps();
            $table->unsignedBigInteger('sale_id')->unsigned();
            $table->unsignedBigInteger('batch_id')->unsigned();
            //RELACTIONS

            $table->foreign('sale_id')->references('id')->on('sales') //sale
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('batch_id')->references('id')->on('batches') //producto
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
        Schema::dropIfExists('detail_sale_products');
    }
}
