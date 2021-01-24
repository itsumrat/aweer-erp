<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceUpdateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_update_histories', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reference')->nullable();
            $table->integer('store_id');
            $table->integer('item_id');
            $table->float('prev_cost');
            $table->float('prev_price');
            $table->float('prev_markup');
            $table->float('updated_price');
            $table->float('updated_markup');
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
        Schema::dropIfExists('price_update_histories');
    }
}
