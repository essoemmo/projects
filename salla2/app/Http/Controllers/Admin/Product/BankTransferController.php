<?php

namespace App\Http\Controllers\Admin\product;

use App\DataTables\BankTransferDataTable;
use App\Models\product\bank_transfer;
use App\Models\product\product_photos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Nexmo\Numbers\Number;

class BankTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankTransferDataTable $bank)
    {
        return $bank->render('admin.bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = session('StoreId');
        $this->validate($request,[
            'title' => 'required',
            'holder_name' => 'required',
            'iban' => 'required',
            'holder_number' => 'required',
            'logo' => 'sometimes',
        ]);

        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        $numberrand = rand(11111,99999);
        $imageName = time().$numberrand.'.'.$request->logo->getClientOriginalExtension();
        bank_transfer::create([
            'title' => $request->title,
            'holder_name' => $request->holder_name,
            'iban' => $request->iban,
            'holder_number' => $request->holder_number,
            'logo' => '/uploads/bank/'. $imageName,
            'store_id' => $store,
            'lang_id' => getLang(session('adminlang')),
        ]);
        $request->logo->move(public_path('uploads/bank'), $imageName);
        return back()->with('flash_message',_i('success create'));
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
        $bank = bank_transfer::findOrFail($id);
        return view('admin.bank.edit',compact('bank'));
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
        $bank = bank_transfer::findOrFail($id);
        $store = session('StoreId');
        $this->validate($request,[
            'title' => 'required',
            'holder_name' => 'required',
            'iban' => 'required',
            'holder_number' => 'required',
            'logo' => 'sometimes',
        ]);

        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }

        $exists = bank_transfer::where('id',$id)->where('logo','!=',null)->exists();
        if ($exists && $request->logo != null) {
            $image = bank_transfer::where('id',$id)->where('logo','!=',null)->first();
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
                'logo' => '/uploads/bank/'. $imageName,
                'store_id' => $store,
            ]);
            $request->logo->move(public_path('uploads/bank'), $imageName);
        }
        $bank->update([
            'title' => $request->title,
            'holder_name' => $request->holder_name,
            'iban' => $request->iban,
            'holder_number' => $request->holder_number,
            'store_id' => $store,
        ]);
        return back()->with('flash_message', _i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $bank = bank_transfer::findOrFail($id);
        $exists = bank_transfer::where('id',$id)->where('logo','!=',null)->exists();
        if ($exists) {
            $image = bank_transfer::where('id', $id)->where('logo', '!=', null)->first();
            $image_path = $image->logo;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
        }
        $bank->delete();
        return back()->with('flash_message', _i('success delete'));
    }
}
