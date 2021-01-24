<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAdvancedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_advanceds', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('description')->nullable();
            $table->float('amount', 10,2)->nullable();
            $table->integer('paid_by')->nullable();
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
        Schema::dropIfExists('payment_advanceds');
    }
}
