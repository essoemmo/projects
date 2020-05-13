@extends('front.layout.index')

@section('title')

    {{ _i('My Points') }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="{{ _i('Home') }}" href="#">  {{ _i('Home') }} </a></li>
                <li class="breadcrumb-item active" title="{{ _i('My Profile') }}" aria-current="page">{{ _i('My Profile') }}</li>
            </ol>
        </div>
    </nav>

    <div class="user-page py-3">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    @include('front.user.includes.sideMenu')
                </div>
                <div class="col-md-9">

                    <div class="card  border-0">
                        <div class="card-header shadow-sm mb-4">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}  :  {{ membership_number($user->membership_number) }}</div>
                        </div>

                        <div class="card-body">

                            @if(count($points) > 0)

                                <div class="justify-content-center d-flex my-3">
                                    <div class="total-points-circle counter">
                                        {{ $user_points }}
                                    </div>

                                </div>
                                <div class="text-center my-5">

{{--                                    <a href="" class="btn grade ">{{ _i('Share') }}</a>--}}
                                </div>

                                <!--How to gain more points-->
                            @foreach($points as $point)
                                <div class="single-additional-point-method ">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="points-circle ">
                                                <div class="counter">{{ $point->points_number }}</div>
                                                <a href="">
{{--                                                    <span><i class="fas fa-plus"></i></span>--}}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 align-self-center">
                                            <h5 class="mb-3">{{ $point->title }}</h5>
                                            <p class="mb-0">{{ $point->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @else
                                <div class="alert alert-danger">{{ _i('No Points') }}</div>
                            @endif
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection
