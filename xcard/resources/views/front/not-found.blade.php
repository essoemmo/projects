@extends('front.layout.index')

@section('content')

    <section class="items-section-wrapper">
        <div class="container">
            <div class="section-title">
                {{_i('Not Found')}}
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        <h5><?=_i("Sorry the page you are looking for is not found")?></h5>
                    </div>
                </div>
            </div>

            <div class="justify-content-center d-md-flex">
                <a href="{{url('/')}}" class="btn btn-yellow w-25 my-3">{{ _i('Go Home') }}</a>
            </div>

        </div>
    </section>

@endsection
