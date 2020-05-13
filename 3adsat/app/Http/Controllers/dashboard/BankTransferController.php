<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\BankTransferDataTable;
use App\Models\bank_transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BankTransferController extends Controller {

    public $lang = "en_US";
    public $language_id;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankTransferDataTable $bank) {
        return $bank->render('admin.bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'holder_name' => 'required',
            'iban' => 'required',
            'holder_number' => 'required',
            'logo' => 'sometimes',
        ]);
        $numberrand = rand(11111, 99999);
        $data = [
            'title' => $request->title,
            'holder_name' => $request->holder_name,
            'iban' => $request->iban,
            'holder_number' => $request->holder_number,
            
            'lang_id' => 1
        ];
        if (isset($request->logo)) {
            $imageName = time() . $numberrand . '.' . $request->logo->getClientOriginalExtension();
            $data['logo'] = '/uploads/bank/' . $imageName;
            $request->logo->move(public_path('uploads/bank'), $imageName);
        }
        bank_transfer::create($data);

        return back()->with('flash_message', _i('success create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $bank = bank_transfer::findOrFail($id);
        return view('admin.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $bank = bank_transfer::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'holder_name' => 'required',
            'iban' => 'required',
            'holder_number' => 'required',
            'logo' => 'sometimes',
        ]);
        $exists = bank_transfer::where('id', $id)->where('logo', '!=', null)->exists();
        if ($exists && $request->logo != null) {
            $image = bank_transfer::where('id', $id)->where('logo', '!=', null)->first();
            $image_path = $image->logo;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $numberrand = rand(11111, 99999);
            $imageName = time() . $numberrand . '.' . $request->logo->getClientOriginalExtension();
            $bank->update([
                'title' => $request->title,
                'holder_name' => $request->holder_name,
                'iban' => $request->iban,
                'holder_number' => $request->holder_number,
                'logo' => '/uploads/bank/' . $imageName,
            ]);
            $request->logo->move(public_path('uploads/bank'), $imageName);
        }
        $bank->update([
            'title' => $request->title,
            'holder_name' => $request->holder_name,
            'iban' => $request->iban,
            'holder_number' => $request->holder_number,
        ]);
        return back()->with('flash_message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $bank = bank_transfer::findOrFail($id);
        $exists = bank_transfer::where('id', $id)->where('logo', '!=', null)->exists();
        if ($exists) {
            $image = bank_transfer::where('id', $id)->where('logo', '!=', null)->first();
            $image_path = $image->logo;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
        }
        $bank->delete();
        return back()->with('flash_message', 'success delete');
    }

}
