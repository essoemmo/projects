@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Customer Details')}}
@endsection

@section('page_header_name')
    {{_i('Customer Details')}}
@endsection


@push('css')

    <style>
        .card-block a {
            color: #757575;
        }

        .card-block a:hover {
            color: #1abc9c;
        }
    </style>

@endpush

@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            @foreach ($users_product as $item)
              <h4>{{$item->proname}}</h4>  
            @endforeach       
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Customer Product')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
            <div class="row">


            </div>
            <div class="content">

                <!-- Blog-card start -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-name">
                            <h3>{{ _i('Customers') }}</h3>
                        </div>
                    </div>
                    <div class="card-block">
                        <div id="users_div">
                            <div class="loader-block" style="display: none">
                                <svg id="loader2" viewBox="0 0 100 100">
                                    <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                                </svg>
                            </div>
                            <div class="no-more-tables table-with-links">
                                <table class="table text-nowrap">
                                    <tbody id="table_list_customer" class="infinite-scroll">
                                        @if (!empty($users_product))
                                    @foreach($users_product as $user)
                                        <tr class="table-row customer-row">
                                            <td class="order-customer customer-td d-flex">
                                                <div class="media-left media-middle d-flex">
                                               
                                                    <a href="{{ url('/adminpanel/store_user/' . $user->id . '/orders') }}">
                                                        @if($user->userimage != null)
                                                            <img class="media-object img-circle comment-img"
                                                                 style="width: 55px;height: 55px"
                                                                 src="{{ asset($user->userimage) }}" alt="{{ $user->username }}">
                                                        @else
                                                            <img class="media-object img-circle comment-img"
                                                                 style="width: 55px;height: 55px"
                                                                 src="{{ asset('images/articles/personal_NoImage.jpg') }}"
                                                                 alt="{{ $user->username }}">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-left media-body-middle">
                                                    <div class="align-self-center">
                                                        <a href="{{ url('/adminpanel/store_user/' . $user->id . '/orders') }}">
                                                            {{ $user->username }} {{ $user->userlastname }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="{{ _i('City') }}"><span
                                                    class="text-muted"></span></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
          

            </div>


            @endsection

