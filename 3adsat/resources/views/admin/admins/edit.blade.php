@extends('admin.layout.index',[
'title' => _i('Edit Admin'),
'subtitle' => _i('Edit Admin'),
'activePageName' => _i('Edit Admin'),
'additionalPageUrl' => url('/admin/panel/users') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{$title}}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('users.update',$user->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{_i('Name')}}</label>
                            <input type="user_name" class="form-control" id="" placeholder="Enter User name" name="name" value="{{$user->name}}">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">الاسم بالكامل</label>--}}
{{--                            <input type="full_name" class="form-control" id="" placeholder="Enter full name" name="fullname" value="{{$user->fullname}}">--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{_i('Email')}} </label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{_i('Phone')}}</label>
                            <input type="number" class="form-control" id="mobile" placeholder="Enter mobile phone" name="mobile" value="{{$user->mobile}}">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">النوع</label>--}}
{{--                            <select name="gender" class="form-control">--}}
{{--                                <option value="male" {{$user->gender == 'male' ? 'selected' : ''}}>ذكر </option>--}}
{{--                                <option value="female" {{$user->gender == 'female' ? 'selected' : ''}}>انثي</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}


                        <div class="form-group">
                            <label for="exampleInputPassword1"> {{_i('Password')}} </label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">  {{_i('Confirm Password')}} </label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password confirmation">
                        </div>

                        <div class="form-group">
                            <label>{{_i('Roles')}}</label>

                            <select class="form-control" name="roles" required="">
                                {{--                                        <option value="">All Roles</option>--}}
                                @foreach(\Spatie\Permission\Models\Role::get() as  $role)
                                    <option value="{{$role->id}}" {{($user->hasRole($role->name)) ? 'selected':''}}>{{$role->name}}</option>
                                @endforeach
                            </select>

                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{_i('Submit')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection
