<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_closings', function (Blueprint $table) {
            $table->id();
            $table->integer('loc_code')->nullable();
            $table->integer('cashier_id')->nullable();
            $table->integer('f1000')->nullable();
            $table->integer('f500')->nullable();
            $table->integer('f200')->nullable();
            $table->integer('f100')->nullable();
            $table->integer('f50')->nullable();
            $table->integer('f20')->nullable();
            $table->integer('f10')->nullable();
            $table->integer('f5')->nullable();
            $table->integer('f1')->nullable();
            $table->float('f_50')->nullable();
            $table->float('f_25')->nullable();
            $table->integer('s1000')->nullable();
            $table->integer('s500')->nullable();
            $table->integer('s200')->nullable();
            $table->integer('s100')->nullable();
            $table->integer('s50')->nullable();
            $table->integer('s20')->nullable();
            $table->integer('s10')->nullable();
            $table->integer('s5')->nullable();
            $table->integer('s1')->nullable();
            $table->float('s_50')->nullable();
            $table->float('s_25')->nullable();
            $table->integer('credit_sale')->nullable();
            $table->integer('cash_to_credit')->nullable();
            $table->integer('total_punched')->nullable();
            $table->integer('credit_to_cash')->nullable();
            $table->integer('refund')->nullable();
            $table->integer('credit_settlement')->nullable();
            $table->integer('short_over')->nullable();
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
        Schema::dropIfExists('daily_closings');
    }
}
