<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaintenanceToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->tinyInteger('maintenance')->default(0)->after('store_id');
        });

        Schema::table('settings_data', function (Blueprint $table) {
            $table->string('maintenance_title')->nullable();
            $table->text('maintenance_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('maintenance');
        });

        Schema::table('settings_data', function (Blueprint $table) {
            $table->dropColumn('maintenance_title');
            $table->dropColumn('maintenance_message');
        });
    }
}
