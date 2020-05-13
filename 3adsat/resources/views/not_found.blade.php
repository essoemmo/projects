@extends('web.layout.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#"> {{_i('Not Found')}} </a>
                </li>
            </ol>
        </div>
    </nav>

<section class="contact-page common-wrapper">

    <div class="container">

        <div class="row" style="margin: 3em ;">
            <div class="col-lg-12">
                <div class="alert alert-danger text-center">
                    <?= _i("Page Not Found")?>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
