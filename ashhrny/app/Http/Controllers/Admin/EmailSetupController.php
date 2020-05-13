<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EmailTemplateDataTable;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateData;
use App\Models\EmailTemplateDataTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailSetupController extends Controller
{

    public function index(EmailTemplateDataTable $emailTemplateDataTable) {
        return $emailTemplateDataTable->render('admin.email_setup.index');
    }

    public function edit(Request $request,$id){
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplateData = EmailTemplateData::where('email_template_id', $emailTemplate->id)->first();
        $langs = SiteLanguage::all();
        return view('admin.email_setup.edit', compact('emailTemplate', 'langs','emailTemplateData'));
    }

    public function update(Request $request, $id) {
        $emailTemplate = EmailTemplate::findOrFail($id);
        $data = $this->validate(    $request,[
            '*_subject' => 'required',
            '*_body' => 'required',
            'from_email' => 'required',
        ]);
        $langs = SiteLanguage::all();
        $emailTemplateData = EmailTemplateData::where('email_template_id', $emailTemplate->id)->first();
        $emailTemplateData->from_email = $request->from_email;
        $emailTemplateData->email_template_id = $emailTemplate->id;
        $emailTemplateData->update();

        foreach ($langs as $lang){
            if ($emailTemplateData->translate($lang->locale)){
                $email_template_trans = EmailTemplateDataTranslation::where('locale',$lang->locale)->where('email_template_data_id',$emailTemplateData->id)->first();
            }else{
                $email_template_trans = new EmailTemplateDataTranslation();
            }
            $email_template_trans->subject = $request->get($lang->locale.'_subject');
            $email_template_trans->body = $request->get($lang->locale.'_body');
            $email_template_trans->locale = $lang->locale;
            $emailTemplateData->translations()->save($email_template_trans);
        }

        return redirect()->back()->with('success' , _i('Updated Successfully !'));
    }
}
