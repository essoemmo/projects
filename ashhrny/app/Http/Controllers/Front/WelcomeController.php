<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Country;
use App\Models\FeaturedAdUser;
use App\Models\Front\NewsLetter;
use App\Models\OpenTicket;
use App\Models\Order;
use App\Models\Social_link;
use App\Models\Transaction;
use App\User;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{


    public function lang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return response()->json([$lang]);
    }

    public function index()
    {

        // seo tools
        SEOMeta::setTitle(setting() ? setting()->translate(\app()->getLocale())['meta_title'] : '');
        SEOMeta::setDescription(setting() ? setting()->translate(\app()->getLocale())['meta_description'] : '');
        SEOMeta::setCanonical('https://ashhrny.com');
        SEOMeta::addMeta(
            'article:published_time',
//            $post->published_date->toW3CString(),
            'property');
        SEOMeta::addMeta(
            'article:section',
//            $post->category,
            'property');
        SEOMeta::addKeyword(setting() ? setting()->translate(\app()->getLocale())['meta_keywords'] : '');

        //with facebook
        OpenGraph::setDescription(setting() ? setting()->translate(\app()->getLocale())['meta_description'] : '');
        OpenGraph::setTitle(setting() ? setting()->translate(\app()->getLocale())['meta_title'] : '');
        OpenGraph::setUrl('https://ashhrny.com');
        OpenGraph::addProperty('type', 'Website');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'ar-EG']);
        OpenGraph::addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);
        OpenGraph::addImage('http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);
        // twitter
        TwitterCard::setTitle(setting() ? setting()->translate(\app()->getLocale())['meta_title'] : '');
        TwitterCard::setSite('@LuizVinicius73');


        // google
        JsonLd::setTitle(setting() ? setting()->translate(\app()->getLocale())['meta_title'] : '');
        JsonLd::setDescription(setting() ? setting()->translate(\app()->getLocale())['meta_description'] : '');
        JsonLd::setType('Website');
        JsonLd::addImage('https://qeyeq.com/uploads/setting/HH5PEiDpXkybfZ9bM3iweE5mLR4OtN8iLP6qpYb5.jpeg');

        $famous_members = User::where('user_type', "famous")->orderBy('id', "desc")->take(16)->get();
        $normal_members = User::where('user_type', "normal")->orderBy('id', "desc")->take(16)->get();


        $slider_users = FeaturedAdUser::where('featured_type', "slider")->where('publish', 1)
            ->where('to', ">=", NOW())
            ->orderBy('from', "asc")->take(10)->get();

        $featured_users = FeaturedAdUser::where('featured_type', "featured")->where('publish', 1)
            ->where('to', ">=", NOW())
            ->orderBy('from', "asc")->take(10)->get();

        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();

        return view('front.home', compact('normal_members', 'famous_members', 'featured_users', 'slider_users', 'social_links',
            'countries'));
    }


    public function userSubscribeNewsLetters(Request $request)
    {
        $email = $request->email;
        $subscriber = NewsLetter::where('email', '=', $email)->first();
        if (!$subscriber) {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletters'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $subscriber = Newsletter::create([
                'email' => $request->email
            ]);

            $subscriber->save();
            $request->session()->put('email', $email);

            return view('front.user.subscribe')->with('warning', _i('Subscribed  successfully'));
        } else {
            $request->session()->put('email', $email);
            return view('front.user.subscribe-before');
        }
    }

    public function deleteSubscriber(Request $request)
    {
        $email = $request->session()->get('email', $request->email);
        $subscriber = Newsletter::where('email', '=', $email)->first();
        if ($subscriber) {
            $subscriber->delete();
            return redirect('/')->with('warning', _i('Successfully unsubscribed'));
        } else {
            return redirect('/');
        }
    }

    public function suspended()
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();
        return view('front.suspended', compact('countries', 'social_links'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('getLogin'));
    }

    public function contact_us()
    {
        $user_setting = \App\Models\UserSetting::first();
        if ($user_setting['contact_us'] == 1) {
            return view('front.contact_us');
        } else {
            return view('front.not-found');
        }
    }

    public function store_contact_us(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:191', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'message' => ['required', 'string', 'min:3'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => $request->subject,
            'ticket_id' => $request->ticket_id,
            'priority_id' => $request->priority_id,
            'membership_number' => $request->membership_number,
            'orderNumber' => $request->order_number,
        ]);

        if ($request->attach != null) {
            if (!is_dir(public_path('uploads/contacts/' . $contact->id))) {
                mkdir(public_path('uploads/contacts/' . $contact->id), 755, true);
            }
            \Intervention\Image\Facades\Image::make($request->attach)
                ->resize(248, 330, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('/uploads/contacts/' . $contact->id . '/' . $request->attach->hashName()));
            $contact->attach = '/uploads/contacts/' . $contact->id . '/' . $request->attach->hashName();
            $contact->save();
        }

        $submitTicket = OpenTicket::leftJoin('open_ticket_translations', 'open_ticket_translations.open_ticket_id', 'open_ticket.id')
            ->where('open_ticket_translations.locale', app()->getLocale())
            ->where('open_ticket.id', $request->ticket_id)
            ->select('open_ticket_translations.title as title', 'open_ticket.id as id', 'open_ticket_translations.description as description')
            ->first();

        if (strpos($submitTicket, 'payment') !== false) {
            $this->savePayment($request->all());
        }

        return redirect()->back()->with('success', _i('Your message has been sent successfully'));
    }

    private function savePayment($request)
    {
        $user = User::findOrFail(auth()->id());
        $bank = $request['bank_id'];
        $bank_transactions_num = $request['bank_transactions_num'];
        $holder_name = $request['holder_name'];
        $currency = _i('SAR');
        $payment_type = 'bank';
        $image = $request['image'];
        $total = $request['amount_paid'];
        $orderNumber = $request['order_number'];
        $order = Order::where('orderNumber', $orderNumber)->first();


        if ($orderNumber != null && $user->id != null) {
            DB::beginTransaction();
            try {
                if ($image) {
                    $numberrand = rand(11111, 99999);
                    $randname = time() . $numberrand;
                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/payment'), $imageName);
                }
                if ($payment_type == 'bank') {
                    $transaction = Transaction::create(['holder_name' => $holder_name, 'order_id' => $order->id, 'total' => $total, 'payment_type' => $payment_type, 'status' => 'pending', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'currency' => $currency, 'image' => '/uploads/payment/' . $imageName]);
                }
                DB::commit();
            } catch (\Exception $e) {
                return $e;
                DB::rollBack();
            }
            $transaction;
        }
        return redirect()->back()->with('success', _i('Your Request Is Pending Approval'));
    }
}
