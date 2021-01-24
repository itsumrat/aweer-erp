<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnPaidGrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_paid_grns', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('reference')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('vendor_invoice')->nullable();
            $table->integer('total_due')->nullable();
            $table->date('payment_date')->nullable();
            $table->boolean('is_paid')->nullable();
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
        Schema::dropIfExists('un_paid_grns');
    }
}
