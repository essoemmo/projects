<?php


namespace App\Http\Controllers\Admin\Order;


use App\Hr\Course\Bank_transfer;
use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use App\Models\Admin\CourseMedia;
use App\Models\Currency;
use App\Models\OrderCourses;
use App\Models\Orders;
use App\Models\transaction_types;
use App\Models\transactions;
use App\User;
use Yajra\DataTables\DataTables;

class OrdersController extends  Controller
{

    public function offline_orders()
    {
        return view('admin.orders.offline.all_offline');
    }

    public function offline_datatable()
    {
        $query = transactions::where('bank_id' ,"!=", null)->get();

        return DataTables::of($query)
            ->addColumn('user' , function($query){
                $order = Orders::where('id' , $query->order_id)->first();
                $user = User::where('id' , $order->user_id)->first();
                return $user["first_name"]." ".$user["last_name"];
            })
            ->addColumn('bank' , function($query){
                $bank = Bank_transfer::where('id' , $query->bank_id)->first();
                return $bank["title"];
            })
            ->editColumn('total' , function($query){
                $currency = Currency::where('id' , $query->currency_id)->first();
                return $query["total"] ." ". $currency["title"];
            })
            ->addColumn('course' , function($query){

                $order_course = OrderCourses::where('order_id' , $query->order_id)->first();
                if($order_course["type"] == "media")
                {
                    $media_id = $order_course["course_id"];
                    $course_id = media($media_id)["course_id"] ;
                    $media_title = course_details($course_id)["title"];
                    return $media_title;
                }else{
                    $course_id = $order_course["course_id"];
                    $course_title = Course::where('id' , $course_id)->first();
                    return $course_title["title"] ;
                }
            })
//            ->addColumn('currency' , function($query){
//                $currency = Currency::where('id' , $query->currency_id)->first();
//                return $currency["title"];
//            })
            ->addColumn('delete', 'admin.orders.offline.btn.delete')
            ->rawColumns([
                'delete',
            ])
            ->make(true);
    }
    public  function show_offline($id)
    {
        $transaction = transactions::findOrFail($id);
        $order = Orders::where('id' , $transaction->order_id)->first();
        $user = User::where('id' , $order->user_id)->first();
        $bank = Bank_transfer::where('id' , $transaction->bank_id)->first();
        $currency = Currency::where('id' , $transaction->currency_id)->first();
        $order_course = OrderCourses::where('order_id' , $order->id)->first();

        return view('admin.orders.offline.show' , compact('transaction','order','user','bank','currency' ,'order_course'));
    }


    public function online_orders()
    {
        return view('admin.orders.online.all_online');
    }

    public function online_datatable()
    {
        $query = transactions::where('type_id' ,"!=", null)->get();

        return DataTables::of($query)
            ->addColumn('user' , function($query){
                $order = Orders::where('id' , $query->order_id)->first();
                $user = User::where('id' , $order->user_id)->first();
                return $user["first_name"]." ".$user["last_name"];
            })
            ->addColumn('transaction_type' , function($query){
                $transaction_type = transaction_types::where('id' , $query->type_id)->first();
                return $transaction_type["title"];
            })
            ->editColumn('total' , function($query){
                $currency = Currency::where('id' , $query->currency_id)->first();
                return $query["total"] ." ". $currency["title"];
            })
            ->addColumn('course' , function($query){

                $order_course = OrderCourses::where('order_id' , $query->order_id)->first();
                if($order_course["type"] == "media")
                {
                    $media_id = $order_course["course_id"];
                    $course_id = media($media_id)["course_id"] ;
                    $media_title = course_details($course_id)["title"];
                    return $media_title;
                }else{
                    $course_id = $order_course["course_id"];
                    $course_title = Course::where('id' , $course_id)->first();
                    return $course_title["title"] ;
                }
            })
//            ->addColumn('currency' , function($query){
//                $currency = Currency::where('id' , $query->currency_id)->first();
//                return $currency["title"];
//            })
            ->addColumn('delete', 'admin.orders.online.btn.delete')
            ->rawColumns([
                'delete',
            ])
            ->make(true);
    }


    public  function show_online($id)
    {
        $transaction = transactions::findOrFail($id);
        $order = Orders::where('id' , $transaction->order_id)->first();
        $user = User::where('id' , $order->user_id)->first();
        $transaction_type = transaction_types::where('id' , $transaction->type_id)->first();   //type_id => is transaction_types table id
        $currency = Currency::where('id' , $transaction->currency_id)->first();
        $order_course = OrderCourses::where('order_id' , $order->id)->first();

        return view('admin.orders.online.show' , compact('transaction','order','user','transaction_type','currency' ,'order_course'));
    }

    public function destroy($id)
    {
        $type = request()->input('type');
        //dd($type);
        $transaction = transactions::findOrFail($id);
        $transaction->delete();
        if($type == "online"){
            return redirect('admin/orders/online/all')->with('flash_message' ,_i('Deleted Successfully !'));
        }else{
            return redirect('admin/orders/offline/all')->with('flash_message' ,_i('Deleted Successfully !'));
        }
    }

    public function accept($id)
    {
        $transaction = transactions::findOrFail($id);
        $transaction->status = "paid";
        $transaction->save();
        return redirect()->back()->with('flash_message' ,_i('Accepted Successfully !'));
    }

    public function refused($id)
    {
        $transaction = transactions::findOrFail($id);
        $transaction->status = "refused";
        $transaction->save();
        return redirect()->back()->with('flash_message' ,_i('Refused Successfully !'));
    }

}