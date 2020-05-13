<?php

/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 23/07/2019
 * Time: 02:12 �
 */

namespace App\Http\Controllers\Admin\Product;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Product_card;
use App\Models\Product_digital;
use App\Models\Product_donation;
use App\Models\Product_type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ProductTypeController extends Controller {

    public function all() {

        return view('admin.products.product_type.index');
    }

    public function datatableProductType() {
        $guard = Utility::get_guard();
        $product_types = Product_type::select(['id', 'title', 'description', 'store_id', 'created_at'])
                ->where('store_id', '=', session()->get('StoreId'));

        return DataTables::of($product_types)
                        ->addColumn('action', function ($p ) {
                            return $this->generateHtmlEdit_Delete([$p->id, $p->title, $p->description], $p->id);
                        })
                        ->make(true);
    }

    public function store(Request $request) {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }
        $guard = Utility::get_guard();
        $rules = [
            'title' => 'required|max:150|unique:product_types'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

//        $guard_store = Utility::Store;
        $product_type = Product_type::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'store_id' => session()->get('StoreId'),
                    'lang_id' => 1,
        ]);
        return redirect()->back()->with('flash_message', _i('Added Successfully'));
    }

    public function update(Request $request) {
        $sessionStore = session()->get(\App\Bll\Constants::StoreId);
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Updated Successfully'));
        }

        $product_type = Product_type::where("store_id", $sessionStore)->where("id", $request->id)->first();
        if ($product_type == null) {
            return response()->json(['fail' => _i('not found')]);
        }

        // $id = $request->input('id');
        // $product_type = Product_type::findOrFail($id);

        $rules = [
            'title' => ['required', 'max:150',
                Rule::unique('product_types')->ignore($product_type->id)]
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
        // return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->with('error', _i('Failed not unique'));

        if ($product_type) {
            $product_type->title = $request->title;
            $product_type->description = $request->description;
            $product_type->save();
            return redirect()->back()->with('flash_message', _i('Updated Successfully'));
        } else {
            return redirect()->back()->with('flash_message', _i('Not Found !'));
        }
    }

    public function delete(Request $request) {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Delated Successfully'));
        }

        $product_type = Product_type::where("store_id", $sessionStore)->where("id", $request->id)->first();
        if ($product_type == null) {
            return response()->json(['fail' => _i('not found')]);
        }

        // $id = $request->input('id');
        // $product_type = Product_type::findOrFail($id);

        if ($product_type) {
            $product_type->delete();
            return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
        } else {
            return redirect()->back()->with('flash_message', _i('Not Found !'));
        }
    }

    // samer abooda

    public function getCard(Request $request) {

        $data = Product_card::where('product_id', $request->id)->get();

        if ($data->count() > 0) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'empty']);
        }
    }

    protected function delDigital() {
        Product_digital::find(request()->id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function postCard(Request $request) {
        // dd($request->all());
//        $rules = [
//            'code' => 'required|array|min:1',
//        ];
        // $validator = validator()->make($request->all() , $rules);
//        if($validator->fails()){
//                    return response()->json(['status' => 'fail']);
//
//        }


        $card_Ids = Product_card::where('product_id', $request->card_id)->get();

        if ($card_Ids->count() > 0) {

            Product_card::where('product_id', $request->card_id)->delete();

            foreach ($request->code as $code) {
                Product_card::create([
                    'product_id' => $request->card_id,
                    'code' => $code,
                ]);
            }
        } else {
            foreach ($request->code as $code) {
                Product_card::create([
                    'product_id' => $request->card_id,
                    'code' => $code,
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }

    // digit product
    public function getdigital(Request $request) {

        $data = Product_digital::where('product_id', $request->id)->select("id", "file", "title")->get();

        if ($data->count() > 0) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function postdigital(Request $request) {
//            dd($request->all());
//        $this->validate($request, [
//
//            'file' => 'required',
//            'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//
//        ]);
//        $digitals = Product_digital::where('product_id',$request->diagital_id)->get();
//
//        if ($digitals->count() > 0){
//
//           // Product_digital::where('product_id',$request->diagital_id)->delete();
//
//
//            if($request->hasfile('file'))
//            {                
//
//                foreach($request->file('file') as $image)
//                {
//                    $name=$image->getClientOriginalName();
//                    $image->move(\App\Bll\FileLocation::Digital().$request->diagital_id, $name);
//
//                    Product_digital::create([
//                        'file' => $name,
//                        'product_id' => $request->diagital_id,
//                    ]);
//
//                }
//            }
//        }else
//        {
        if (isset(($request->title["new"]))) {
            $titles = ($request->title["new"]);
            if ($request->hasfile('file')) {
                $i = 0;
                $created = [];
                foreach ($request->file('file') as $image) {
                    $name = $image->getClientOriginalName();

                    $obj = Product_digital::create([
                                'file' => $name,
                                'title' => ($titles[$i]) ?: "",
                                'product_id' => $request->diagital_id,
                                'source' => $image->openFile()->fread($image->getSize())
                    ]);
                    $obj->source = null;
                    $created[] = $obj->toJson();
                    $i++;
                }

                return response()->json(['status' => 'success', "data" => $created]);
            }
        }
//        }



        return response()->json(['status' => 'fail']);
    }

    //DonateProduct


    public function getdonate(Request $request) {
        $data = Product_donation::where('product_id', $request->id)->get();

        if ($data->count() > 0) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function postdonate(Request $request) {
           // dd($request->Donate_id);

        $rules = [
            'min_price' => 'required',
            'max_price' => 'required',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator]);
        }


        $card_Ids = Product_donation::where('product_id', $request->Donate_id)->get();

        if ($card_Ids->count() > 0) {

            Product_donation::where('product_id', $request->Donate_id)->delete();


            for ($i = 0; $i < count($request->min_price); $i++) {
                Product_donation::create([
                    'min_price' => $request->min_price[$i],
                    'max_price' => $request->max_price[$i],
                    'product_id' => $request->Donate_id
                ]);
            }
        } else {
           // dd($request->all());
            for ($i = 0; $i < count($request->min_price); $i++) {
                Product_donation::create([
                    'min_price' => $request->min_price[$i],
                    'max_price' => $request->max_price[$i],
                    'product_id' => $request->Donate_id
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }

}
