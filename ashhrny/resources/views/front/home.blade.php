@extends('front.layout.index')

@section('title')

    {{ setting()['title'] }}

@endsection

@section('content')


    @include('front.layout.header')
    @include('front.layout.sliders')
    @include('front.layout.headerSearch')


    <!-------------------------------------- famous members -------------------------------------------->
    @if(userSetting()->famous_ads_front == 1 && userSetting()->famous_ads_front != 0)
        <div class="member-section-columns top-famous common-wrapper">
            <div class="container">
                <div class="section-top-filter d-md-flex justify-content-between text-center mb-5 bg-gray">
                    <div class="section-title">{{ _i('Advertise with celebrities') }}</div>
                    <div class="social-type">
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="d-inline-block">{{_i('Account Type')}}</label>

                                <select title="" class="custom-select d-inline-block" name="famous" id="famous_select">
                                    <option disabled selected>{{_i('Select Social Account')}}</option>
                                    @foreach($social_links as $social)
                                        <option value="{{$social['id']}}">{{$social['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                    </div>
                    <a href="javascript:void(0)" id="famous" title="{{ _i('Search') }}"
                       class="show-more">{{_i('Search')}}</a>
                </div>

                <div class="row" id="famous_ajax">
                    @foreach($famous_members as $member)
                        @php
                            $user_social = \App\Models\SocialLinkUser::where('user_id',$member['id'])->where('default', 1)->first(); //return default socialIcon & url
                            $social_data = \App\Models\Social_link::where('id' , $user_social['social_id'])->first();
                        @endphp
                        @if($user_social != null)
                            <div class="col-6 col-lg-3 col-md-6">
                                <div
                                    class="single-account @if($social_data){{explode("-", $social_data['icon'])[1]}} @else instagram @endif">
                                    <div class="img-wrapper">
                                        <div class="account-img">
                                            <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif"
                                               title="stone">
                                                <img
                                                    data-src="{{$member['image'] != null ? asset($member['image']) : asset('front/personal_image.png')}}"
                                                    alt=""
                                                    class="img-fluid lazy">
                                            </a>
                                        </div>
                                        <div class="social-icons">
                                            <ul class="list-unstyled">
                                                {{--                                        <li class="show-on-hover">--}}
                                                {{--                                            <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif" title="profile">--}}
                                                {{--                                                <i class="fas fa-eye"></i>--}}
                                                {{--                                            </a>--}}
                                                {{--                                        </li>--}}
                                                <li>
                                                    <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                                                       title="">
                                                        <i class="fab {{$social_data['icon']}}"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="context d-md-flex justify-content-between text-center">
                                        <div title="" class="name">
                                            <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif"
                                               style="color: #000;">
                                                {{$member['first_name']." ".$member['last_name']}}
                                            </a>
                                        </div>

                                        <div title="{{$user_social['content']}}"
                                             class="job-title">{{$user_social['content']}}</div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                                           class="btn grade" title="">
                                            {{ _i('Add Me') }}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    @endif

    <!-------------------------------------- featured members -------------------------------------------->
    <div
        class="vip-member @if(userSetting()->famous_ads_front == 1 && userSetting()->famous_ads_front != 0) grade @endif common-wrapper">
        <div class="container">

            <div class="section-top-filter d-md-flex justify-content-between text-center bg-white">
                <div class="section-title">{{_i('Featured Members')}}</div>
                <div class="social-type">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="d-inline-block">{{_i('Account Type')}}</label>

                            <select title="" class="custom-select d-inline-block" name="featured" id="featured_select">
                                <option disabled selected>{{_i('Select Social Account')}}</option>
                                @foreach($social_links as $social)
                                    <option value="{{$social['id']}}">{{$social['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                </div>
                <a href="javascript:void(0)" id="featured" title="{{ _i('Search') }}"
                   class="show-more">{{_i('Search')}}</a>
            </div>

            <div class="vip-member-slider " id="featured_ajax">

                @foreach($featured_users as $item)
                    @php
                        $user = \App\User::findOrFail($item['user_id']);
                        $user_social = \App\Models\SocialLinkUser::where('user_id',$user['id'])->where('social_id',$item['social_link_id'])->first();  //return default socialIcon & url
                        $social_link = \App\Models\Social_link::where('id' , $item['social_link_id'])->first();
                    @endphp
                    <div
                        class="single-account m-3 @if($social_link){{explode("-", $social_link['icon'])[1]}} @else instagram @endif">
                        <div class="account-img">
                            <a href="@if(auth()->check()) {{url('showProfile/'.$item['user_id'])}} @else {{ route('getRegister') }} @endif"
                               title="">
                                <img
                                    data-lazy="{{$user['image'] != null ? asset($user['image']) : asset('front/personal_image.png')}}"
                                    alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="social-icons">
                            <ul class="list-unstyled">
                                {{--                        <li><a href="@if(auth()->check()) {{url('showProfile/'.$item['user_id'])}} @else {{ route('getRegister') }} @endif" title="profile">--}}
                                {{--                                <i class="fas fa-eye"></i>--}}
                                {{--                            </a>--}}
                                {{--                        </li>--}}
                                <li>
                                    <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                                       title="">
                                        <i class="fab {{$social_link['icon']}}"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="context d-md-flex justify-content-between text-center">
                            <div class="name">
                                <a href="@if(auth()->check()) {{url('showProfile/'.$item['user_id'])}} @else {{ route('getRegister') }} @endif"
                                   style="color: #000;">
                                    {{$user['first_name']." ".$user['last_name']}}
                                </a>
                            </div>
                            <div title="{{$user_social['content']}}" class="job-title">{{$user_social['content']}}</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                               class="btn grade" title="">
                                {{ _i('Add Me') }}
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-------------------------------------- normal members -------------------------------------------->
    <div class="member-section-columns top-famous common-wrapper">
        <div class="container">
            <div class="section-top-filter d-md-flex justify-content-between text-center mb-5 bg-gray">
                <div class="section-title">{{_i('Members')}}</div>
                <div class="social-type">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="d-inline-block"> {{_i('Account Type')}}</label>

                            <select title="test" class="custom-select d-inline-block " name="normal" id="normal_select">
                                <option disabled selected>{{_i('Select Social Account')}}</option>
                                @foreach($social_links as $social)
                                    <option value="{{$social['id']}}">{{$social['title']}}</option>
                                @endforeach

                            </select>
                        </div>
                    </form>

                </div>
                <a href="javascript:void(0)" id="normal" title="{{ _i('Search') }}"
                   class="show-more">{{_i('Search')}}</a>
            </div>

            <div class="row" id="normal_ajax">

                @foreach($normal_members as $member)
                    @php
                        $user_social = \App\Models\SocialLinkUser::where('user_id',$member['id'])->where('default', 1)->first(); //return default socialIcon & url
                        $social_data = \App\Models\Social_link::where('id' , $user_social['social_id'])->first();
                    @endphp
                    @if($user_social != null)
                        <div class="col-6 col-lg-3 col-md-6">
                            <div
                                class="single-account @if($social_data){{explode("-", $social_data['icon'])[1]}} @else instagram @endif">
                                <div class="img-wrapper">
                                    <div class="account-img">
                                        <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif"
                                           title="">
                                            <img
                                                data-src="{{$member['image'] != null ? asset($member['image']) : asset('front/personal_image.png')}}"
                                                alt=""
                                                class="img-fluid lazy">
                                        </a>
                                    </div>
                                    <div class="social-icons">
                                        <ul class="list-unstyled">
                                            {{--                                    <li class="show-on-hover">--}}
                                            {{--                                        <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif" title="profile">--}}
                                            {{--                                            <i class="fas fa-eye"></i>--}}
                                            {{--                                        </a>--}}
                                            {{--                                    </li>--}}
                                            <li>
                                                <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                                                   title="">
                                                    <i class="fab {{$social_data['icon']}}"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{--                        @dd($user_social)--}}
                                <div class="context d-md-flex justify-content-between text-center">
                                    <div title="" class="name">
                                        <a href="@if(auth()->check()) {{url('showProfile/'.$member['id'])}} @else {{ route('getRegister') }} @endif"
                                           style="color: #000;">
                                            {{$member['first_name']." ".$member['last_name']}}
                                        </a>
                                    </div>
                                    <div title="{{$user_social['content']}}"
                                         class="job-title">{{$user_social['content']}}</div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="@if(auth()->check()) {{$user_social['url']}} @else {{ route('getRegister') }} @endif"
                                       class="btn grade" title="">
                                        {{ _i('Add Me') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>



@endsection


@push('js')

    <script>
        $(function () {
            'use strict';
            $("#normal").on('click', function () {
                var socialId = $('#normal_select').val();
                var type = "normal";
                $.ajax({
                    url: '{{ url('/social_search') }}',
                    method: 'GET',
                    DataType: 'json',
                    data: {socialID: socialId, user_type: type},
                    success: function (res) {
                        $('#normal_ajax').html(res);
                    }
                })
            });
            $("#famous").on('click', function () {
                var socialId = $('#famous_select').val();
                var type = "famous";
                $.ajax({
                    url: '{{ url('/social_search') }}',
                    method: 'GET',
                    DataType: 'json',
                    data: {socialID: socialId, user_type: type},
                    success: function (res) {
                        $('#famous_ajax').html(res);
                    }
                })
            });
            $("#featured").on('click', function () {
                var socialId = $('#featured_select').val();
                var type = "featured";
                $.ajax({
                    url: '{{ url('/social_search') }}',
                    method: 'GET',
                    DataType: 'json',
                    data: {socialID: socialId, user_type: type},
                    success: function (res) {
                        $('#featured_ajax').html(res);
                    }
                })
            })
        });
    </script>

@endpush

