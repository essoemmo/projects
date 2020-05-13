<?php

namespace App\Http\Controllers\Master\Sms;

use App\DataTables\SmsReservationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Settings\SmsReservation;

class SmsReservationController extends Controller
{
    public function index(SmsReservationDataTable $sms)
    {
        return $sms->render('master.sms.index');
    }

    public function show($id)
    {
        $sms = SmsReservation::findOrFail($id);
        return view('master.sms.show', compact('sms'));
    }

    public function approve($id)
    {
        $sms = SmsReservation::findOrFail($id);
        $sms->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', _i('Updated Successfully'));
    }
}
