<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('catalog_zone_id')->unsigned(); // FOREING KEY ZONE
            $table->unsignedBigInteger('user_id')->unsigned()->nullable(); // FOREING KEY ZONE
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->mediumText('contact')->nullable();
            $table->string('phone')->nullable();
            $table->mediumText('address')->nullable();
            $table->enum('state', ['ACTIVO', 'INACTIVO', 'ELIMINADO'])->default('ACTIVO');
            $table->timestamps();
            //RELACTIONS
            $table->foreign('catalog_zone_id')->references('id')->on('catalogues')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('providers');
    }
}
