<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSettingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_translations', function (Blueprint $table) {
            $table->string('total_title')->after('address');
            $table->text('warning_description')->after('total_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings_translations', function (Blueprint $table) {
            $table->dropColumn('total_title');
            $table->dropColumn('warning_description');
        });
    }
}
