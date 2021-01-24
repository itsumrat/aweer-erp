<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reference');
            $table->integer('status')->default(0)->comment('0 = pending, 1= sent');
            $table->integer('requisition_from');
            $table->integer('requisition_to');
            $table->integer('type')->comment('1 = vegetable, 2= DC, 3 = DSD');
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
        Schema::dropIfExists('requisitions');
    }
}
