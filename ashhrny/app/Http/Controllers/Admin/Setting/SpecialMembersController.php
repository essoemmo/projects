<?php


namespace App\Http\Controllers\Admin\Setting;


use App\DataTables\SpecialMembersDatatable;
use App\Http\Controllers\Controller;
use App\Models\SpecialMembers;
use App\User;
use Illuminate\Http\Request;

class SpecialMembersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:SpecialMember-Add'])->only('index');
        $this->middleware(['permission:SpecialMember-Add'])->only('store');
        $this->middleware(['permission:SpecialMember-Edit'])->only('update');
        $this->middleware(['permission:SpecialMember-Delete'])->only('delete');
    }


    public function index(SpecialMembersDatatable $membersDataTable)
    {
        $users = User::where('user_type' ,"normal")->orWhere('user_type' ,"famous")->get();
        return $membersDataTable->render('admin.special_members.index' , compact('users'));
    }


    public function store(Request $request)
    {
        if($request->publish == null) {
            $request->publish = 0;
        }
        $special_member = SpecialMembers::create([ //image
            'user_id' => $request->user_id,
            'publish' => $request->publish,
        ]);
        if($request->sort == null){
            // if $request dont have sort
            $last_member = SpecialMembers::orderBy('sort', 'desc')->first(); // get last order value
            if(!$last_member) {
                $sort = 1;
            }else{
                $sort = $last_member['sort'] + 1;}
            $special_member->sort = $sort;
            $special_member->save();
        }else{
            // if request have sort
            $sort_found = SpecialMembers::where('sort' ,$request['sort'])->first(); // check if request->sort found or not
            $last_member = SpecialMembers::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $special_member->sort = $request['sort'];
                $special_member->save();
            }else{ // if sort found
                $sort_found->sort = $last_member->sort + 1;
                $sort_found->save();
                $special_member->sort = $request->sort;
                $special_member->save();
            }
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $special_member = SpecialMembers::findOrFail($id);

        if($request->publish == null) {
            $request->publish = 0;
        }
        $special_member->update([
            'user_id'=>$request->user_id,
            'publish'=>$request->publish,
        ]);

        /// if request dont have sort get last sort and save slider else (if sort value found save to slider & alternate between found slider else save request value )
        if($request->sort != null)
        {
            // if request have sort
            $sort_found = SpecialMembers::where('sort' ,$request['sort'])->where('id' ,"!=" , $id)->first(); // check if request->sort found or not
            $last_member = SpecialMembers::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $special_member->sort = $request['sort'];
                $special_member->save();
            }else{ // if sort found
                $sort_found->sort = $special_member->sort;
                $sort_found->save();
                $special_member->sort = $request->sort;
                $special_member->save();
            }
        }
        return response()->json(true);
    }



    public function change($id) {
        $special_member = SpecialMembers::findOrFail($id);
        if($special_member->publish == 0) {
            $special_member->publish = 1;
            $special_member->update();
        } elseif($special_member->publish == 1) {
            $special_member->publish = 0;
            $special_member->update();
        }
    }

    public function sort($id ,Request $request)
    {
        $special_member = SpecialMembers::findOrFail($id);
        $old_sort = $special_member->sort;
        // sort to high
        if($request->row_sort_hightId){ //
            if($old_sort != 1){
                $new_sort = $special_member['sort'] - 1 ;
                $replace_member = SpecialMembers::where('sort' , $new_sort)->first();
                if($replace_member){
                    $replace_member->sort = $old_sort;
                    $replace_member->save();
                }
                $special_member->sort = $new_sort;
                $special_member->save();
                return response()->json(true);
            }
        }
        if($request->row_sort_bottomId){
            // sort to high
            $new_sort = $special_member['sort'] + 1 ;
            $replace_member = SpecialMembers::where('sort' , $new_sort)->first();
            if($replace_member){
                $replace_member->sort = $old_sort;
                $replace_member->save();
            }
            $special_member->sort = $new_sort;
            $special_member->save();
            return response()->json(true);
        }
    }

    public function destroy($id)
    {
        $special_member = SpecialMembers::findOrFail($id);
        $special_member->delete();
        return redirect(aurl('spcial_members'))->with('success',_i('success delete'));
    }


}