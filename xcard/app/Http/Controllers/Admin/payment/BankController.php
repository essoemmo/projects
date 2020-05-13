<?php

namespace App\Http\Controllers\Admin\payment;

use App\DataTables\BankDataTable;
use App\Models\Bank;
use App\Models\BankTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Payment-Add'])->only('index');
        $this->middleware(['permission:Payment-Add'])->only('store');
        $this->middleware(['permission:Payment-Edit'])->only('update');
        $this->middleware(['permission:Payment-Delete'])->only('delete');
    }

    public function index(BankDataTable $bank)
    {
        $langs = SiteLanguage::all();
        return $bank->render('admin.bank.index', compact('langs'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
            'code' => 'required',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $bank = Bank::create([
            'code' => $request->code,
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/banks/' . $bank->id), $filename);
            $bank->image = '/uploads/banks/' . $bank->id . '/' . $filename;
            $bank->save();
        }
        $langs = SiteLanguage::all();
        foreach ($langs as $lang) {
            $bankTranslation = BankTranslation::create([
                'title' => $request->get($lang->locale . '_title'),
                'locale' => $lang->locale,
            ]);
            $bank->translations()->save($bankTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $bank = Bank::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
                'code' => ['required'],
            ];
            $validator = validator()->make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            if ($request->hasFile('image')) {
                $image_path = $bank->image;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/banks/' . $bank->id), $filename);
                $bank->image = '/uploads/banks/' . $bank->id . '/' . $filename;
                $bank->save();
            }

            $langs = SiteLanguage::all();
            foreach ($langs as $lang) {
                if ($bank->translate($lang->locale)) {
                    $bankTranslation = BankTranslation::where('locale', $lang->locale)->where('bank_id', $bank->id)->first();
                } else {
                    $bankTranslation = new BankTranslation();
                }
                $bankTranslation->title = $request->get($lang->locale . '_title');
                $bankTranslation->locale = $lang->locale;
                $bank->translations()->save($bankTranslation);
            }
            return response()->json(true);
        }
    }

    public function destroy($id)
    {
        $bank =  Bank::findOrFail($id);
        $image_path = $bank->image;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $bankTraslation = BankTranslation::where('bank_id', $bank->id)->delete();
        $bank->delete();
        return redirect(aUrl('banks'))->with('success',_i('success delete'));
    }
}
