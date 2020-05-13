@extends('web.layout.index')

@section('content')

@push('css')
    <style>
        .nowrap{
            width: 100% !important;
        }
    </style>

@endpush
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Account settings')}}</li>
            </ol>
        </div>
    </nav>


    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info' ] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-success" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>

    <div class="user-page common-wrapper">
        <div class="container">
            <div class="row profile">

                @include('web.user.showprofile',$user)
                <div class="col-md-9">
                    <div class="card">
                    <div class="card-header">طلباتي</div>
                        <div class="card-body">
                            {!! $dataTable->table([
                                'class'=> 'table table-striped table-bordered display responsive nowrap dataTable dtr-inline'
                            ],true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection