<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotional_products', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reference')->nullable();
            $table->text('store_ids');
            $table->integer('item_id');
            $table->string('promotion_start');
            $table->string('promotion_end');
            $table->float('promotion_price');

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
        Schema::dropIfExists('promotional_products');
    }
}
