<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_overs', function (Blueprint $table) {
            $table->id();
            $table->integer('loc_code')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('audit_by')->nullable();
            $table->date('audit_date')->nullable();
            $table->integer('pcash_fund')->nullable();
            $table->integer('no_of_pos')->nullable();
            $table->integer('float_amount')->nullable();
            $table->integer('total_expense')->nullable();
            $table->integer('f1000')->nullable();
            $table->integer('f500')->nullable();
            $table->integer('f200')->nullable();
            $table->integer('f100')->nullable();
            $table->integer('f50')->nullable();
            $table->integer('f20')->nullable();
            $table->integer('f10')->nullable();
            $table->integer('f5')->nullable();
            $table->integer('f1')->nullable();
            $table->integer('f_50')->nullable();
            $table->integer('f_25')->nullable();
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
        Schema::dropIfExists('hand_overs');
    }
}
