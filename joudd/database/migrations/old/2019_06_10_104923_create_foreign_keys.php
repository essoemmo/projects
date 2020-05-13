<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

    public function up() {
       
//            Schema::table('employee_relative', function (Blueprint $table) {
//                $table->foreign('employee_id')->references('id')->on('employees')
//                        ->onDelete('cascade')
//                        ->onUpdate('cascade');
//            });
//
//        Schema::table('volunteers', function (Blueprint $table) {
//            $table->foreign('volunteer_category_id')->references('id')->on('volunteer_categories')
//                    ->onDelete('cascade')
//                    ->onUpdate('cascade');
//        });
//        Schema::table('course_trainer', function (Blueprint $table) {
//            $table->foreign('course_id')->references('id')->on('courses')
//                    ->onDelete('cascade')
//                    ->onUpdate('cascade');
//        });
//        Schema::table('course_trainer', function (Blueprint $table) {
//            $table->foreign('trainer_id')->references('id')->on('trainers')
//                    ->onDelete('cascade')
//                    ->onUpdate('cascade');
//        });

        Schema::table('co_category_course', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('co_category_course', function (Blueprint $table) {
            $table->foreign('co_category_id')->references('id')->on('co_categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('applicant_course', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->foreign('coupon_id')->references('id')->on('discount_codes');
        });

//        Schema::table('job_details', function (Blueprint $table) {
//            $table->foreign('job_id')->references('id')->on('jobs');
//        });
//        Schema::table('jobs', function (Blueprint $table) {
//
//            $table->foreign('type_id')->references('id')->on('job_types');
//            $table->foreign('depart_id')->references('id')->on('job_departmenets');
//        });
//        Schema::table('dontations', function (Blueprint $table) {
//            $table->foreign('donor_id')->references('id')->on('donors');
//            $table->foreign('type_id')->references('id')->on('donor_types');
//        });
//        Schema::table('comm_operations', function (Blueprint $table) {
//            $table->foreign('comm_id')->references('id')->on('communications');
//        });
//        Schema::table('vacancys', function (Blueprint $table) {
//            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
//            ;
//            $table->foreign('type_id')->references('id')->on('vacation_types')->onDelete('cascade');
//            ;
//        });
        Schema::table('applicant_results', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            ;
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            ;
        });

		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicants')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('courses')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('questions')
				->onDelete('cascade')
				->onUpdate('cascade');
		});


        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->foreign('applicant_id')->references('id')->on('applicants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('discount_codes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->foreign('nationality_id')->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


//        Schema::table('program_volunteer', function(Blueprint $table) {
//            $table->foreign('volunteer_id')->references('id')->on('volunteers')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//        });
//        Schema::table('program_volunteer', function(Blueprint $table) {
//            $table->foreign('program_id')->references('id')->on('programs')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//        });

	}

	public function down()
	{
//		Schema::table('employee_relative', function (Blueprint $table) {
//			$table->dropForeign('employee_relative_employee_id_foreign');
//		});
//		Schema::table('employee_relative', function (Blueprint $table) {
//			$table->dropForeign('employee_relative_relative_id_foreign');
//		});
//		Schema::table('volunteers', function (Blueprint $table) {
//			$table->dropForeign('volunteers_volunteer_category_id_foreign');
//		});
//		Schema::table('course_trainer', function (Blueprint $table) {
//			$table->dropForeign('course_trainer_course_id_foreign');
//		});
//		Schema::table('course_trainer', function (Blueprint $table) {
//			$table->dropForeign('course_trainer_trainer_id_foreign');
//		});

		Schema::table('co_category_course', function (Blueprint $table) {
			$table->dropForeign('co_category_course_course_id_foreign');
		});
		Schema::table('co_category_course', function (Blueprint $table) {
			$table->dropForeign('co_category_course_co_category_id_foreign');
		});
		Schema::table('applicant_course', function (Blueprint $table) {
			$table->dropForeign('applicant_course_course_id_foreign');
		});
		Schema::table('applicant_course', function (Blueprint $table) {
			$table->dropForeign('applicant_course_applicant_id_foreign');
		});

		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->dropForeign('course_evaluations_applicant_id_foreign');
		});
		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->dropForeign('course_evaluations_course_id_foreign');
		});
		Schema::table('course_evaluations', function(Blueprint $table) {
			$table->dropForeign('course_evaluations_question_id_foreign');
		});


        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->dropForeign('applicant_course_pendings_course_id_foreign');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->dropForeign('applicant_course_pendings_applicant_id_foreign');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->dropForeign('applicant_course_pendings_coupon_id_foreign');
        });
        Schema::table('applicant_course_pendings', function(Blueprint $table) {
            $table->dropForeign('applicant_course_pendings_nationality_id_foreign');
        });


//        Schema::table('benficary_membership', function(Blueprint $table) {
//            $table->dropForeign('benficary_membership_benficary_id_foreign');
//        });
//        Schema::table('benficary_membership', function(Blueprint $table) {
//            $table->dropForeign('benficary_membership_membership_id_foreign');
//        });
//
//        Schema::table('program_volunteer', function(Blueprint $table) {
//            $table->dropForeign('program_volunteer_volunteer_id_foreign');
//        });
//        Schema::table('program_volunteer', function(Blueprint $table) {
//            $table->dropForeign('program_volunteer_program_id_foreign');
//        });

	}
}
