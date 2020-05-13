<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DescountCodesTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('discount_codes');
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default('No Name');
            $table->string('code',100);
            $table->boolean('is_active')->default(false);
            $table->float('discount')->default(0.00);
            $table->date('created');
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
        //
        Schema::dropIfExists('discount_codes');
    }
}
