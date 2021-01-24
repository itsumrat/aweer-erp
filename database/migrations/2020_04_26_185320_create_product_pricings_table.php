<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_pricings', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->float('final_cost')->nullable()->default(0);
            $table->float('avg_cost')->nullable()->default(0);
            $table->float('last_grn_cost')->nullable()->default(0);
            $table->float('markup')->nullable()->default(0);
            $table->float('final_price')->nullable()->default(0);
            $table->float('price_without_tax')->nullable()->default(0);
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
        Schema::dropIfExists('product_pricings');
    }
}
