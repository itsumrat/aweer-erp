<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('company');
            $table->string('vat_no');
            $table->string('email');
            $table->string('name');
            $table->string('city');
            $table->string('phone');
            $table->string('country');
            $table->integer('payment_term');
            $table->float('discount')->default(0)->nullable();
            $table->string('address')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
