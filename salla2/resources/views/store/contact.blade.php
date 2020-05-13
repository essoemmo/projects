@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Contact Us')}}</li>
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
                            <h5>{{_i('Address')}}</h5>
                            <p>{!!_i($setting['address'])!!}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-column">
                            <i class="fa fa-phone"></i>
                            <h5>  {{_i('Call Us')}}</h5>
                            <p>Telephone: {!!_i($setting['phone1'])!!}</p>
                            <p>Telephone: {!!_i($setting['phone2'])!!}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-column">
                            <i class="fa fa-clock-o"></i>
                            <h5> {{_i('Work Time')}}</h5>
                            <p>{!!_i($setting['work_time'])!!} </p>
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


            <div class="contact-form">
                <form action="{{route('store_contact',app()->getLocale())}}" method="post" data-parsley-validate="">

                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="{{_i('Name')}}" name="name" required=""
                                   maxlength="150"	data-parsley-maxlength="150" minlength="3" data-parsley-minlength="3"
                                   value="{{auth()->user() ? auth()->user()->name : old('name') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="{{_i('Email')}}" name="email" required=""
                                   data-parsley-type="email" maxlength="100" data-parsley-maxlength="100"
                                   value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="number" data-parsley-type="number" class="form-control" placeholder="{{_i('Phone')}}" name="phone" data-parsley-maxlength="15"
                                   value="{{auth()->user() ? auth()->user()->phone : old('phone') }}" >
                        </div>


                        <div class="col-sm-6">
                            <select  class="form-control  usingselect2" name="country_id"   style="width:100%"  id="Country">
                                <option  selected disabled>{{_i('Choose Country')}}</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}"
                                            {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12">

                            <textarea  id="" cols="30" rows="5" class="form-control" minlength="10" data-parsley-minlength="10"
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

                    <div class="center"><input type="submit" class="btn btn-blue" value="{{_i('Send')}}"></div>


                </form>
            </div>
        </div>


    </section>


@endsection

@push('js')
{{--    <!-- Select2 -->--}}
{{--    <link rel="stylesheet" href="{{asset('front/select2/dist/css/select2.min.css')}}">--}}
{{--    <!-- Select2 -->--}}
{{--    <script src="{{asset('front/select2/dist/js/select2.full.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $('.select2').select2()--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        $(function(){--}}
{{--            $(".usingselect2").select2();--}}
{{--            $("select.usingselect2, select.normal").unbind().bind('change',function(){--}}
{{--                var optionObj = jQuery(this).find("option:selected");--}}
{{--                alert(optionObj.text() +" age is "+ optionObj.val());--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush

