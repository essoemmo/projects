<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('phone');
            $table->unsignedInteger('ticket_id')->nullable()->after('subject');
            $table->unsignedInteger('priority_id')->nullable()->after('ticket_id');

            $table->foreign('ticket_id')->references('id')->on('open_ticket')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('priority_id')->references('id')->on('priorities')
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('ticket_id');
            $table->dropColumn('priority_id');
        });
    }
}
