<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PriorityDataTable;
use App\Models\Priority;
use App\Models\PriorityTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriorityController extends Controller
{
    public function index(PriorityDataTable $priorityDataTable) {
        $langs = SiteLanguage::all();
        return $priorityDataTable->render('admin.priority.index', compact('langs'));
    }

    public function store(Request $request) {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $priority = Priority::create();

        $langs = SiteLanguage::all();
        foreach ($langs as $lang) {
            $priorityTranslation = new PriorityTranslation();
            $priorityTranslation->title = $request->get($lang->locale.'_title');
            $priorityTranslation->locale = $lang->locale;
            $priority->translations()->save($priorityTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id) {
        if ($request->ajax()) {
            $priority =  Priority::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($priority->translate($lang->locale)){
                    $priorityTranslation = PriorityTranslation::where('locale',$lang->locale)->where('priority_id', $priority->id)->first();
                }else{
                    $priorityTranslation = new PriorityTranslation();
                }
                $priorityTranslation->title = $request->get($lang->locale.'_title');
                $priorityTranslation->locale = $lang->locale;
                $priority->translations()->save($priorityTranslation);
            }
            return response()->json(true);
        }
    }

    public function destroy($id) {
        $priority = Priority::findOrFail($id);
        $priorityTranslation = PriorityTranslation::where('priority_id' , $priority->id)->delete();
        return redirect(aurl('openTicket'))->with('success',_i('success delete'));
    }
}
