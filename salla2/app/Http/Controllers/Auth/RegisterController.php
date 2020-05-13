<?php

namespace App\Http\Controllers\Auth;

use App\Bll\MyFatoorah;
use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\StoreData;
use App\StoreUser;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
        // dd(session('memebr_id'));
        return view('auth.register', ["membership" => \App\Bll\Membership::getPackage()]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
//            'country_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'domain' => ['required', 'string', 'max:255', 'unique:stores'],
            'title' => ['required', 'string', 'max:255', 'unique:stores'],
//            'title' => ['required', 'string', 'max:255', 'unique:stores'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $memberships = \App\Bll\Membership::getPackage();
        $bll = new \App\Bll\Membership();
        return $bll->CreateStore($data, $memberships);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if (session()->has('memebr_id')) {
            $memberships = \App\Models\Membership\Membership::
            where('is_active', '=', 1)
                ->where('id', session('memebr_id'))
                ->first();

            if ($memberships->price > 0) {
                $transaction = new \App\Bll\MembershipTransaction();
                $transaction->Request = $request->all();
                $transaction->Membership = $memberships;
                $transaction->Save();
                return $this->StartPayment($request, $memberships);
            } else {
                $this->create($request->all());
                return view('auth.thanks', ["email" => $request->input('email')]);
            }
        } else {
            $this->create($request->all());
            return view('auth.thanks', ["email" => $request->input('email')]);
        }
    }

    private function StartPayment($request, $memberships)
    {
        // dd($request->all());
        // dd($request->input("domain"));
        $find = \App\Models\LockDomain::where("name", $request->input("domain"))->first();
        if ($find == null) {

            \App\Models\LockDomain::create(["name" => $request->input("domain")]);
        } else {
            //   dd(1);
            return redirect()->back()->with('error', _i("Domain Name is not available"));
        }


        $resultInitPayment = MyFatoorah::initializePayment($memberships->price, $memberships->currency_code);
        $resultInitPaymentdecode = json_decode($resultInitPayment);
        //  dd($resultInitPaymentdecode);
        return view('store.user.pay', ["resultInitPaymentdecode" => $resultInitPaymentdecode, "user" => $request->all()]);
    }

    public function verify_email(Request $request)
    {

        //dd($request);
        $user = StoreUser::where('email', $request->email)->first();
        $dataa = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        if (config("app.env") != "local") {
            Mail::send('emails.verifyemail', $dataa, function ($message) use ($user) {
                \App\sendemail::sendemail($message, $user);
            });
        }
        session()->flash('success', _i('Please check your email address'));
        return redirect()->back();
    }

    public function verfy($local = null, $id)
    {
        $user = User::findOrFail(decrypt($id));
        if ($user->email_verified_at != null) {
            session()->flash('error', _i('This email is activated before'));
            return redirect()->route('webLogin', \LaravelGettext::getLocale());
        }
        $user->is_active = 1;
        $user->email_verified_at = date("now");
        $user->save();
        $store = StoreData::where("owner_id", $user->id)->first();

        if ($store != null) {
            \App\Bll\Domain::CreateSubDomain($store->domain);
        }
        //\App\Bll\Domain::CreateSubDomain();
        session()->flash('success', _i('Thanks for your activation.'));
        return redirect()->route('webLogin', \LaravelGettext::getLocale());
    }

    public function execute_payment(Request $request)
    {

        $membership = Membership::find(session('memebr_id'));
        $params = [];
        $params['PaymentMethodId'] = $request->paymentmethod_id;
        $params['CustomerName'] = $request->name . ' ' . $request->lastname;
        $params['DisplayCurrencyIso'] = $membership->currency_code;
//        $params['MobileCountryCode'] = "966";
        $params['CustomerMobile'] = $request->phone;
        $params['CustomerEmail'] = $request->email;
        $params['InvoiceValue'] = $membership->price;
        $params['CallBackUrl'] = MyFatoorah::$callBackUrl;
        $params['ErrorUrl'] = MyFatoorah::$errorUrl;
        $params['language'] = \App\Bll\Utility::lang();
        $params['CustomerReference'] = "membership_" . $membership->id;
//        $params['CustomerCivilId'] = $request->customer_civil_id;
        //  $params['UserDefinedField'] = $request->user_defined_field;
//        $params['CustomerAddress']['block'] = $request->block;
//        $params['CustomerAddress']['street'] = $request->street;
//        $params['CustomerAddress']['HouseBuildingNo'] = $request->house_building_no;
//        $params['CustomerAddress']['Address'] = $request->address;
//        $params['CustomerAddress']['AddressInstructions'] = $request->address_instructions;
//        $params['ExpiryDate'] = '2020-02-10T11:43:20.633Z';
//        $params['SupplierCode'] = 0;
        $params['InvoiceItems'][0]['itemName'] = $request->title;
        $params['InvoiceItems'][0]['Quantity'] = 1;
        $params['InvoiceItems'][0]['UnitPrice'] = $membership->price;

        $resultExecPayment = MyFatoorah::ExecutePayment($params);

        $resultExecPaymentdecode = json_decode($resultExecPayment);
        //   dd($params, $resultExecPayment);
        if (isset($resultExecPaymentdecode->IsSuccess)) {
            $data = $resultExecPaymentdecode->Data;
            $PaymentURL = $data->PaymentURL;
            return redirect($PaymentURL);
//            $return = MyFatoorah::directPayment(["paymentType" => "card",
//                "card" => ["Number" => "5123450000000008",
//                    "expiryMonth" => "05",
//                    "expiryYear" => "21",
//                    "securityCode" => "100"]], $PaymentURL);
//            echo($return);
        }
        return redirect()->back()->with("error", "Payment gateway error");
        //$request->session()->put('resultExecPaymentdecode', $resultExecPaymentdecode);
    }

    public function success()
    {

        //  dd(session()->all());
        $transaction = new \App\Bll\MembershipTransaction();
        $transaction = $transaction->get();
        if ($transaction == null) {
            abort(404);
        }
        //$this->CreateStore($transaction->Request, $transaction->Membership);
        $bll = new \App\Bll\Membership();
        $bll->CreateStore($transaction->Request, $transaction->Membership);
        $transaction->destroy();
        return view('auth.thanks', ["email" => $transaction->Request['email']]);
    }

    public function fail(Request $request)
    {
        $transaction = new \App\Bll\MembershipTransaction();
        $transaction = $transaction->get();
        if ($transaction != null) {
            $domain = ($transaction->Request["domain"]);
            \App\Models\LockDomain::where("name", $domain)->delete();
            $transaction->destroy();
        }
        return view('myfatoorah.fail');


    }

}
