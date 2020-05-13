<?php

namespace App\Http\Controllers\Admin\ticket;

use App\DataTables\agentDataTable;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(agentDataTable $agent)
    {
        return $agent->render('admin.ticket.agents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Store::where('guard','store')->pluck('name','id');
        return view('admin.ticket.agents.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();

        $users = [];
        foreach ($requests as $r){
            $users[] = $r['id'];
        }
        $usersnochecked = Store::where('guard','store')->whereIn('id',$users)->get();
        $userschecked = Store::where('guard','store')->whereNotIn('id',$users)->get();
        foreach ($usersnochecked as $user){
            $user->ticket_agent = 1;
            $user->save();
        }
        foreach ($userschecked as $user){
            $user->ticket_agent = 0;
            $user->save();
        }
        return response()->json('done');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function paginate()
    {
        $users = Store::where('guard','store')->paginate(10);
        return response()->json($users);
    }
    public function checked()
    {
        $users = Store::where('guard','store')->where('ticket_agent','=',1)->get();
        return response()->json($users);
    }
}
