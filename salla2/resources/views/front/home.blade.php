@extends('front.layout.master')
@section('content')

    @push('css')
        <style>
            .btn-blue {
                background: #00ABCC;
                color: #ffffff;
                font-size: 19px;
                padding: 0px 24px;
                border-radius: 42px;
                transition: all 0.3s;
            }
        </style>
    @endpush

    <div class="slider ">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $key => $slider)
                    <li data-target="#carouselExampleFade" data-slide-to="0" class="@if($key == 0) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($sliders as $key => $slider)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="container">
                            <div class="carousel-caption">
                                <div class="row">
                                    <div class="col-md-5 align-self-center">
                                        <h3 class="main-title animated fadeInDown">{{$slider->title}}</h3>
                                        <p class="animated fadeInDown">{!! $slider->description !!}</p>
                                        <a href="{{ route('front.signUp', app()->getLocale()) }}"
                                           class="btn btn-blue animated fadeInDown">{{_i('create your own store for free')}}</a>
                                        <a href="{{ route('try_demo', app()->getLocale()) }}"
                                           class="btn btn-pink animated fadeInDown">{{_i('try demo')}}</a>
                                    </div>
                                    <div class="col-md-7 align-self-center d-none d-md-flex">
                                        <img
                                            src="{{asset('/uploads/settings/sliders/'.$slider->id.'/'.$slider->image)}}"
                                            class="img-fluid w-auto" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

    @if(count($counter) > 0)
        <section class="counters common-wrapper blue-bg-shaped">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-counter">
                            <div class="icon"><i class="fa {{$counter[0]->icon}}"></i></div>
                            <strong class="counter counter-default" data-decimals="3"
                                    data-decimal-delimiter=",">{{$counter[0]->counter}}</strong>
                            <p>{{$counter[0]->title}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-counter">
                            <div class="icon"><i class="fa {{$counter[1]->icon}}"></i></div>
                            <strong class="counter counter-default" data-decimals="3"
                                    data-decimal-delimiter=",">{{$counter[1]->counter}}</strong>
                            <p>{{$counter[1]->title}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-counter">
                            <div class="icon"><i class="fa {{$counter[2]->icon}}"></i></div>
                            <strong class="counter counter-default" data-decimals="3"
                                    data-decimal-delimiter=",">{{$counter[2]->counter}}</strong>
                            <p>{{$counter[2]->title}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has($msg))
            <br/>
            <div class="alert  alert-{{$msg}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5 class=" alert-{{ $msg }}"><b> {{ Session::get($msg) }} </b></h5>
            </div>
        @endif
    @endforeach
    <!---------------  strart content sections ----------------------->
    @if(count($content) > 0)
        <section class="why-us common-wrapper">
            <div class="container">

                @foreach($content as $key => $item)
                    {{--            @php--}}
                    {{--                $content_trans = \App\Models\Content_section_title::where('section_id' , $item->id)--}}
                    {{--                ->where('lang_id' ,getLang(session('lang')))--}}
                    {{--                ->first();--}}
                    {{--            @endphp--}}

                    {{--        <div class="center3">--}}
                    {{--            <div class="section-title">{!! $content_trans['title'] !!}</div>--}}
                    {{--            <p class="section-description">{{_i('Own a professional store with minimal costs and no commission on sales')}}
                    </p>--}}
                    {{--        </div>--}}

                    @php
                        $contents = \App\ContentSectionData::where('section_id' , $item->id)
                        ->where('lang_id' , getLang(session('lang')))
                        ->get();
                    @endphp

                    <div class="row">
                        @foreach($contents as $data)
                            <div class="col-lg-{{12 / $item['columns']}} col-md-6">
                                <div class="single-feature">
                                    {{--                        <div class="icon">{!! $data['content'] !!}</div>--}}
                                    {{--                        <h5 class="title"></h5>--}}
                                    <p>
                                        {!! $data['content'] !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach

            </div>
        </section>
    @endif
    <!---------------  end content sections ----------------------->
    <section class="our-projects blue-bg-shaped  p-5">
        <div class="container">

            <h6 class="section-title">{{_i('Models from stores')}}</h6>

            <div id="first-slider">
                <div id="projectsSlider" class="carousel slide carousel-fade">
                    <!-- Indicators -->

                    <ol class="carousel-indicators">
                        @foreach(\App\Bll\Utility::getSamples() as $key => $sample)
                            <li data-target="#projectsSlider" data-slide-to="0"
                                class="@if($key == 0) active @endif"></li>
                        @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                    @foreach(\App\Bll\Utility::getSamples() as $key => $sample)


                        <!-- Item 1 -->
                            <div class="carousel-item {{$key ==  0 ? "active" : ''}}">
                                <div class="row">

                                    <div class="col-md-6 align-self-center order-1 order-sm-0">

                                        <div class="shop-logo">
                                            @foreach (\App\Bll\Utility::getlogsfront() as $store_id )

                                                @if($sample->mstore_id == $store_id->stores_id)

                                                    <img
                                                        src="{{ asset('uploads/settings/site_settings/'.$store_id->setting_id.'/'. $store_id->logo)}}"
                                                        class="img-responsive image"/>

                                                @endif
                                            @endforeach

                                        </div>
                                        <h3 class="project-title"
                                            data-animation="animated fadeInDown"> {{_i($sample->title)}}
                                        </h3>
                                        <p class="project-description" data-animation="animated fadeInUp">
                                            {!! _i($sample->description) !!}
                                        </p>
                                        <a href="{{request()->getScheme()}}://{{$sample->domain}}.{{request()->getHost().'/home'}}"
                                           class="btn btn-blue" data-animation="animated fadeInRight">
                                            {{_i('Visit the site')}}
                                        </a>
                                    </div>
                                    <div class="col-md-6 align-self-center order-0 order-sm-1">
                                        <div class="screen-wrapper">
                                            <div class="img-wrapper">
                                                <img data-animation="animated fadeIn"
                                                     src="{{asset('uploads/samples/'.$sample->id.'/'.$sample->img_url)}}"
                                                     class="img-fluid">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="plans common-wrapper">
        <div class="container">
            <div class="center3">
                <h2 class="section-title">{{_i('Premium packages')}}</h2>
                <p class="section-description">{{_i('Create your store and choose the packages that suit you')}}</p>

            </div>
            <br>
            <div class="row">
                @foreach($memberships as $key => $membership)
                    {{--                    @dd($memberships)--}}
                    <div class="col-md-4 col-sm-6">
                        <div
                            class="single-plan @if($key == 0) pink @elseif($key == 1) blue @elseif($key == 2) orange @endif wow slideInUp ">
                            <div class="plan-title"> {{$membership->title}} </div>
                            <div class="price">
                                {{$membership->price}}
                            </div>
                            <div class="price">
                                {{$membership->duration}} {{_i('Month')}}
                            </div>
                            <ul class="list-unstyled">
                                {!! $membership->info !!}


                            </ul>
                            <div class="order-now">
                                {{--                                <a href="{{url(LaravelGettext::getLocale(),'package').'/'.$membership->membership_id.'/register'}}">{{_i('Ask Now')}}</a>--}}
                                <a href="javascript:void(0)" class="addmem"
                                   data-member_id="{{ $membership->membership_id }}">
                                    {{_i('Ask Now')}}
                                </a>
                                <div style="display: none;">
                                    <form action="{{route('addmem',LaravelGettext::getLocale())}}"
                                          id="addmem_{{ $membership->membership_id }}"
                                          method="POST"
                                          style="display:inline-block">
                                        {{csrf_field()}}
                                        {{method_field('post')}}
                                        <input type="hidden" name="member_id" value="{{ $membership->membership_id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="download-app">
        <div class="container">
            <div class="mobile-img wow fadeInUp "><img src="{{url('/')}}/front/images/download-app.png" alt=""
                                                       class="img-fluid"></div>
            <div class="download-links">
                <a href="" class="wow fadeIn"><img src="{{url('/')}}/front/images/andriod.png" alt="" class="img-fluid"></a>
                <a href="" class="wow fadeIn"><img src="{{url('/')}}/front/images/ios.png" alt="" class="img-fluid"></a>
            </div>
        </div>
    </section>

    @include('front.layout.session')

    <section class="contact-us-home common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-img"><img src="{{url('/')}}/front/images/contact-us-img.png" alt=""
                                                  class="img-fluid"></div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">{{_i('Contact Us')}}</div>
                    <p class="section-description">
                    {{_i('Have a question about your basket? Do you have an emergency? You can email us at any time')}}
                    {{--<a href="">{{frontSetting()['phone1']}}</a></p>--}}

                    <form class="row" method="post" data-parsley-validate="" id="add-contact">
                        @csrf
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" id="name" required=""
                                   placeholder="{{_i('Name')}}" maxlength="10" data-parsley-maxlength="10" minlength="3"
                                   data-parsley-minlength="3"
                                   value="{{auth()->user() ? auth()->user()->name : old('name') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="{{_i('email')}}"
                                   required="" data-parsley-type="email" maxlength="100" data-parsley-maxlength="100"
                                   value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                        </div>

                        <div class="col-md-12">
                        <textarea id="massage" cols="30" rows="5" class="form-control"
                                  placeholder="{{_i('Your Message...')}}" name="message" minlength="10"
                                  data-parsley-minlength="10" required=""></textarea>

                        </div>

                        <div class="col-sm-4">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                            @endif

                        </div>

                        <input type="submit" class="btn btn-blue mr-auto d-md-flex mt-3" value="{{_i('Send')}}">
                    </form>
                </div>
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

                $('body').on('submit', '#add-contact', function (e) {
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

                $('body').on('click', '.addmem', function (e) {
                    var member_id = $(this).data('member_id');
                    $('#addmem_' + member_id).submit();
                });
            })
        </script>
    @endpush



@endsection
