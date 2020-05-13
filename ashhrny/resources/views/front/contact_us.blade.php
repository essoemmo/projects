@extends('front.layout.index')

@section('title')

    {{ _i('All Blog Categories') }}

@endsection

@section('content')
    @include('front.layout.header')
    @include('front.layout.headerSearch')
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
                <li class="breadcrumb-item active" aria-current="page">{{_i('Contact US')}}</li>

            </ol>
        </div>
    </nav>


    <div class=" page-wrapper common-wrapper ">
        <div class="container">
            <div class="bg-gray p-3">

                <div class="text-center mb-3"><img data-src="{{asset('front/images/Ashherni.png')}}" alt=""
                                                   class="img-fluid lazy"></div>

                <div class="text-center mb-3">
                    <h4><b>{{_i('Contact Us')}}</b></h4>
                </div>

            </div>

            <div class="contact-info" style="margin-top: 4em;">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="contact-info-column">
                            <i class="fa fa-map-marker"></i>
                            <h5>{{_i('Address') }}</h5>
                            <p>{!! setting()['address'] !!}</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="contact-info-column">
                            <i class="fa fa-phone"></i>
                            <h5>{{ _i('Contact us') }}</h5>
                            @php
                                $phones = \App\Models\Phone::where('phoneable_id' , setting()['id'])->get();
                            @endphp
                            @foreach($phones as $item)
                                <p>{{_i('Telephone') }} : {{ $item['phone']}} </p>
                            @endforeach
                            <p>{{_i('E-mail') }} : {{ setting()['email']}} </p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="contact-info-column">
                            <i class="fa fa-envelope"></i>
                            <h5>{{ _i('Report abuse') }}</h5>
                            <p>{{setting()['report_email']}}</p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="user-page py-3" style="margin-top: 4em;">
                <div class="row profile">
                    <div class="col-md-9">

                        <div class="card  border-0">

                            <div class="card-body">
                                <form action="{{route('store.contact')}}" method="POST" data-parsley-validate="">
                                    @csrf

                                    @honeypot {{--prevent form spam--}}

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">{{_i('Name')}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="{{_i('Name')}}"
                                                   name="name" required=""
                                                   maxlength="191" data-parsley-maxlength="150" minlength="3"
                                                   data-parsley-minlength="3"
                                                   value="{{auth()->user() ? auth()->user()->name : old('name') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label"> {{_i('Phone')}}</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" placeholder="{{_i('Phone')}}"
                                                   name="phone" data-parsley-maxlength="15"
                                                   value="{{auth()->user() ? auth()->user()->phone : old('phone') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label"> {{_i('Email')}}</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" placeholder="{{_i('Email')}}"
                                                   name="email" required=""
                                                   data-parsley-type="email" maxlength="100"
                                                   data-parsley-maxlength="100"
                                                   value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label"> {{_i('Message')}}</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" class="form-control" data-parsley-minlength="10"
                                                      placeholder="{{_i('Your Message here')}}" name="message"
                                                      required="">{{old('message')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-left">
                                        <input type="submit" class="btn grade m-2" value="{{_i('Send')}}">
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

