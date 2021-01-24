<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeleCardSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tele_card_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('dc_id')->nullable();
            $table->integer('e15')->nullable();
            $table->integer('e30')->nullable();
            $table->integer('e55')->nullable();
            $table->integer('e110')->nullable();
            $table->integer('f15')->nullable();
            $table->integer('f20')->nullable();
            $table->integer('f30')->nullable();
            $table->integer('f50')->nullable();
            $table->integer('du25')->nullable();
            $table->integer('du55')->nullable();
            $table->integer('du110')->nullable();
            $table->integer('h15')->nullable();
            $table->integer('h30')->nullable();
            $table->integer('h50')->nullable();
            $table->integer('emb50')->nullable();
            $table->integer('dmb50')->nullable();
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
        Schema::dropIfExists('tele_card_sales');
    }
}
