
@extends('admin.layout.index',[
'title' => _i('Add Admin'),
'subtitle' => _i('Add Admin'),
'activePageName' => _i('Add Admin'),
'additionalPageUrl' => url('/admin/panel/users') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/panel/users')}}" class="btn btn-default"><i class="ti-list"></i>{{ _i('All Users') }}</a></li>

                    </ol>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">

            <div class="card-header">
                <h5 >{{$title}}</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('users.store')}}" method="post">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{_i('Name')}}</label>
                        <input type="text" class="form-control" id="" placeholder="Enter User name" name="name">
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1">الاسم بالكامل</label>--}}
{{--                        <input type="full_name" class="form-control" id="" placeholder="Enter full name" name="fullname">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="exampleInputEmail1"> {{_i('Email')}} </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> {{_i('Phone')}}</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Enter mobile phone" name="mobile">
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1">النوع</label>--}}
{{--                        <select name="gender" class="form-control">--}}
{{--                            <option value="male">ذكر </option>--}}
{{--                            <option value="female">انثي</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}


                    <div class="form-group">
                        <label for="exampleInputPassword1"> {{_i('Password')}} </label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">  {{_i('Confirm Password')}} </label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label>{{_i('Roles')}}</label>

                        <select class="form-control" name="roles" required="">
                            {{--                                        <option value="">All Roles</option>--}}
                            @foreach(\Spatie\Permission\Models\Role::get() as  $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>

                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i>{{_i('Save')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
@endsection
