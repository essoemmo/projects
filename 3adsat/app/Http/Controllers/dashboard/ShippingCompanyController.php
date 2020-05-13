<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\ShippingCompanyDataTable;
use App\Models\shippingCompanies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ShippingCompanyController extends Controller
{
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
    public function index(ShippingCompanyDataTable $companyDataTable)
    {
        return $companyDataTable->render('admin.shipping_company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping_company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'title' => 'required|unique:shipping_companies',
            'description' => 'required',
            'logo' => 'sometimes',
        ]);
        if ($request->has('logo')) {
            $logo = $request->logo;
            $numberrand = rand(11111, 99999);
            $randname = time() . $numberrand;
            $imageName = $randname . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/shippingCompany'), $imageName);
            shippingCompanies::create(['title'=>$request->title,'description'=>$request->description,'logo'=>'uploads/shippingCompany/'.$imageName , 'lang_id' => 1]);
        }else{
            shippingCompanies::create([ 'title' => $request->title ,'description'=>$request->description,'logo'=>$request->logo,'lang_id'=>1]);
        }
        return redirect()->back()->with('flash_message','success add');
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
        $company = shippingCompanies::findOrFail($id);
        return view('admin.shipping_company.edit',compact('company'));
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
        $data = $this->validate($request,[
            'title' => 'required|'.Rule::unique('shipping_companies')->ignore($id),
            'description' => 'required',
            'logo' => 'sometimes',
        ]);
        $shippingCompanies = shippingCompanies::findOrFail($id);
        if ($request->has('logo')){
            $image_path = $shippingCompanies->logo;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $logo = $request->logo;
            $numberrand = rand(11111, 99999);
            $randname = time() . $numberrand;
            $imageName = $randname . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/shippingCompany'), $imageName);
            $shippingCompanies->update(['title'=>$request->title,'description'=>$request->description,'logo'=>'uploads/shippingCompany/'.$imageName]);
        }else{
            $shippingCompanies->update($data);
        }
        return redirect()->back()->with('flash_message','success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shippingCompanies = shippingCompanies::findOrFail($id);
        $image_path = $shippingCompanies->logo;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $shippingCompanies->delete();
        return redirect()->back()->with('flash_message','success delete');
    }
}
