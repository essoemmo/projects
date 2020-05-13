<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 28/05/2019
 * Time: 02:10 �
 */

namespace App\Http\Controllers\Admin;


use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;
use App\Mail\SendUserEmail;
use App\Models\Bank;
use App\Models\Contact;
use App\Models\countries;
use App\Models\OpenTicket;
use App\Models\Order;
use App\Models\Priority;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Contacts-Show']);
    }

    public function index(ContactDataTable $contact)
    {
        return $contact->render('admin.contact.all');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $user = User::where('email', $contact->email)->first();
        $openTickets = OpenTicket::leftJoin('open_ticket_translations', 'open_ticket_translations.open_ticket_id', 'open_ticket.id')
            ->where('open_ticket_translations.locale', app()->getLocale())
            ->select('open_ticket_translations.title as title', 'open_ticket.id as id', 'open_ticket_translations.description as description')
            ->get();
        $priorities = Priority::leftJoin('priorities_translations', 'priorities_translations.priority_id', 'priorities.id')
            ->where('priorities_translations.locale', app()->getLocale())
            ->select('priorities_translations.title as title', 'priorities.id as id')
            ->get();
        if($contact->orderNumber != null) {
            $order = Order::where('orderNumber', $contact->orderNumber)->first();
            $trans = Transaction::where('order_id', $order->id)->first();
            $user_orders = Order::leftJoin('social_advertisement_user', 'social_advertisement_user.orderNumber', 'orders.orderNumber')
                ->leftJoin('featured_ads_users', 'featured_ads_users.orderNumber', 'orders.orderNumber')
                ->where('orders.user_id', $user->id)
                ->where('orders.status', 'wait')
                ->select('orders.orderNumber', 'social_advertisement_user.advert_type', 'featured_ads_users.featured_type')
                ->get();
            $banks = Bank::all();
        } else {
            $order = null;
            $trans = null;
            $user_orders = null;
            $banks = null;
        }
        return view('admin.contact.show', compact('contact', 'openTickets', 'priorities', 'trans', 'user_orders', 'banks'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/admin/contact/all')->with('success', 'Deleted Successfully !');
    }

    public function send(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $message = $request->message;
        $type = $request->type;
        if ($type == 'noty') {
            $user->notify(new \App\Notifications\OpenTicketNotification($user->id, $message));
        } else {
            \Mail::to($user->email)->send(new SendUserEmail(['user' => $user, 'body' => $message]));
        }
        return response()->json(true);
    }
}
