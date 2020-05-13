<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateApplicantCoursePendingsTable extends Migration {

	public function up()
	{
		Schema::create('applicant_course_pendings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('applicant_id')->unsigned();
			$table->decimal('cost', 8,2);
			$table->decimal('amount', 8,2);
			$table->integer('coupon_id')->unsigned();
			$table->boolean('is_paid');
			$table->timestamp('created');
			$table->string('transaction_id');
			$table->string('transaction_type', 10);
			$table->integer('nationality_id')->unsigned();
			$table->string('holder_name',70)->nullable(true);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('applicant_course_pendings');
	}
}