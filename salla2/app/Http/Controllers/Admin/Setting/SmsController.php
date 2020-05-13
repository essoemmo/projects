<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Settings\SmsReservation;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SmsController extends Controller
{
    public function index()
    {
        $store_id = \App\Bll\Utility::getStoreId();
        $smsReservation = SmsReservation::where('store_id', $store_id)->first();
        return view('admin.settings.sms.index', compact('store_id', 'smsReservation'));
    }

    public function generateDocs(Request $request)
    {
        $store_id = \App\Bll\Utility::getStoreId();
        $rules = [
            'sender_name' => ['required', 'min:3', 'max:11'],
            'sender_ad_name' => ['required', 'min:3', 'max:11'],
            'company_name' => ['required'],
            'commercial_register' => ['required'],
            'store_owner_name' => ['required'],
            'store_title' => ['required'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $this->generalName($request, $store_id);
            $this->adName($request, $store_id);

            return response()->json(['status' => true]);

        }
    }

    private function generalName($SmsReservation, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('uploads/sms/smsGeneralName.docx');

        $phpWord->setValue('date', date('d-m-Y', strtotime(Carbon::now())));
        $phpWord->setValue('company', $SmsReservation->company_name);
        $phpWord->setValue('commercial_register', $SmsReservation->commercial_register);
        $phpWord->setValue('store_owner', $SmsReservation->store_owner_name);
        $phpWord->setValue('store_title', $SmsReservation->store_title);
        $phpWord->setValue('store_email', $store->user->email);
        $phpWord->setValue('store_name', $store->title);
        $phpWord->setValue('sender_name', $SmsReservation->sender_name);

        $this->checkFolder($store_id);

        $phpWord->saveAs('uploads/sms/' . $store_id . '/smsGeneralName.docx');
        return $phpWord;
    }

    private function adName($SmsReservation, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('uploads/sms/smsAdName.docx');

        $phpWord->setValue('date', date('d-m-Y', strtotime(Carbon::now())));
        $phpWord->setValue('company', $SmsReservation->company_name);
        $phpWord->setValue('sender_ad', $SmsReservation->sender_ad_name);
        $phpWord->setValue('commercial_register', $SmsReservation->commercial_register);
        $phpWord->setValue('store_owner', $SmsReservation->store_owner_name);
        $phpWord->setValue('store_title', $SmsReservation->store_title);
        $phpWord->setValue('store_email', $store->user->email);
        $phpWord->setValue('store_name', $store->title);
        $phpWord->setValue('sender_name', $SmsReservation->sender_name);

        $this->checkFolder($store_id);

        $phpWord->saveAs('uploads/sms/' . $store_id . '/smsAdName.docx');
        return $phpWord;
    }

    private function checkFolder($store_id)
    {
        $file_path = 'uploads/sms/' . $store_id;
        if (File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }
        if (!is_dir(public_path('uploads/sms/' . $store_id))) {
            mkdir(public_path('uploads/sms/' . $store_id), 755, true);
        }
    }

    public function store(Request $request)
    {

        $store_id = \App\Bll\Utility::getStoreId();
        $rules = [
            'adName' => ['required'],
            'generalName' => ['required'],
            'commercialRegisterFile' => ['required'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $SmsReservation = SmsReservation::create([
                'sender_name' => $request->sender_name,
                'sender_ad_name' => $request->sender_ad_name,
                'company_name' => $request->company_name,
                'commercial_register' => $request->commercial_register,
                'store_owner_name' => $request->store_owner_name,
                'store_title' => $request->store_title,
                'store_id' => $store_id,
            ]);

//        dd($request->file('adName'), $request->all());

            if ($request->hasFile('adName')) {
                $adNameFile = $request->file('adName');
                $adName = $adNameFile->getClientOriginalName();
                $request->adName->move(public_path('uploads/sms/' . $store_id . '/uploads/'), $adName);
                $SmsReservation->ad_name = '/uploads/sms/' . $store_id . '/uploads/' . $adName;
                $SmsReservation->save();
            }


            if ($request->hasFile('generalName')) {
                $generalNameFile = $request->file('generalName');
                $generalName = $generalNameFile->getClientOriginalName();
                $request->generalName->move(public_path('uploads/sms/' . $store_id . '/uploads/'), $generalName);
                $SmsReservation->general_name = '/uploads/sms/' . $store_id . '/uploads/' . $generalName;
                $SmsReservation->save();
            }

            if ($request->hasFile('commercialRegisterFile')) {
                $commercialRegisterFileFile = $request->file('commercialRegisterFile');
                $commercialRegisterFile = $commercialRegisterFileFile->getClientOriginalName();
                $request->commercialRegisterFile->move(public_path('uploads/sms/' . $store_id . '/uploads/'), $commercialRegisterFile);
                $SmsReservation->commercial_register_file = '/uploads/sms/' . $store_id . '/uploads/' . $commercialRegisterFile;
                $SmsReservation->save();
            }

            return redirect()->route('admin.setting')->with('success', _i('Added Successfully'));
        }
    }
}
