<?php

namespace App\Http\Controllers\Admin\ticket;

use App\DataTables\completeTicketDataTable;
use App\DataTables\ticketDataTable;
use App\Http\Controllers\Controller;
use App\Store;
use App\ticket;
use App\ticketCategory;
use App\ticketComments;
use App\ticketPriorities;
use App\ticketStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ticketDataTable $ticket)
    {
        return $ticket->render('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Store::where('ticket_agent',1)->where('guard','store')->pluck('name','id');
        $category = ticketCategory::pluck('name','id');
        $priorities = ticketPriorities::pluck('name','id');
        return view('admin.ticket.create',compact('users','category','priorities'));
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
            'subject'=>'required',
            'contents'=>'required',
            'users'=>'required',
            'category'=>'required',
            'status'=>'required',
            'priorities'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }
        $ticket = new ticket();
        $ticket->subject = $request->subject;
        $ticket->content = $request->contents;
        $ticket->agent_id = $request->users;
        $ticket->status = $request->status;
        $ticket->category_id = $request->category;
        $ticket->priority_id = $request->priorities;
        $ticket->admin_id = auth()->guard('admin')->user()->id;
        $ticket->save();
        return redirect(url('adminpanel/ticket'))->with(session()->flash('flash_message', _i('success add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = ticket::findOrFail($id);
        $comments = ticketComments::where('ticket_id',$id)->get();
        $users = Store::where('guard','store')->where('ticket_agent',1)->pluck('name','id');
        $category = ticketCategory::pluck('name','id');
        $priorities = ticketPriorities::pluck('name','id');
        return view('admin.ticket.show',compact('ticket','users','comments','category','priorities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = ticket::findOrFail($id);
        $users = Store::where('guard','store')->where('ticket_agent',1)->pluck('name','id');
        $category = ticketCategory::pluck('name','id');
        $priorities = ticketPriorities::pluck('name','id');
        return view('admin.ticket.edit',compact('ticket','users','category','priorities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $ticket = ticket::findOrFail($id);
        $data = $this->validate($request,[
            'subject'=>'required',
            'contents'=>'required',
            'users'=>'required',
            'category'=>'required',
            'status'=>'required',
            'priorities'=>'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }
        $ticket->subject = $request->subject;
        $ticket->content = $request->contents;
        $ticket->agent_id = $request->users;
        $ticket->status = $request->status;
        $ticket->category_id = $request->category;
        $ticket->priority_id = $request->priorities;
        $ticket->save();
        return redirect(url('adminpanel/ticket'))->with(session()->flash('flash_message',_i('success update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $ticket = ticket::findOrFail($id);
        ticketComments::where('ticket_id',$id)->delete();
        $ticket->delete();
        return redirect(url('/adminpanel/ticket'))->with(session()->flash('flash_message',_i('success delete')));
    }
    public function completed(completeTicketDataTable $ticket)
    {
        return $ticket->render('admin.ticket.complete.index');
    }
    public function complatemark(Request $request)
    {
        if ($request->ajax()){
            if ($request->mark){
                ticket::where('id',$request->ticket)->update(['status'=>$request->mark]);
                if ($request->mark == 3){
                    return '3';
                }else{
                    return '1';
                }
//                return redirect('adminpanel/ticket')->with(session()->flash('flash_message','this is ticket is completed'));
            }
        }
    }
}
