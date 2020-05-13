<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->after('address');
            $table->unsignedInteger('country_id')->nullable()->after('user_id');
            $table->string('grade')->nullable()->after('country_id');
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
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('country_id');
            $table->dropColumn('grade');
//            $table->dropColumn('image');
        });
    }
}
