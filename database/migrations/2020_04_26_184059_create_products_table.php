<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('barcode');
            $table->string('evaluation');
            $table->string('dept_wise_category');
            $table->text('generic_description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('delivery_mode');
            $table->integer('department_id');
            $table->integer('category_id');
            $table->integer('unit_id');
            $table->integer('alert_quantity')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(1);
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
        Schema::dropIfExists('products');
    }
}
