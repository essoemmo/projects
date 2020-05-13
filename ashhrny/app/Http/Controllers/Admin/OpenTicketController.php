<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OpenTicketDataTable;
use App\Models\OpenTicket;
use App\Models\OpenTicketTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpenTicketController extends Controller
{
    public function index(OpenTicketDataTable $openTicketDataTable) {
        $langs = SiteLanguage::all();
        return $openTicketDataTable->render('admin.openTicket.index', compact('langs'));
    }

    public function store(Request $request) {
        $rules = [
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $openTicket = OpenTicket::create();

        $langs = SiteLanguage::all();
        foreach ($langs as $lang) {
            $openTicketTranslation = new OpenTicketTranslation();
            $openTicketTranslation->title = $request->get($lang->locale.'_title');
            $openTicketTranslation->description = $request->get($lang->locale.'_description');
            $openTicketTranslation->locale = $lang->locale;
            $openTicket->translations()->save($openTicketTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id) {
        if ($request->ajax()) {
            $openTicket =  OpenTicket::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
                '*_description' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($openTicket->translate($lang->locale)){
                    $openTicketTranslation = OpenTicketTranslation::where('locale',$lang->locale)->where('open_ticket_id', $openTicket->id)->first();
                }else{
                    $openTicketTranslation = new OpenTicketTranslation();
                }
                $openTicketTranslation->title = $request->get($lang->locale.'_title');
                $openTicketTranslation->description = $request->get($lang->locale.'_description');
                $openTicketTranslation->locale = $lang->locale;
                $openTicket->translations()->save($openTicketTranslation);
            }
            return response()->json(true);
        }
    }

    public function destroy($id) {
        $openTicket = OpenTicket::findOrFail($id);
        $openTicketTranslation = OpenTicketTranslation::where('open_ticket_id' , $openTicket->id)->delete();
        return redirect(aurl('openTicket'))->with('success',_i('success delete'));
    }
}
