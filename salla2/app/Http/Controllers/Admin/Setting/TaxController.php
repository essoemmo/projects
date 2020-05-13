<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\countries;
use App\Models\Settings\Setting;
use App\Tax;
use Yajra\DataTables\Facades\DataTables;

class TaxController extends Controller
{

    public function index()
    {
        $setting = \App\Models\Settings\Setting::where("store_id",  session('StoreId'))->first();
        $countries = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title')
            ->where('countries_data.source_id', null)
            ->get();

            $taxs = Tax::leftJoin('countries_data','countries_data.country_id','tax.country_id')
            ->select('tax.*','countries_data.title')
            ->where('countries_data.source_id', null)
            ->where("tax.store_id",  session('StoreId'))->get()
            ;

        return view('admin.settings.tax.index', compact('countries','setting','taxs'));
    }



    public function storeTax(Request $request)
    {
      //  dd($request->all());
        if ($request->ajax()) {

            $rules = [
                'tax' => 'required|max:3',
                'country_id' => 'required',
            ];

            $validator = validator()->make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $taxs= Tax::create([
                'tax' => $request->tax,
                'country_id' => $request->country_id,
                'store_id' => session('StoreId'),
            ]);
            }
        return response()->json(['status' => 'success']);
        }
    }


    public function storeTaxNumb(Request $request,$id)
    {
       // dd($request->session('StoreId'));
      $setting = \App\Models\Settings\Setting::where("id", $id)->where("store_id",  session('StoreId'))->first();
      $countries = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title')
            ->where('countries_data.source_id', null)
            ->get();
      $rules = [
                'taxnumb' => 'required|max:191'
            ];

            $validator = validator()->make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {

                    $setting->taxnumb = $request->taxnumb;
                    $setting->save();
            }
            return redirect('/adminpanel/tax')->with('flash_message', _i('Updated Successfully !'));
    }



    public function storeTaxOption(Request $request)
    {
      //  dd($request->all());
        if ($request->ajax()) {

            $rules = [
                'tax' => 'required|max:3',
                'country_id' => 'required',
            ];

            $validator = validator()->make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $taxs= Tax::create([
                'tax' => $request->tax,
                'country_id' => $request->country_id,
                'store_id' => session('StoreId'),
            ]);
            }
        return response()->json(['status' => 'success']);
        }
    }


    public function storeOptions(Request $request, $id)
    {
        $setting = \App\Models\Settings\Setting::where("id", $id)->where("store_id", session('StoreId'))->first();

        if ($request->has('tax_on_shipping')) {
            $setting->tax_on_shipping = $request->tax_on_shipping;
        } else {
            $setting->tax_on_shipping = 0;
        }

        if ($request->has('tax_on_product')) {
            $setting->tax_on_product = $request->tax_on_product;
        } else {
            $setting->tax_on_product = 0;
        }

        $setting->save();

        return response()->json(['status' => 'success']);
    }


    public function getDatatabletaxs()
    {
        $taxs = Tax::leftJoin('countries_data','countries_data.country_id','tax.country_id')
        ->select('tax.*','countries_data.title')
        ->where('countries_data.source_id', null)
        ->where("tax.store_id",  session('StoreId'))
        ->get()
        ;
        return DataTables::of($taxs)
            ->addColumn('action', function ($taxs) {

                $html = '<a href ="#" data-toggle="modal" data-target="#edit"
         class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;' . '
            <form class=" delete"  action="' . route("taxs.destroy", $taxs->id) . '"  method="POST" id="deleteRow"
            style="display: inline-block; right: 50px;" >
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-danger" title=" ' . _i('Delete') . ' "> <span> <i class="ti-trash"></i></span></button>
             </form>
            </div>';

                return $html;
            })
            ->rawColumns([
                'action'
            ])
            ->make(true);
    }


    public function update_taxs(Request $request, $id)
    {
        $sessionStore = \App\Bll\Utility::getStoreId();

        $taxs = Tax::leftJoin('countries_data','countries_data.country_id','tax.country_id')
                ->select('tax.*','countries_data.title')
                ->where('countries_data.source_id', null)
                ->where("tax.store_id",  session('StoreId'))
                ->where("id", $id)->get();

        $rules = [
            'tax' => 'required|max:3',
            'country_id' => 'required',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $taxs->tax = $request->tax;
        $taxs->country_id = $request->country_id;
        $taxs->store_id = $sessionStore;

        $taxs->save();
        return redirect('adminpanel/settings/currency')->with('flash_message', _i('edited Done'));
    }


    public function taxs_destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

    public function updateTaxStatus(Request $request) {

        $sessionStore = \App\Bll\Utility::getStoreId();

        $setting = Setting::where("store_id", '=', $sessionStore)->first();

       $setting->update(['tax_on_shipping' => $request->val]);

       return $setting->tax_on_shipping;

    }


    public function updateTaxStatusnumb(Request $request) {

         $sessionStore = \App\Bll\Utility::getStoreId();

         $setting = Setting::where("store_id", '=', $sessionStore)->first();

       $setting->update(['tax_on_product' => $request->val]);

       return $setting->tax_on_product;
    }


}
