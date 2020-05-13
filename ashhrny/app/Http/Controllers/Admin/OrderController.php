<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Mail\OrderApproved;
use App\Mail\OrderRefused;
use App\Mail\OrderWaiting;
use App\Models\Contact;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateData;
use App\Models\FeaturedAdUser;
use App\Models\NotifyTemplate;
use App\Models\NotifyTemplateData;
use App\Models\Order;
use App\Models\SocialAdvertisementUser;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Order-Show'])->only('index');
        $this->middleware(['permission:Order-Show'])->only('show');
        $this->middleware(['permission:Order-Delete'])->only('delete');
    }

    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id', $id)->first();
        return view('admin.orders.show', compact('order', 'transaction', 'user'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $site_ads = FeaturedAdUser::where('orderNumber', $order->orderNumber)->delete();
        $socialAdvertisementUser = SocialAdvertisementUser::where('orderNumber', $order->orderNumber)->delete();
        $contact = Contact::where('orderNumber', $order->orderNumber)->delete();
        $order->delete();
        return redirect()->route('main')->with('success', _i('success delete'));
    }

    public function change($id, Request $request)
    {
        $order = Order::findOrFail($id);
        if ($order->email_status == 0) {
            $user = User::findOrFail($order->user_id);
            if ($request->ajax()) {
                // order accepted
                if ($request->status == 'accepted') {

                    $emailTemplate = EmailTemplate::where('code', 'orderStatusApproved')->first();
                    $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
                        ->where('email_template_id', $emailTemplate->id)
                        ->where('email_templates_data_translations.locale', \app()->getLocale())
                        ->select('email_templates_data.id as id', 'email_templates_data.from_email as from_email', 'email_templates_data_translations.body as body', 'email_templates_data_translations.subject as subject')
                        ->first();

                    $notifyTemplate = NotifyTemplate::where('code', 'orderStatusApproved')->first();
                    $notifyTemplateData = NotifyTemplateData::leftJoin('notify_templates_data_translations', 'notify_templates_data_translations.notify_data_id', 'notify_templates_data.id')
                        ->where('notify_template_id', $notifyTemplate->id)
                        ->where('notify_templates_data_translations.locale', \app()->getLocale())
                        ->select('notify_templates_data.id as id', 'notify_templates_data_translations.body as body', 'notify_templates_data_translations.subject as subject')
                        ->first();

                    if ($request->featured_user_id != null) {
                        $orderDetails = FeaturedAdUser::findOrFail($request->featured_user_id);
                        Mail::to($user->email)->send(new OrderApproved(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->featured_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderApproved($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->featured_type));
                    }

                    if ($request->famous_ad_id != null) {
                        $orderDetails = SocialAdvertisementUser::findOrFail($request->famous_ad_id);
                        Mail::to($user->email)->send(new OrderApproved(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->featured_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderApproved($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->advert_type));
                    }


                } // order refused
                elseif ($request->status == 'refused') {

                    $emailTemplate = EmailTemplate::where('code', 'orderStatusRefused')->first();
                    $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
                        ->where('email_template_id', $emailTemplate->id)
                        ->where('email_templates_data_translations.locale', \app()->getLocale())
                        ->select('email_templates_data.id as id', 'email_templates_data.from_email as from_email', 'email_templates_data_translations.body as body', 'email_templates_data_translations.subject as subject')
                        ->first();

                    $notifyTemplate = NotifyTemplate::where('code', 'orderStatusRefused')->first();
                    $notifyTemplateData = NotifyTemplateData::leftJoin('notify_templates_data_translations', 'notify_templates_data_translations.notify_data_id', 'notify_templates_data.id')
                        ->where('notify_template_id', $notifyTemplate->id)
                        ->where('notify_templates_data_translations.locale', \app()->getLocale())
                        ->select('notify_templates_data.id as id', 'notify_templates_data_translations.body as body', 'notify_templates_data_translations.subject as subject')
                        ->first();

                    if ($request->featured_user_id != null) {
                        $orderDetails = FeaturedAdUser::findOrFail($request->featured_user_id);
                        Mail::to($user->email)->send(new OrderRefused(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->featured_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderRefused($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->featured_type));
                    }

                    if ($request->famous_ad_id != null) {
                        $orderDetails = SocialAdvertisementUser::findOrFail($request->famous_ad_id);
                        Mail::to($user->email)->send(new OrderRefused(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->advert_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderRefused($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->advert_type));
                    }

                } // order waiting
                elseif ($request->status == 'wait') {

                    $emailTemplate = EmailTemplate::where('code', 'orderStatusWaiting')->first();
                    $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
                        ->where('email_template_id', $emailTemplate->id)
                        ->where('email_templates_data_translations.locale', \app()->getLocale())
                        ->select('email_templates_data.id as id', 'email_templates_data.from_email as from_email', 'email_templates_data_translations.body as body', 'email_templates_data_translations.subject as subject')
                        ->first();

                    $notifyTemplate = NotifyTemplate::where('code', 'orderStatusWaiting')->first();
                    $notifyTemplateData = NotifyTemplateData::leftJoin('notify_templates_data_translations', 'notify_templates_data_translations.notify_data_id', 'notify_templates_data.id')
                        ->where('notify_template_id', $notifyTemplate->id)
                        ->where('notify_templates_data_translations.locale', \app()->getLocale())
                        ->select('notify_templates_data.id as id', 'notify_templates_data_translations.body as body', 'notify_templates_data_translations.subject as subject')
                        ->first();

                    if ($request->featured_user_id != null) {
                        $orderDetails = FeaturedAdUser::findOrFail($request->featured_user_id);
                        Mail::to($user->email)->send(new OrderWaiting(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->featured_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderWaiting($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->featured_type));
                    }

                    if ($request->famous_ad_id != null) {
                        $orderDetails = SocialAdvertisementUser::findOrFail($request->famous_ad_id);
                        Mail::to($user->email)->send(new OrderWaiting(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'order' => $orderDetails->advert_type, 'from_email' => $emailTemplateData->from_email]));
                        $user->notify(new \App\Notifications\OrderWaiting($user->id, $notifyTemplateData->body, $notifyTemplateData->subject, $orderDetails->advert_type));
                    }


                }

                $order->status = $request->status;
                $order->email_status = 1;
                $order->save();
                return response()->json(true);
            }
        }
    }
}
