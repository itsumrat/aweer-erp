<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLpoReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lpo_receives', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->string('shelf_life')->nullable();
            $table->string('exipre_date')->nullable();
            $table->string('reference_no');
            $table->string('vendor_invoice_no')->nullable();
            $table->boolean('is_paid')->default(false)->comment('false for unpaid, true for paid');
            $table->integer('user_id');
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
        Schema::dropIfExists('lpo_receives');
    }
}
