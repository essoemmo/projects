@extends('front.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(LaravelGettext::getLocale() ,'')}}">{{_i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('contact us') }}</li>
            </ol>
        </div>
    </nav>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has($msg))
            <br />
            <div class="alert  alert-{{$msg}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5 class=" alert-{{ $msg }}" > <b> {{ Session::get($msg) }} </b></h5>
            </div>
        @endif
    @endforeach

    <section class="contact-page common-wrapper">

        <div class="container">
      <div class="contact-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-info-column">
                            <i class="fa fa-map-marker"></i>
                            <h5>{{_i('address') }}</h5>
                            <p>{!!_i($salla_settings['address'])!!}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-column">
                            <i class="fa fa-phone"></i>
                            <h5>{{ _i('contact us') }}</h5>
                            <p>Telephone: {{$salla_settings['phone1']}}</p>
                            @if($salla_settings['phone2'] != null)
                            <p>Telephone: {{$salla_settings['phone2']}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-column">
                            <i class="fa fa-clock-o"></i>
                            <h5>{{ _i('work time') }}</h5>
                            <p>{!!_i($salla_settings['work_time'])!!}</p>
{{--      <p>Sunday Close</p>--}}
                        </div>
                    </div>
                </div>
            </div>


            <div class="map-wrapper">
                <div class="google-maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1752.768858647445!2d-0.22962320641646145!3d51.59042137702072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876108b08ac8657%3A0xc6241b957359e27d!2sMiddlesex+University+London!5e0!3m2!1sen!2seg!4v1525079564159" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <br> <br> <br>


            <div class="contact-form" >
                <form  method="post" data-parsley-validate="" id="add-contact">

                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="{{_i('Name')}}"  name="name" id="name"  required=""
                                   maxlength="10"	data-parsley-maxlength="10" minlength="3" data-parsley-minlength="3"
                                   value="{{auth()->user() ? auth()->user()->name : old('name') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="{{_i('Email')}}" name="email" id="email" required=""
                                   data-parsley-type="email" maxlength="100" data-parsley-maxlength="100"
                                   value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="number" data-parsley-type="number" class="form-control" placeholder="{{_i('Phone')}}" name="phone" id="phone" data-parsley-maxlength="15"
                                   value="{{auth()->user() ? auth()->user()->phone : old('phone') }}" >
                        </div>


                        <div class="col-sm-6">
                            <select  class="form-control nice-select select2" name="country_id"  aria-hidden="true" style="width:100%"  id="Country">
                                <option  selected disabled>{{_i('Choose Country')}}</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}"
                                            {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12">

                            <textarea  id="" cols="30" rows="5" class="form-control" minlength="10" data-parsley-minlength="20"
                                       placeholder="{{_i('Your Message...')}}" name="message" required="">{{old('message')}}</textarea>
                        </div>

                        <div class="col-sm-4">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>

                   <input type="submit" class="btn btn-orange mr-auto d-md-flex" value="{{_i('Send')}}">


                </form>
            </div>
        </div>


    </section>

    @push('js')
    <script>

        $(function () {

            'use strict'

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $('body').on('submit','#add-contact',function (e) {
                        e.preventDefault();

                $.ajax({
                    url:"{{route('addcontact',  app()->getLocale())}}",
                    method: "post",
                    data: $(this).serialize(),
                    // dataType: 'json',
                    // cache       : false,
                    // contentType : false,
                    // processData : false,
                    success:function (res) {
                        //alert('fdhd')
                        if (res == 'success'){
                        new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Your message has been sent successfully')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            $('.modal.modal_create').modal('hide');
                    }
                    }
                })
            });
        })
    </script>
@endpush

@endsection

