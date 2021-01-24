<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_receives', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->string('transfer_id');
            $table->string('shop_code');
            $table->string('item_code');
            $table->float('unit_cost');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->integer('status')->default(0)->nullable();
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
        Schema::dropIfExists('trn_receives');
    }
}
