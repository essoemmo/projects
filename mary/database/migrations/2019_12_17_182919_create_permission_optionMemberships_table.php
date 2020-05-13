<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionOptionMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_optionMemberships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permision_id')->unsigned();
            $table->integer('membership_option_id')->unsigned();
            $table->foreign('membership_option_id')->references('id')->on('membership_options')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('permission_optionMemberships');
    }
}
