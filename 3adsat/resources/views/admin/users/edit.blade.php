@extends('admin.layout.index',[
'title' => _i('Edit User'),
'subtitle' => _i('Edit User'),
'activePageName' => _i('Edit User'),
'additionalPageUrl' => url('/admin/panel/front_users') ,
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
                <form role="form" action="{{route('front_users.update',$user->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{_i('First Name')}}</label>
                            <input type="text" class="form-control" id="" placeholder="Enter User first name" name="first_name" value="{{$user->first_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{_i('Last Name')}}</label>
                            <input type="text" class="form-control" id="" placeholder="Enter last name" name="last_name" value="{{$user->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{_i('Email')}}</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{_i('Phone')}}</label>
                            <input type="number" class="form-control" id="mobile" placeholder="Enter mobile phone" name="mobile" value="{{$user->mobile}}">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">{{_i('Gender')}}</label>--}}
{{--                            <select name="gender" class="form-control">--}}
{{--                                <option value="male" {{$user->gender == 'male' ? 'selected' : ''}}>{{_i('Male')}} </option>--}}
{{--                                <option value="female" {{$user->gender == 'female' ? 'selected' : ''}}>{{_i('Female')}}</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}


                        <div class="form-group">
                            <label for="exampleInputPassword1"> {{_i('Password')}}</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">  {{_i('Confirm Password')}}</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password confirmation">
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
