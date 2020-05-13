<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\DataTables\commentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\rating\userRating;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(commentsDataTable $comments)
    {
        return $comments->render('admin.settings.comments.index');
    }
    public function approved($id)
    {
        /*$userRating = userRating::findOrFail($id);
        if ($userRating->approve == 0){
            $userRating->update(['approve'=>1]);
            $userscount = userRating::where('id',$id)->where('approve',1)->count();
            $RatingUsers = userRating::where('id',$id)->where('approve',1)->sum('rating') * 20;
            if ($userscount > 0){
                $userRating->rate->update(['rating'=> ($RatingUsers / $userscount)]);
            }
        }elseif($userRating->approve == 1){
            $userRating->update(['approve'=>0]);
            $userscount = userRating::where('id',$id)->where('approve',1)->count();
            $RatingUsers = userRating::where('id',$id)->where('approve',1)->sum('rating') * 20;
            if ($userscount > 0){
                $userRating->rate->update(['rating'=> ($RatingUsers / $userscount)]);
            }else{
                $userRating->rate->update(['rating'=> $RatingUsers]);
            }
        }*/

        $comment = Comment::findOrFail($id);
        $comment->published ^= 1;
        $comment->update();

        return back()->with('flash-message',_i('success update'));
    }
    public function delete($id)
    {
        //$userRating = userRating::findOrFail($id);
        //$userRating->delete();

        Comment::whereId($id)->delete();

        return back()->with('flash-message',_i('success delete'));
    }

    public function reply(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if($comment->reply == null){
        $request->merge(['user_id' => auth()->user()->id, 'store_id' => $comment->store_id, 'products_id' => $comment->products_id, 'comment_id' => $id, 'published' => 1]);

        Comment::create($request->all());
        }else{
         Comment::whereCommentId($id)->update(['comment' => $request->comment]);   
        }

        return back()->with('flash-message',_i('success reply'));

    }
}
