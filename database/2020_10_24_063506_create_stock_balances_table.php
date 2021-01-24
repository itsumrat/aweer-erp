<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_balances', function (Blueprint $table) {
            //$table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('location_id')->nullable();
            $table->boolean('op_type')->nullable()->unsigned(false)->default(null)->comment('1=in, 2=out');
            $table->bigInteger('balance_quantity')->default(0);
            $table->timestamps();
            $table->primary(['item_id','location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_balances');
    }
}
