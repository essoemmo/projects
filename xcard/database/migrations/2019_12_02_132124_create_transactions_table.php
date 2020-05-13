<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->enum('status',['pending','paid','refused'])->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->string('bank_transactions_num')->nullable();
            $table->double('total')->nullable();
            $table->string('image')->nullable();
            $table->string('currency')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('holder_card_number')->nullable();
            $table->string('holder_cvc')->nullable();
            $table->string('holder_expire')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('bank_id')->references('id')->on('banks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
