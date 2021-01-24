<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_calculations', function (Blueprint $table) {
            $table->id();
            $table->string('zone');
            $table->integer('item_id');
            $table->integer('store_id');
            $table->integer('stock')->nullable();
            $table->integer('counted_stock');
            $table->integer('user_id');
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('stock_calculations');
    }
}
