<?php


namespace App\Http\Controllers\Admin;


use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use App\Models\Admin\CourseComments;
use App\Models\Contact;
use App\Models\countries;
use App\User;
use Yajra\DataTables\DataTables;

class CourseCommentController extends Controller
{


    public function index()
    {
       return view('admin.hr.course.comment.course_comment');
    }

    public  function datatableCourseComment()
    {
        $query = CourseComments::query()->orderByDesc('id');

        return DataTables::of($query )
            ->editColumn('course_id', function($query) {
                $course = Course::select(['title'])->where('id', '=', $query->course_id)->first();
                return $course->title;
            })
            ->editColumn('approve', function($query) {
                if($query->approve == 1)
                    return _i('Approved');
                return _i('Not Approved');
            })
//            ->editColumn('email', function($query) {
//                $user = User::where('id', '=', $query->email)->first();
//                return '<a href=" "></a>';
//            })
            ->addColumn('action', function ($query) {
                return '<a href="' . $query->id . '/show" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Show").'"><i class="fa fa-eye"></i> </a>' . "&nbsp;" .
                    '<a href="' . $query->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>' . "&nbsp;";
            })
            ->make(true);
    }

    public function show($id)
    {
        $comment = CourseComments::findOrFail($id);
        $course = Course::where('id' , $comment->course_id)->first();
        return view('admin.hr.course.comment.show' ,compact('comment' , 'course'));
    }

    public function approve($id)
    {
        $comment = CourseComments::findOrFail($id);
        $comment->approve = 1;
        $comment->save();
        return redirect('/admin/course_comment/all')->withFlashMessage('Approved Successfully !');
    }


    public function delete($id)
    {
        $comment = CourseComments::findOrFail($id);
        $comment->delete();
        return redirect('/admin/course_comment/all')->withFlashMessage('Deleted Successfully !');
    }

}