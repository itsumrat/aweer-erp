<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('location_id')->nullable();
            $table->boolean('op_type')->nullable()->unsigned(false)->default(null)->comment('1=in, 2=out');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('user_id')->nullable();
            $table->integer('e_p')->nullable()->unsigned(false)->default(null)->comment('end_point');
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
        Schema::dropIfExists('stocks');
    }
}
