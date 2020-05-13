<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCountriesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries_data', function (Blueprint $table) {
            $table->integer('source_id')->unsigned()->nullable()->after('lang_id');
            $table->foreign('source_id')->references('id')->on('countries_data')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('lang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries_data', function (Blueprint $table) {
            $table->dropColumn('source_id');
        });
    }
}
