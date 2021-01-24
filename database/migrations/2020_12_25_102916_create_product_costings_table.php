<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_costings', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('purchase_cost')->nullable();
            $table->integer('cost_with_tax')->nullable();
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
        Schema::dropIfExists('product_costings');
    }
}
