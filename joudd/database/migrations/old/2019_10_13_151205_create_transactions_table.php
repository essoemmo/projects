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
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();  // (transaction_types table if online)
            $table->enum('status',['pending','paid','refused'])->nullable();
            $table->unsignedInteger('bank_id')->nullable();  //(bank_transfers table if offline)
            $table->string('transaction_no')->nullable();
            $table->float('total')->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->string('discount_code' ,20)->nullable();
            $table->string('holder_name')->nullable();
            $table->string('holder_card_number')->nullable();
            $table->string('holder_cvc')->nullable();
            $table->dateTime('holder_expire')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_id')->references('id')->on('transaction_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('bank_id')->references('id')->on('bank_transfers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
