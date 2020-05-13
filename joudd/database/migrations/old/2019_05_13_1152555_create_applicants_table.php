<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateApplicantsTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('applicants');
		Schema::create('applicants', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('education_level')->unsigned()->nullable();
			$table->string('personal_id',20)->unique()->nullable();
			$table->string('address', 200)->nullable(true);
			$table->date('dob')->nullable(true);
			$table->boolean('gender')->nullable(true);
			$table->tinyInteger('website')->default(0)->nullable(false);
			$table->timestamps();

            $table->foreign('education_level')->references('id')->on('education_levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('applicants');
	}
}
