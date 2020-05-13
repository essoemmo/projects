<?php


namespace App\Http\Controllers\Admin\Rating;


use App\Hr\Course\Co_category;
use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\product\product_details;
use App\Models\product\products;
use App\Models\rating\rating;
use App\Models\rating\userRating;
use App\User;
use Yajra\DataTables\DataTables;

class RatingController extends Controller
{

    public function datatableRating()
    {
        $query = userRating::all()->sortByDesc('id' );

        return DataTables::of($query)
            ->addColumn('rating', function($query) {
                if ($query->rating){
                    $rate = $query->rating *20;
                    return '<div class="star-ratings-css">
                      <div class="star-ratings-css-top" style="width: '.$rate.'%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                      <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>';
                }else{
                    return '<div class="star-ratings-css">
                      <div class="star-ratings-css-top" style="width: 0"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                      <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>';
                }
            })
            ->editColumn('approve', function($query) {
                if($query->approve == 1)
                    return _i('Approved');
                return _i('Not Approved');
            })
            ->addColumn('course', function($query) {
                $rating = rating::where('id' , $query->rating_id)->first();
                if($rating!=null)
                {
                $course = Course::where('id' , $rating->course_id)->first();
                return $course['title'];
                }
                return "";
            })
            ->addColumn('user_email', function($query) {
                $user = User::where('id' , $query->user_id)->first();
                return $user['email'];
            })
            ->editColumn('created_at', function($query) {
                $date = date("Y M d ", strtotime($query->created_at));
                return $date;
            })
            ->addColumn('action', 'admin.rating.btn.delete')
            ->addColumn('action', function ($query) {
                return '<a href="' . $query->id . '/show" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Show").'"><i class="fa fa-eye"></i> </a>' . "&nbsp;" .
                    '<a href="' . $query->id . '/delete/'.$query->user_id.'" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'">
                    <i class="fa fa-trash"></i> </a>' . "&nbsp;" ;
            })

            ->rawColumns([
                'rating',
                'approve',
                'course',
                'user_email',
                'created_at',
                'action',
            ])
            ->make(true);
    }

    public function allRating()
    {
        return view('admin.rating.all');
    }

    public function showRate($id)
    {
        $user_rate = userRating::findOrFail($id);
        $rating = rating::where('id' , $user_rate->rating_id)->first();
        $user = User::where('id' , $user_rate->user_id)->first();
        $course = Course::where('id' , $rating->course_id)->first();
        $rate_value = $user_rate->rating * 20;

        return view('admin.rating.show_rate' , compact('user' ,'course' ,'user_rate', 'rating','rate_value'));
    }

    public function approveRate($rate_id , $user_id)
    {
        $user_rate = userRating::where('id' , $rate_id)->where('user_id' , $user_id)->first();
        $user_rate->approve = 1;
        $user_rate->save();
        return redirect('admin/rating/all')->withFlashMessage(_i('Approved Successfully !'));
    }

    public function destroy($rate_id , $user_id)
    {
        $user_rate = userRating::where('id' , $rate_id)->where('user_id' , $user_id)->first();
        $user_rate->delete();

        return redirect('admin/rating/all')->withFlashMessage(_i('Deleted Successfully !'));
    }
}