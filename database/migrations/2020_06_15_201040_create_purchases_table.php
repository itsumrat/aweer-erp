<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('requisition_date');
            $table->string('vendor_confirm_date');
            $table->string('shipping_date');
            $table->string('reference');
            $table->integer('location_id');
            $table->integer('status')->default(0)->comment('0 = draft, 1= final');
            $table->string('document_file');
            $table->boolean('is_foc')->default(false);
            $table->integer('vendor_id');
            $table->float('discount')->default(0)->nullable();
            $table->float('tax')->default(0)->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
