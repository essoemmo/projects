<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnToDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_codes', function (Blueprint $table) {
            if(Schema::hasColumn('discount_codes','type')){
                $table->dropColumn('type');
                //$table->enum('type' , ["perc","fixed","item"])->change();
            }

           // $table->enum('type' , ["perc","fixed","item"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_codes', function (Blueprint $table) {
            $table->boolean('type')->default(0);
        });
    }
}
