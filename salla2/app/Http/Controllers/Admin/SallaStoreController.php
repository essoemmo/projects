<?php


namespace App\Http\Controllers\Admin;


use App\Bll\MyFatoorah;
use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\Models\Membership\MembershipData;
use App\Models\Membership\User_membership;
use App\Models\Settings\Setting;
use App\Models\Template;
use App\Models\UserTemplate;
use App\StoreData;
use Illuminate\Http\Request;

class SallaStoreController extends Controller
{
    public function index()
    {

        //dd(auth()->guard('store')->user()->id);
        $storeId = Utility::getStoreId();
        $templates = Template::leftJoin('template_data', 'template_data.template_id', 'templates.id')
            ->select('templates.*', 'template_data.template_id', 'template_data.lang_id', 'template_data.title')
            ->where('template_data.lang_id', getLang(app()->getLocale()))
            ->where('price' ,">" ,0)->get();

        $user_id = StoreData::where('id' , $storeId)->first()->owner_id;
        $user_templates = UserTemplate::where('user_id', $user_id)->pluck('template_id')->toArray(); // turn to array

        $memberships = Membership::join('memberships_data','memberships_data.membership_id','memberships.id')
            ->select(['memberships.id as id','memberships.price','memberships.duration','memberships_data.title','memberships.currency_code',
                'memberships_data.lang_id'])
            ->where('memberships.is_active' , 1)
            ->where('memberships_data.lang_id', getLang(session('adminlang')))
            ->get();

        $user_membership = User_membership::where('user_id' ,$user_id)
            ->where('membership_id',StoreData::where('id' , $storeId)->first()->membership_id)->first();


//dd($user_templates);
        return view('admin.salla_store.index', compact('templates', 'user_templates','memberships','user_membership','user_id'));
    }

    public function buy_template(Request $request)
    {
        //dd($request->all());
        $currency = $request->template_currency;
        $price = $request->template_price;
        $user = auth()->guard('store')->user();
        $templateId = $request->template_id;

        $resultInitPayment = MyFatoorah::initializePayment($price, $currency);
        $resultInitPaymentdecode = json_decode($resultInitPayment);
        return view('admin.salla_store.pay', ["resultInitPaymentdecode" => $resultInitPaymentdecode, "user" => $user, 'currency' => $currency,
            'price' => $price,'template_id' => $templateId]);

    }

    public function execute_payment_admin_template(Request $request)
    {

        $user = json_decode($request->user);
        $params = [];
        $params['PaymentMethodId'] = $request->paymentmethod_id;
        $params['CustomerName'] = $user->name;
        $params['DisplayCurrencyIso'] = $request->currency;
        $params['CustomerMobile'] = $user->phone;
        $params['CustomerEmail'] = $user->email;
        $params['InvoiceValue'] = $request->price;
        $params['CallBackUrl'] = route('myfatoorah_admin.finish');
        $params['ErrorUrl'] = MyFatoorah::$errorUrl;
        $params['language'] = \App\Bll\Utility::lang();
        $params['CustomerReference'] = "storeOrder_" . $user->id;
        $params['InvoiceItems'][0]['itemName'] = $user->name;
        $params['InvoiceItems'][0]['Quantity'] = 1;
        $params['InvoiceItems'][0]['UnitPrice'] = $request->price;
        //$params['InvoiceItems'][0]['templateId'] = $request->template_id;


        $resultExecPayment = MyFatoorah::ExecutePayment($params);
        $resultExecPaymentdecode = json_decode($resultExecPayment);

        if ($resultExecPaymentdecode->IsSuccess) {
            $user_template = UserTemplate::create([   // create user template
                'user_id' => $user->id,
                'template_id' => $request->template_id
            ]);
            $data = $resultExecPaymentdecode->Data;
            $PaymentURL = $data->PaymentURL;
            return redirect($PaymentURL);
            $return = MyFatoorah::directPayment(["paymentType" => "card",
                "card" => ["Number" => "5123450000000008",
                    "expiryMonth" => "05",
                    "expiryYear" => "21",
                    "securityCode" => "100"]], $PaymentURL);
            echo($return);
        }
    }


    public function membership_details($id)
    {
        $membership = Membership::findOrFail($id);
        $membership_data = MembershipData::where('membership_id' ,$id)
            ->where('lang_id', getLang(session('adminlang')))->first();
        $duration = $membership->duration;
        $membership_expire = date('Y-m-d', strtotime("+".$duration." years"));


        return view('admin.salla_store.membership_details' , compact('membership','membership_data','membership_expire'));
    }

    public function buy_membership(Request $request)
    {
        $currency = $request->currency_code;
        $price = $request->price;
        $user = auth()->guard('store')->user();
        $membershipId = $request->membership_id;
        $expire_date = $request->expire_at;


        $resultInitPayment = MyFatoorah::initializePayment($price, $currency);
        $resultInitPaymentdecode = json_decode($resultInitPayment);
        return view('admin.salla_store.pay_membership', ["resultInitPaymentdecode" => $resultInitPaymentdecode, "user" => $user, 'currency' => $currency,
            'price' => $price,'membership_id' => $membershipId ,'expire_date' => $expire_date]);
    }

    public function execute_payment_admin_membership(Request $request)
    {
        $user = json_decode($request->user);
        $params = [];
        $params['PaymentMethodId'] = $request->paymentmethod_id;
        $params['CustomerName'] = $user->name;
        $params['DisplayCurrencyIso'] = $request->currency;
        $params['CustomerMobile'] = $user->phone;
        $params['CustomerEmail'] = $user->email;
        $params['InvoiceValue'] = $request->price;
        $params['CallBackUrl'] = route('myfatoorah_admin.finish');
        $params['ErrorUrl'] = MyFatoorah::$errorUrl;
        $params['language'] = \App\Bll\Utility::lang();
        $params['CustomerReference'] = "storeOrder_" . $user->id;
        $params['InvoiceItems'][0]['itemName'] = $user->name;
        $params['InvoiceItems'][0]['Quantity'] = 1;
        $params['InvoiceItems'][0]['UnitPrice'] = $request->price;
        //$params['InvoiceItems'][0]['templateId'] = $request->template_id;


        $resultExecPayment = MyFatoorah::ExecutePayment($params);
        $resultExecPaymentdecode = json_decode($resultExecPayment);

        if ($resultExecPaymentdecode->IsSuccess) {

            $user_membership = User_membership::create([
                'user_id' => $user->id,
                'membership_id' => $request->membership_id,
                'price' => $request->price,
                'expire_at' => $request->expire_date,
                'created' => date('Y-m-d')
            ]);

            $data = $resultExecPaymentdecode->Data;
            $PaymentURL = $data->PaymentURL;
            return redirect($PaymentURL);
            $return = MyFatoorah::directPayment(["paymentType" => "card",
                "card" => ["Number" => "5123450000000008",
                    "expiryMonth" => "05",
                    "expiryYear" => "21",
                    "securityCode" => "100"]], $PaymentURL);
            echo($return);
        }
    }

}