<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_returns', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reference');
            $table->integer('transfer_from');
            $table->integer('transfer_to');
            $table->integer('status')->default(0)->comment('1 = Draft, 2= Sent');
            $table->string('document_file')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('transfer_returns');
    }
}
