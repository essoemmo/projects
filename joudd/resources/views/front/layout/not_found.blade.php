@extends('front.layout.app')

@section('content')

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Not Found') }}</li>
            </ol>
        </div>
    </nav>




    <div class="popular-courses common-wrapper">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <div class="alert alert-info text-center" role="alert">
                        {{_i('Not Found Courses')}}
                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection
