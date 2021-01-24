<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderWiseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_wise_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('purchase_id');
            $table->integer('location_id')->nullable();
            $table->float('cost');
            $table->integer('quantity');
            $table->float('discount')->default(0);
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
        Schema::dropIfExists('purchase_order_wise_items');
    }
}
