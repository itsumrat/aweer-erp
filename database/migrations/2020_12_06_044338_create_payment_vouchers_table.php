<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->date('pvch_date')->nullable();
            $table->string('reference')->nullable();
            $table->string('vendor_code')->nullable();
            $table->string('total_invoice')->nullable();
            $table->string('total_location')->nullable();
            $table->string('total_debit')->nullable();
            $table->string('total_credit')->nullable();
            $table->integer('net_amount')->nullable();
            $table->integer('payment_amount')->nullable();
            $table->string('check_no')->nullable();
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
        Schema::dropIfExists('payment_vouchers');
    }
}
