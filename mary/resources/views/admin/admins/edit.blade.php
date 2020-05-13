@extends('admin.index')
@section('title', $title)
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{--                        @include('admin.layouts.message')--}}
                        <form role="form" action="{{route('users.update',$user->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الاسم</label>
                                    <input type="user_name" class="form-control" id="" placeholder="Enter User name" name="username" value="{{$user->username}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الاسم بالكامل</label>
                                    <input type="full_name" class="form-control" id="" placeholder="Enter full name" name="fullname" value="{{$user->fullname}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم الجوال</label>
                                    <input type="number" class="form-control" id="mobile" placeholder="Enter mobile phone" name="mobile" value="{{$user->mobile}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">النوع</label>
                                    <select name="gender" class="form-control">
                                        <option value="male" {{$user->gender == 'male' ? 'selected' : ''}}>ذكر </option>
                                        <option value="female" {{$user->gender == 'female' ? 'selected' : ''}}>انثي</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">تاكيد كلمة المرور</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password confirmation">
                                </div>

                                <div class="form-group">
                                    <label>الصلاحيات</label>

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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


@endsection
