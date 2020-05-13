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
            <h4>{{_i('Customer Groups')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Customer Details')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    @include('admin.userOrders.includes.group_modal')
    @include('admin.userOrders.includes.send_modal')
    <!-- Page-body start -->
    <div class="page-body">
        @if(count($users) > 0)
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card client-blocks">
                        <div class="card-block">
                            <h5><a href="javascript:void(0)" class="groups" data-id="all">{{ _i('All Customers') }}</a>
                            </h5>
                            <ul>
                                <li>
                                    <i class="icofont icofont-ui-user-group text-primary"></i>
                                </li>
                                <li class="text-right text-primary">
                                    {{ count($users) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if(count($groups) > 0)
                    @foreach($groups as $group)
                        <div class="col-md-6 col-xl-3">
                            <div class="card client-blocks">
                                <div class="card-block">
                                    <h5><a href="javascript:void(0)" class="groups"
                                           data-id="{{ $group->id }}">{{ $group->title }}</a></h5>
                                    <ul>
                                        <li>
                                            <img src="{{ asset($group->icon) }}" alt="" width="200px">
                                        </li>
                                        <li class="text-right text-primary">
                                            {{ count($group->groups_users) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-md-6 col-xl-3">
                    <div class="card client-blocks">
                        <div class="card-block">
                            <h5>{{ _i('Create New Group') }}</h5>
                            <ul>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#addGroup"
                                       style="font-size: 25px;font-weight: bold"><i
                                            class="ti-plus text-primary"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between my-3">
                <div class="main-btn">
                    <a href="{{ url('adminpanel/store_user/add') }}" class="btn btn-primary"><i
                            class="ti-plus"></i>
                        {{ _i('Add New User') }}
                    </a>
                </div>

                <div class="sub-btn">
                    @include('admin.userOrders.ajax.filter')
                </div>
            </div>

            <div id="error" class="alert alert-danger text-center" style="display: none">
                <p id="error_text"></p>
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
                            @include('admin.userOrders.ajax.users')
                        </div>
                    </div>
                </div>
                @else
                    <div class="alert alert-danger text-center">
                        <p class="lead">{{ _i('No Users') }}</p>
                    </div>
                @endif

            </div>

    </div>
@endsection


@push('js')

    <script>
        $(function () {
            //create group form
            $('#add_form').submit(function (e) {
                e.preventDefault();
                var url = "{{ route('createGroup') }}";

                var form = $("#add_form").serialize();
                $.ajax({
                    url: url,
                    type: "post",
                    //data:form,
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (res) {
                        if (res.errors) {
                            if (res.errors.title) {
                                $('#title-error').html(res.errors.title[0]);
                            }
                        }
                        if (res == true) {
                            $('.modal').modal('hide');
                            $("#add_form").parsley().reset();

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added Successfully')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }

                    }
                })
            });

            // send email or sms
            $('#send_form').submit(function (e) {
                e.preventDefault();
                var url = "{{ route('UserSend') }}";

                var form = $("#send_form").serialize();
                $.ajax({
                    url: url,
                    type: "post",
                    //data:form,
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (res) {
                        console.log(res);
                        if (res[0] == false) {
                            $('.modal').modal('hide');
                            $('#error').css('display', 'block');
                            $('#error_text').text(res.message);
                        } else {
                            $('.modal').modal('hide');
                            $('#error').css('display', 'none');
                            $("#send_form").parsley().reset();
                            $('#message').val("");

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Message on its Way')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }

                    }
                })
            });
        });
    </script>

@endpush
