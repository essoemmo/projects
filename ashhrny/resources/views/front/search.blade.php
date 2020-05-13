@extends('front.layout.index')

@section('title')

    {{ _i('Search') }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <div class="member-section-columns top-famous common-wrapper">
        <div class="container">
            <div class="section-top-filter d-md-flex justify-content-between text-center mb-5 bg-gray">
                <div class="section-title">{{_i('Search Resault')}}</div>

            </div>

            @if(count($members) >0)
            <div class="row" id="famous_ajax">

                @foreach($members as $member)
                    @php
                        $user_social = \App\Models\SocialLinkUser::where('user_id',$member['id'])->where('default', 1)->first(); //return default socialIcon & url
                        $social_data = \App\Models\Social_link::where('id' , $user_social['social_id'])->first();
                    @endphp
                    <div class="col-lg-3 col-md-6">
                        <div class="single-account @if($social_data){{explode("-", $social_data['icon'])[1]}} @else instagram @endif">
                            <div class="img-wrapper">
                                <div class="account-img">
                                    <a href="{{url('showProfile/'.$member['id'])}}" title="stone">
                                        <img data-src="{{$member['image'] != null ? asset($member['image']) : asset('front/personal_image.png')}}" alt=""
                                             class="img-fluid lazy">
                                    </a>
                                </div>
                                <div class="social-icons">
                                    <ul class="list-unstyled">
                                        <li class="show-on-hover">
                                            <a href="{{url('showProfile/'.$member['id'])}}" title="profile">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{$user_social['url']}}" title="">
                                                <i class="fab {{$social_data['icon']}}"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="context d-md-flex justify-content-between text-center">
                                <div title="" class="name">
                                    <a href="{{url('showProfile/'.$member['id'])}}" style="color: #000;">
                                        {{$member['first_name']." ".$member['last_name']}}
                                    </a>
                                </div>

                                <div title="{{$member['job_type'] }}" class="job-title">{{$member['job_type'] }}</div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            @else
                <div class="login-box-body text-center mt-3 mb-3" style="direction: rtl">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                <h5><?=_i("Not Found Members")?></h5>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/') }}">{{ _i('Go Home') }}</a>

                </div>
            @endif
        </div>
    </div>

@endsection
