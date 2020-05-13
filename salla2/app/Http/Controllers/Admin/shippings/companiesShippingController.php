<?php

namespace App\Http\Controllers\Admin\shippings;

use App\DataTables\companiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Shipping\shippingCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class companiesShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(companiesDataTable $companies)
    {
//        dd(session('StoreId'),auth()->user()->hasRole( \App\Help\Utility::Store));
        return $companies->render('admin.shipping.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['store_id' => session('StoreId')]);
        $data = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'logo' => 'sometimes',
            'store_id' => 'sometimes',
        ]);
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }
        if ($request->has('logo')) {
            $logo = $request->logo;
            $numberrand = rand(11111, 99999);
            $randname = time() . $numberrand;
            $imageName = $randname . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/shippingCompany'), $imageName);
            shippingCompanies::create(['title' => $request->title, 'description' => $request->description, 'logo' => 'uploads/shippingCompany/' . $imageName, 'store_id' => session('StoreId')]);
        } else {
            shippingCompanies::create($data);
        }
        return redirect()->back()->with('flash_message', _i('success add'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shippingCompanies = shippingCompanies::findOrFail($id);
        $sessionStore = session()->get('StoreId');
        $data = $this->validate($request, [
            'title' => ['required', Rule::unique('shipping_companies', 'id')->where(function ($q) use ($sessionStore) {
                return $q->where('store_id', $sessionStore);
            }),
            ],
            'description' => 'sometimes',
            'logo' => 'sometimes',
        ]);

        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Updated Successfully'));
        }

        if ($request->has('logo')) {
            $image_path = $shippingCompanies->logo;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $logo = $request->logo;
            $numberrand = rand(11111, 99999);
            $randname = time() . $numberrand;
            $imageName = $randname . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/shippingCompany'), $imageName);
            $shippingCompanies->update(['title' => $request->title, 'description' => $request->description, 'logo' => 'uploads/shippingCompany/' . $imageName]);
        } else {
            $shippingCompanies->update($data);
        }
        return redirect()->back()->with('flash_message', _i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Deleted Successfully'));
        }
        $shippingCompanies = shippingCompanies::findOrFail($id);
        $image_path = $shippingCompanies->logo;  // Value is not URL but directory file path
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $shippingCompanies->delete();
        return redirect()->back()->with('flash_message',_i('success delete'));
    }
}
