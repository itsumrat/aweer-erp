<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reference');
            $table->string('code')->unique();
            $table->string('barcode')->unique();
            $table->string('name');
            $table->integer('unit_id')->nullable();
            $table->string('price')->nullable();
            $table->text('store_ids');
            $table->integer('buy_product_id');
            $table->integer('buy_quantity');
            $table->integer('get_product_id');
            $table->integer('get_quantity');
            $table->text('note')->nullable();
            $table->integer('user_id');
            
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
        Schema::dropIfExists('offers');
    }
}
