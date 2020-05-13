<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantCourseTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('applicant_course');
		Schema::create('applicant_course', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('course_id')->nullable(true);
			$table->unsignedInteger('applicant_id')->nullable(true);
			$table->float('cost')->default(0.00);
			$table->float('amount')->default(0.00);
			$table->unsignedInteger('coupon_id')->nullable(true);
			$table->boolean('is_paid')->default(false);
			$table->date('created')->nullable(true);
			$table->string('transaction_id', 50)->nullable(true);
			$table->string('transaction_type',20)->nullable(true);
			$table->string('holder_name',70)->nullable(true);
			$table->timestamps();

			
		});
		
	}

	public function down()
	{
		Schema::drop('applicant_course');
	}
}