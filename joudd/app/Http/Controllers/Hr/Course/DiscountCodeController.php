<?php

namespace App\Http\Controllers\Hr\Course;


use App\Http\Controllers\Controller;
use App\Help\Coupon;
use Symfony\Component\HttpFoundation\Request;
use App\Hr\Course\DiscountCode;
use Yajra\DataTables\Facades\DataTables;

class DiscountCodeController extends Controller
{
    //
    private $roles=[];
    public function index(){
        return view('admin.hr.course.DiscountCode.index');
    }
    public function getDataDisCodes(){
        return DataTables::of(DiscountCode::all())->addColumn('action',function ($discountCode){
            return $this->generateHtmlEdit_Delete([],$discountCode->id,true);
        })->make(true);
    }
    public function store(Request $request){
        $request->validate(
            $this->roles
        );
        $codesCount = $request->input('codes_count');
        for($i=0;$i < $codesCount;$i++){
            $disCode = new DiscountCode();
            $disCode->title = $request->input('title');
            $disCode->code = Coupon::generate(6, "”XYZ-”", "“-ABC”");
            $disCode->is_active = false;
            $disCode->discount = $request->input('discount');
            $disCode->created = date('Y-m-d');
            $disCode->save();
        }
        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
    }
    public function destroy(Request $request){
        DiscountCode::destroy($request->input('id'));
        return redirect()->back()->withFlashMessage(_i('Deleted Successfully !'));
    }
}
