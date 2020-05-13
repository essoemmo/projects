@extends('store.layout.master')

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
                <li class="breadcrumb-item"><a href="{{route('store.home' ,app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Orders awaiting payment')}}</li>
            </ol>
        </div>
    </nav>

    <div class="user-page common-wrapper">
        <div class="container">
            <div class="row profile">

                @include('store.user.showprofile',$user)
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">{{_i('my offline orders')}}</div>
                        <div class="card-body">
                            {!! $dataTable->table([
                                'class'=> 'table table-striped table-bordered display responsive nowrap dataTable dtr-inline'
                            ],true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')
    {!! $dataTable->scripts() !!}
@endpush
