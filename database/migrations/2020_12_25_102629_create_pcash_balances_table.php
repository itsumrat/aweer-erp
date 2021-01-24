<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcashBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcash_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('loc_code')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('float_money')->nullable();
            $table->integer('special_fund')->nullable();
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
        Schema::dropIfExists('pcash_balances');
    }
}
