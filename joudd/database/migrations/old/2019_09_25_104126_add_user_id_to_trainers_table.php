<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->text('address')->nullable();
            $table->text('department')->nullable();
            $table->text('degree')->nullable();
//            $table->string('image')->nullable()->after('address');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('country_id')->references('id')->on('countries')
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
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('country_id');
            $table->dropColumn('address');
            $table->dropColumn('department');
            $table->dropColumn('degree');
//            $table->dropColumn('image');
        });
    }
}
