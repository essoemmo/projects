<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSmsReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_reservations', function (Blueprint $table) {
            $table->string('general_name')->nullable()->after('store_id');
            $table->string('ad_name')->nullable()->after('general_name');
            $table->string('commercial_register_file')->nullable()->after('ad_name');
            $table->boolean('status')->default(0)->after('commercial_register_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_reservations', function (Blueprint $table) {
            $table->dropColumn('general_name');
            $table->dropColumn('ad_name');
            $table->dropColumn('commercial_register_file');
            $table->dropColumn('status');
        });
    }
}
