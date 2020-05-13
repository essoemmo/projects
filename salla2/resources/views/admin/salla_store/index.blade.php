@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Sallatk Store')}}
@endsection

@section('page_url')
    <li class="breadcrumb-item">
        <a href="{{url('adminpanel')}}">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item active"><a href="#">{{_i('Sallatk Store')}}</a>
    </li>
@endsection


@section('content')

    @include('admin.salla_store.includes.membership')
    @include('admin.salla_store.includes.designs')


@endsection

@push('js')
    <script>


    </script>

@endpush
