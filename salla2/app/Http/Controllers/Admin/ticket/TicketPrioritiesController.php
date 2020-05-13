<?php

namespace App\Http\Controllers\Admin\ticket;

use App\DataTables\priorityDataTable;
use App\Http\Controllers\Controller;
use App\ticketPriorities;
use Illuminate\Http\Request;

class TicketPrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(priorityDataTable $priority)
    {
        return $priority->render('admin.ticket.priorities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.priorities.create');
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
            'name'=>'required|unique:ticket_priorities',
            'color'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }
        ticketPriorities::create($data);
        return redirect(url('adminpanel/ticketSetting/priority'))->with(session()->flash('flash_message',_i('success add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ticketPriorities  $ticketPriorities
     * @return \Illuminate\Http\Response
     */
    public function show(ticketPriorities $ticketPriorities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ticketPriorities  $ticketPriorities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priority = ticketPriorities::findOrFail($id);
        return view('admin.ticket.priorities.edit',compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ticketPriorities  $ticketPriorities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $priority = ticketPriorities::findOrFail($id);
        $data = $this->validate($request,[
            'name'=>'required',
            'color'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }
        if (ticketPriorities::where('name',$data['name'])->count() == 1 || ticketPriorities::where('name',$data['name'])->count() == null){
            $priority->update($data);
            return redirect(url('adminpanel/ticketSetting/priority'))->with(session()->flash('flash_message','success update'));
        }else{
            return redirect()->back()->with(session()->flash('flash_message',_i('The name has already been taken')));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ticketPriorities  $ticketPriorities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }
        $priority = ticketPriorities::findOrFail($id);
        $priority->delete();
        return redirect()->back()->with(session()->flash('flash_message',_i('success delete')));
    }
}
