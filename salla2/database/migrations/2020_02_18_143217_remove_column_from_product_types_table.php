<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnFromProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_types', function (Blueprint $table) {
            if(Schema::hasColumn('product_types','title')){
                $table->dropColumn('title');
            }
            if(Schema::hasColumn('product_types','description')){
                $table->dropColumn('description');
            }
            if(Schema::hasColumn('product_types','lang_id')){
                $table->dropColumn('lang_id');
            }
            if(Schema::hasColumn('product_types','source_id')){
                $table->dropColumn('source_id');
            }

            $table->unsignedInteger('type_code')->nullable();
            $table->foreign('type_code')->references('id')->on('product_types_code')
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
        Schema::table('product_types', function (Blueprint $table) {
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
        });
    }
}
