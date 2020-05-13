<?php

namespace App\Http\Controllers\admin;

use App\DataTables\NotifyTemplateDataTable;
use App\Models\NotifyTemplate;
use App\Models\NotifyTemplateData;
use App\Models\NotifyTemplateDataTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifySetupController extends Controller
{
    public function index(NotifyTemplateDataTable $notifyTemplateDataTable) {
        return $notifyTemplateDataTable->render('admin.notify_setup.index');
    }

    public function edit(Request $request,$id){
        $notifyTemplate = NotifyTemplate::findOrFail($id);
        $notifyTemplateData = NotifyTemplateData::where('notify_template_id', $notifyTemplate->id)->first();
        $langs = SiteLanguage::all();
        return view('admin.notify_setup.edit', compact('notifyTemplate', 'langs','notifyTemplateData'));
    }

    public function update(Request $request, $id) {
        $notifyTemplate = NotifyTemplate::findOrFail($id);
        $data = $this->validate(    $request,[
            '*_subject' => 'required',
            '*_body' => 'required',
        ]);
        $langs = SiteLanguage::all();
        $notifyTemplateData = NotifyTemplateData::where('notify_template_id', $notifyTemplate->id)->first();
        $notifyTemplateData->notify_template_id = $notifyTemplate->id;
        $notifyTemplateData->update();

        foreach ($langs as $lang){
            if ($notifyTemplateData->translate($lang->locale)){
                $notify_template_trans = NotifyTemplateDataTranslation::where('locale',$lang->locale)->where('notify_data_id',$notifyTemplateData->id)->first();
            }else{
                $notify_template_trans = new NotifyTemplateDataTranslation();
            }
            $notify_template_trans->subject = $request->get($lang->locale.'_subject');
            $notify_template_trans->body = $request->get($lang->locale.'_body');
            $notify_template_trans->locale = $lang->locale;
            $notifyTemplateData->translations()->save($notify_template_trans);
        }

        return redirect()->back()->with('success' , _i('Updated Successfully !'));
    }
}
