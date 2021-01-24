<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcashTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcash_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('pcash_curr_balance')->nullable();
            $table->date('date')->nullable();
            $table->integer('loc_code')->nullable();
            $table->integer('exp_amount')->nullable();
            $table->string('particulars')->nullable();
            $table->integer('exp_by')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pcash_transactions');
    }
}
