<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\FeaturedAdUser;
use App\Models\Social_link;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    // search for social type
    public function socialSearch()
    {
        if(\request()->user_type == "normal") {
            $normal_members = User::where('users.user_type' , "normal")
                ->leftJoin('social_link_user','social_link_user.user_id','users.id')
                ->where('social_link_user.default' , 1)
                ->where('social_link_user.social_id' , request()->socialID)
                ->select('users.id as userId', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                ->orderBy('users.id' , "desc")->take(16)
                ->get();
            return view('front.social_search.normal' ,compact('normal_members'));
        }

        if(\request()->user_type == "famous") {
            $normal_members = User::where('users.user_type' , "famous")
                ->leftJoin('social_link_user','social_link_user.user_id','users.id')
                ->where('social_link_user.default' , 1)
                ->where('social_link_user.social_id' , request()->socialID)
                ->select('users.id as userId', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                ->orderBy('users.id' , "desc")->take(16)
                ->get();
            return view('front.social_search.normal' , compact('normal_members'));
        }
        if(\request()->user_type == "featured") {
            $featured_users = FeaturedAdUser::where('featured_type' ,"featured")
                ->where('social_link_id' , request()->socialID)
                ->where('publish' , 1)
                ->where( 'to' ,">=", NOW())
                ->orderBy('from' , "asc")->take(10)->get();
            //dd($featured_users);
            return view('front.social_search.featured' ,compact('featured_users'));
           // return view('front.social_search.normal' ,compact('normal_members'));
        }

    }


    public function search(Request $request)
    {

        $social_links = Social_link::LeftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
            ->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
            ->where('locale',App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->select('countries_translations.title as title' ,'countries.id as id')
            ->where('locale',App::getLocale())->get();

        if($request->gender && $request->country_id == null && $request->social_id == null) {
            $members = User::where('user_type' ,"!=" ,"admin")
                ->where('gender' , $request->gender)->orderBy('id' , "desc")->take(16)->get();
            return view('front.search' ,compact('members','social_links','countries'));
        }
        elseif($request->country_id && $request->gender == null &&$request->social_id == null ) {
            $members = User::where('user_type' ,"!=" ,"admin")
                ->where('country_id' , $request->country_id)->orderBy('id' , "desc")->take(16)->get();
            return view('front.search' ,compact('members','social_links','countries'));
        }
        elseif($request->social_id && $request->gender == null &&$request->country_id == null ) {
            $members = User::leftJoin('social_link_user','social_link_user.user_id','users.id')
                ->where('social_link_user.social_id' , $request->social_id)
                ->select('users.id as id', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                ->orderBy('users.id' , "desc")->take(16)
                ->get();

            return view('front.search' ,compact('members','social_links','countries'));
        }
        elseif( $request->gender && $request->country_id && $request->social_id ) {
            $members = User::leftJoin('social_link_user','social_link_user.user_id','users.id')
                ->where('users.gender' , $request->gender)
                ->where('users.country_id' , $request->country_id)
                ->where('social_link_user.social_id' , $request->social_id)
                ->select('users.id as id', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                ->orderBy('users.id' , "desc")->take(16)
                ->get();
            return view('front.search' ,compact('members','social_links','countries'));
        }
        elseif ($request->gender && ($request->country_id == null || $request->social_id == null)){
            if($request->social_id == null){
                $members = User::where('user_type' ,"!=" ,"admin")
                    ->where('gender' , $request->gender)->where('country_id' , $request->country_id)->orderBy('id' , "desc")->take(16)->get();
                return view('front.search' ,compact('members','social_links','countries'));
            }else{
                $members = User::leftJoin('social_link_user','social_link_user.user_id','users.id')
                    ->where('users.gender' , $request->gender)
                    ->where('social_link_user.social_id' , $request->social_id)
                    ->select('users.id as id', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                    ->orderBy('users.id' , "desc")->take(16)
                    ->get();
                return view('front.search' ,compact('members','social_links','countries'));
            }
        }
        elseif ($request->country_id && ($request->gender == null || $request->social_id == null)){
            if($request->social_id == null){
                $members = User::where('user_type' ,"!=" ,"admin")
                    ->where('country_id' , $request->country_id)->where('gender' , $request->gender)->orderBy('id' , "desc")->take(16)->get();
                return view('front.search' ,compact('members','social_links','countries'));
            }else{
                $members = User::leftJoin('social_link_user','social_link_user.user_id','users.id')
                    ->where('users.country_id' , $request->country_id)
                    ->where('social_link_user.social_id' , $request->social_id)
                    ->select('users.id as id', 'users.first_name as first_name' ,'users.last_name as last_name','users.image as image','users.job_type as job_type')
                    ->orderBy('users.id' , "desc")->take(16)
                    ->get();
                return view('front.search' ,compact('members','social_links','countries'));
            }
        }
        elseif($request->gender == null && $request->country_id == null && $request->social_id == null){
            return view('front.not-found',compact('social_links','countries'));
        }


    }

}
