<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\storesDataTable;
use App\Http\Controllers\Controller;
use App\membership;
use App\Models\Language;
use App\Models\product\stores;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(storesDataTable $store)
    {
        return $store->render('admin.stores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $memberships = membership::pluck('title','id');
        $users = Store::where('guard','store')->pluck('name','id');
        $substore = stores::pluck('title','id');
        return view('admin.stores.create',compact('memberships','users','substore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'title' => 'required',
            'domain' => 'required|unique:stores',
            'owner_id' => 'required',
            'membership_id' => 'required',
        ]);
        $numberrand = rand(11111,99999);
        $imageName = time().$numberrand.'.'.$request->image->getClientOriginalExtension();
        stores::create([
            'title' => $request->title,
            'domain' => $request->domain,
            'image' => '/uploads/stores/'. $imageName,
            'owner_id' => $request->owner_id,
            'membership_id' => $request->membership_id,
            'lang_id' => $request->lang_id,
        ]);
        return redirect(url('/adminpanel/store'))->with('flash_message' , _i('Added Successfully !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $languages = Language::pluck('title','id');
        $memberships = membership::pluck('title','id');
        $users = Store::where('guard','store')->pluck('name','id');
        $substore = stores::pluck('title','id');
        $store = stores::findOrFail($id);
        return view('admin.stores.edit',compact('languages','memberships','users','substore','store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = stores::findOrfail($id);
        $data = $this->validate($request,[
            'title' => 'required',
            'domain' => 'required|unique:stores,domain, '. $this->store['id'],
            'owner_id' => 'required',
            'membership_id' => 'required',
            'lang_id' => 'required',
            'source_id' => 'sometimes',
        ]);
        $store->update($data);
        return redirect()->back()->with(session()->flash('flash_message','تم التعديل بنجاح'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = stores::findOrFail($id);
        if ($store->products != null){
            return redirect()->back()->with(session()->flash(_i('This store cannot be deleted because it contains products')));
        }else{
            $store->delete();
            return redirect(url('adminpanel/stores'))->with(session()->flash('message',_i('Deletion was successful')));
        }
    }
}
