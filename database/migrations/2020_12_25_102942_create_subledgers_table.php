<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubledgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('ledger_id')->nullable();
            $table->integer('main_ac_id')->nullable();
            $table->integer('ac_category_id')->nullable();
            $table->integer('report_type_id')->nullable();
            $table->integer('posting_type')->nullable();
            $table->string('subledger_code')->nullable();
            $table->string('subledger_head')->nullable();
            $table->bigInteger('op_balance')->nullable();
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
        Schema::dropIfExists('subledgers');
    }
}
