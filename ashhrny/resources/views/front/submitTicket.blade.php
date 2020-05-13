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

            .form-control {
                height: auto;
            }

            .ck-editor__editable_inline {
                min-height: 400px;
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
            <div class="col-sm-12">
                <form action="{{route('store.contact')}}" method="POST" data-parsley-validate=""
                      enctype="multipart/form-data">
                    @csrf

                    @honeypot {{--prevent form spam--}}

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="" class="col-form-label">{{_i('Name')}}</label>
                            <input type="text" class="form-control" placeholder="{{_i('Name')}}" name="name" required=""
                                   maxlength="191" data-parsley-maxlength="150" minlength="3" data-parsley-minlength="3"
                                   value="{{auth()->user() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : old('name') }}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="col-form-label"> {{_i('Email')}}</label>
                            <input type="email" class="form-control" placeholder="{{_i('Email')}}" name="email"
                                   value="{{ auth()->check() ? auth()->user()->email : old('name') }}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="col-form-label"> {{_i('Phone')}}</label>
                            <input type="text" data-parsley-type="number" class="form-control"
                                   placeholder="{{_i('Phone')}}" name="phone"
                                   value="{{ auth()->check() ? str_replace('+', '00', country_call_code()) . auth()->user()->mobile : old('phone') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="" class="col-form-label">{{_i('Membership No')}}</label>
                            <input type="text" class="form-control" placeholder="{{_i('Membership No')}}"
                                   name="membership_no"
                                   value="{{ auth()->check() ? membership_number(auth()->user()->membership_number) : '' }}"
                                   maxlength="15" data-parsley-maxlength="15" minlength="3"
                                   data-parsley-minlength="3">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="" class="col-form-label">{{_i('Subject')}}</label>
                            <input type="text" class="form-control" placeholder="{{_i('Subject')}}" name="subject"
                                   required=""
                                   maxlength="191" data-parsley-maxlength="191" minlength="3"
                                   data-parsley-minlength="3">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="" class="col-form-label">{{_i('Section')}}</label>
                            <select name="ticket_id" class="form-control">
                                @if(count($openTickets) > 0)
                                    @foreach($openTickets as $ticket)
                                        <option value="{{ $ticket->id }}"
                                                @if($ticket->id == $submitTicket->id) selected @endif>{{ $ticket->title }}</option>
                                    @endforeach
                                @else
                                    <option>{{ _i('No Data') }}</option>
                                @endif
                            </select>

                        </div>
                        <div class="form-group col-sm-6">
                            <label for="" class="col-form-label"> {{_i('Priority')}}</label>
                            <select name="priority_id" class="form-control">
                                @if(count($priorities) > 0)
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}">{{ $priority->title }}</option>
                                    @endforeach
                                @else
                                    <option>{{ _i('No Data') }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="" class="col-form-label">{{_i('Attach')}}</label>
                            <input type="file" class="form-control" name="attach" id="image">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-form-label">{{_i('message')}}</label>
                            <textarea class="form-control editor" placeholder="{{_i('message')}}" name="message"
                                      required="">
                            </textarea>
                        </div>
                    </div>

                    @if(strpos($submitTicket, 'payment') !== false)
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('Bank')}}</label>
                                <select name="bank_id" class="form-control">
                                    @if(count($banks) > 0)
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->title }}</option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('Sender name')}}</label>
                                <input type="text" class="form-control"
                                       name="holder_name"
                                       id="holder_name"
                                       value="{{old('holder_name')}}"
                                       placeholder="{{ _i('Sender name') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('Transfer number')}}</label>
                                <input type="text" class="form-control"
                                       name="bank_transactions_num"
                                       id="bank_transactions_num"
                                       data-parsley-type="number"
                                       value="{{old('bank_transactions_num')}}"
                                       placeholder="{{ _i('Transfer number') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('Transfer Image')}}</label>
                                <input type="file"
                                       class="form-control"
                                       name="image"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('The amount paid')}}</label>
                                <input type="text"
                                       class="form-control"
                                       name="amount_paid"
                                       data-parsley-type="number"
                                       placeholder="{{ _i('The amount paid') }}"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-form-label">{{_i('Current Orders')}}</label>
                                <select name="order_number" required class="form-control">
                                    @if(count($user_orders) > 0)
                                        @foreach($user_orders as $user_order)
                                            <option
                                                value="{{ $user_order->orderNumber }}">
                                                @if($user_order->advert_type != null)
                                                    @if($user_order->advert_type == 'website')
                                                        {{ _i('Ad on our accounts') }}
                                                    @else
                                                        {{ _i('Ad with celebrities') }}
                                                    @endif
                                                @else
                                                    @if($user_order->featured_type == 'featured')
                                                        {{ _i('Featured Members') }}
                                                    @else
                                                        {{ _i('Slider') }}
                                                    @endif
                                                @endif
                                            </option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="text-left">
                        <input type="submit" class="btn grade m-2" value="{{_i('Send')}}">
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

