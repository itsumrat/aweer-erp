<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repackings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('barcode');
            $table->string('evalucation');
            $table->text('generic_description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('delivery_mode');
            $table->integer('department_id');
            $table->integer('category_id');
            $table->integer('unit_id');
            $table->integer('alert_quantity');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('product_id');
            $table->float('additional_cost')->nullable();
            $table->float('price');
            $table->text('note')->nullable();
            $table->integer('user_id');
            $table->integer('location_id')->nullable();
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
        Schema::dropIfExists('repackings');
    }
}
