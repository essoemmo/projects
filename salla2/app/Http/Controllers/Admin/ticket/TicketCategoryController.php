<?php

namespace App\Http\Controllers\Admin\ticket;

use App\DataTables\categoryDataTable;
use App\Http\Controllers\Controller;
use App\ticketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(categoryDataTable $category)
    {
        return $category->render('admin.ticket.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.categories.create');
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
            'name'=>'required|unique:ticket_categories',
            'color'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        ticketCategory::create($data);
        return redirect(url('adminpanel/ticketSetting/category'))->with(session()->flash('flash_message',_i('success add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ticketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ticketCategory $ticketCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ticketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ticketCategory::findOrFail($id);
        return view('admin.ticket.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ticketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = ticketCategory::findOrFail($id);
        $data = $this->validate($request,[
            'name'=>'required',
            'color'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }
        if (ticketCategory::where('name',$data['name'])->count() == 1 || ticketCategory::where('name',$data['name'])->count() == null){
            $category->update($data);
            return redirect(url('adminpanel/ticketSetting/category'))->with(session()->flash('flash_message', _i('success update')));
        }else{
            return redirect()->back()->with(session()->flash('flash_message', _i('The name has already been taken')));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ticketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }
        $category = ticketCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with(session()->flash('flash_message',_i('success delete')));
    }
}
