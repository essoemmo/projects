<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('courses');
		Schema::create('courses', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
			$table->boolean('in_company')->default(0);
			$table->date('start_date');
			$table->date('end_date');
            $table->string('duration', 150);
            $table->string('img')->nullable();
            $table->string('video')->nullable();
            $table->decimal('cost', 8,2);
            $table->boolean('is_active');
            $table->unsignedInteger('lang_id')->nullable();
            $table->unsignedInteger('source_id')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('courses');
	}
}
