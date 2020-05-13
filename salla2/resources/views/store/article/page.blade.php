@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' , app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if($found != null) {{$page['title']}} @else {{_i('Not Found') }}@endif </li>
            </ol>
        </div>
    </nav>
    <div class="wide-ad text-center mt-4">
        <div class="container">
        </div>
    </div>

    <div class="single-product-page-wrapper common-wrapper">
        <div class="container">
            <div class="row">


               @if($found != null)

                    <div class="col-md-12 ">

                        <h1 class="main-title"> {{$page['title']}} </h1>

                        <div class="head-title"> {{ date("Y M d ", strtotime($page->created_at)) }} </div>
                        <div class="description" style="overflow-wrap: break-word">
                            {!! $page->content !!}
                        </div>

                    </div>

                @else
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            {{ _i('No Pages') }}
                        </div>
                    </div>
               @endif
            </div>
        </div>
    </div>

    <br />
@endsection



