
@extends('master.layout.index',[
'title' => _i('Home'),
'activePageName' => _i('Home'),
])

@push('css')
    <style>

        .card-block ul li:hover a {
            font-weight: bold;
            width: 100%;
        }
        .card-block ul li a{
            font-size: 30px;
        }
    </style>
@endpush
@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card client-blocks primary-border">
                    <div class="card-block">
                        <a href="{{url('master/user/all')}}"><h5>{{_i('Users')}}</h5></a>
                        <ul>
                            <li style="float: left; color: #8CDDCD; ">
                                <i class="icofont icofont-ui-user-group "></i>
                            </li>
                            <li class="text-right ">
                                <a  href="{{url('master/user/all')}}" style="color: #8CDDCD;" >{{$users}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card client-blocks success-border">
                    <div class="card-block">
                        <a href="{{url('master/store/all')}}"><h5>{{_i('Stores')}}</h5></a>
                        <ul>
                            <li style="float: left">
                                <i class="icofont icofont-document-folder text-success"></i>
                            </li>
                            <li class="text-right text-success">
                                <a class="text-success" href="{{url('master/store/all')}}" >{{$stores}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card client-blocks warning-border">
                    <div class="card-block">
                        <a href="{{url('master/admin/all')}}"><h5>{{_i('Admins')}}</h5></a>
                        <ul>
                            <li style="float: left">
                                <i class="icofont icofont-ui-user-group text-warning"></i>
                            </li>
                            <li class="text-right text-warning">
                                <a class="text-warning" href="{{url('master/admin/all')}}" >{{$admins}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card client-blocks dark-primary-border">
                    <div class="card-block">
                        <a href="{{url('master/content_management')}}"><h5>{{_i('Content Management')}}</h5></a>
                        <ul>
                            <li style="float: left; color: #17a689;">
                                <i class="icofont icofont-document-folder "></i>
                            </li>
                            <li class="text-right ">
                                <a  href="{{url('master/content_management')}}" style="color: #17a689;"  >
                                   {{$contents}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card client-blocks warning-border">
                    <div class="card-block">
                        <a href="{{url('master/contact/all')}}"><h5>{{_i('Contacts')}}</h5></a>
                        <ul>
                            <li style="float: left">
                                <i class="icofont icofont-envelope-open text-warning"></i>
                            </li>
                            <li class="text-right">
                                <a class="text-warning" href="{{url('master/contact/all')}}" >{{$contacts}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection