<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\OpenTicket;
use App\Models\Order;
use App\Models\Priority;

class OpenTicketController extends Controller
{
    public function openTicket()
    {
        $openTickets = OpenTicket::leftJoin('open_ticket_translations', 'open_ticket_translations.open_ticket_id', 'open_ticket.id')
            ->where('open_ticket_translations.locale', app()->getLocale())
            ->select('open_ticket_translations.title as title', 'open_ticket.id as id', 'open_ticket_translations.description as description')
            ->get();
        return view('front.openTicket', compact('openTickets'));
    }

    public function submitTicket($id)
    {

        $submitTicket = OpenTicket::leftJoin('open_ticket_translations', 'open_ticket_translations.open_ticket_id', 'open_ticket.id')
            ->where('open_ticket_translations.locale', app()->getLocale())
            ->where('open_ticket.id', $id)
            ->select('open_ticket_translations.title as title', 'open_ticket.id as id', 'open_ticket_translations.description as description')
            ->first();

        $openTickets = OpenTicket::leftJoin('open_ticket_translations', 'open_ticket_translations.open_ticket_id', 'open_ticket.id')
            ->where('open_ticket_translations.locale', app()->getLocale())
            ->select('open_ticket_translations.title as title', 'open_ticket.id as id', 'open_ticket_translations.description as description')
            ->get();

        $priorities = Priority::leftJoin('priorities_translations', 'priorities_translations.priority_id', 'priorities.id')
            ->where('priorities_translations.locale', app()->getLocale())
            ->select('priorities_translations.title as title', 'priorities.id as id')
            ->get();

        $user_orders = Order::leftJoin('social_advertisement_user', 'social_advertisement_user.orderNumber', 'orders.orderNumber')
            ->leftJoin('featured_ads_users', 'featured_ads_users.orderNumber', 'orders.orderNumber')
            ->where('orders.user_id', auth()->user()->id)
            ->where('orders.status', 'wait')
            ->select('orders.orderNumber', 'social_advertisement_user.advert_type', 'featured_ads_users.featured_type')
            ->get();

        $banks = Bank::all();
        return view('front.submitTicket', compact('openTickets', 'submitTicket', 'priorities', 'banks', 'user_orders'));
    }
}
