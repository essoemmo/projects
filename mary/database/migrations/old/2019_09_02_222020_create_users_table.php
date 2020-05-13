<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('fullname')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->enum('tages',['featured','show_in_feature_list','not_display_status'])->nullable();
            $table->string('email')->unique();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('DOB')->default('date');
            $table->string('guard')->default('web');
            $table->string('photo')->nullable();
            $table->text('about_me')->nullable();
            $table->text('partener_info')->nullable();
            $table->integer('userlog')->default(1);


            $table->bigInteger('nationalty_id')->unsigned()->nullable();
            $table->foreign('nationalty_id')->references('id')->on('nationalties');

            $table->bigInteger('resident_country_id')->unsigned()->nullable();
            $table->foreign('resident_country_id')->references('id')->on('nationalies_data');


            $table->bigInteger('material_status_id')->unsigned()->nullable();
            $table->foreign('material_status_id')->references('id')->on('material_status');

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
