@extends('front.layout.index')

@section('title')

    {{ _i('Open Ticket') }}

@endsection

@section('content')
    @include('front.layout.header')
    @push('css')

        <style>
            .contact-info-column i {
                color: #e83e8c;
                font-size: 60px;
                margin-bottom: 1em;
            }
            .contact-info-column h5 {
                font-size: 25px;
                margin: 1em 0;
            }
            .contact-info-column p {
                color: #515151;
                font-size: 16px;
            }
        </style>

    @endpush

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('open Ticket')}}</li>

            </ol>
        </div>
    </nav>


    <div class=" page-wrapper common-wrapper ">
        <div class="container">
            <h2>{{ _i('Open Ticket') }}</h2>

            <p>{{ _i('If you do not find a solution to your problem in our knowledge base, you can open a ticket by choosing the appropriate section below.') }}</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        @foreach($openTickets as $ticket)
                        <div class="col-md-6 margin-bottom">
                            <p>
                                <strong>
                                    <a href="{{ route('submitTicket', $ticket->id) }}">
                                        <i class="fas fa-envelope"></i>
                                        &nbsp;{{ $ticket->title }}
                                    </a>
                                </strong>
                            </p>
                            <p>{{ $ticket->description }}</p>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

