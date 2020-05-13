@extends('admin.layout.master')
@section('content')

    <div class="wrap">
        <section class="app-content">

            <h3>اضافة مستخدم</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">المستخدمين</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اضافة مستخدم</li>
                </ol>
            </nav>
        </section><!-- #dash-content -->
    </div><!-- .wrap -->


    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget p-lg">

                        @include('admin.layout.message')
                        <form action="{{route('users.store')}}" method="post" style="padding: 20px">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="">الاسم</label>
                                    <input type="text" class="form-control" id="" name="name" value="{{old('name')}}"
                                           placeholder=" name">
                                </div>

                                <div class="form-group">
                                    <label for="">البريد الالكتروني</label>
                                    <input type="email" class="form-control" id="" name="email" value="{{old('email')}}"
                                           placeholder=" email">
                                </div>

                                <div class="form-group">
                                    <label for="">كلمة المرور</label>
                                    <input type="password" class="form-control" id="" name="password"
                                           value="{{old('password')}}"
                                           placeholder=" password">
                                </div>

                                <div class="form-group">
                                    <label for="">تاكيد كلمة المرور</label>
                                    <input type="password" class="form-control" id="" name="password_confirmation"
                                           value="{{old('password_confirmation')}}"
                                           placeholder=" password_confirmation">
                                </div>

                                <div class="form-group">
                                    <label for="">Roles </label>
                                    <select class="form-control select2" name="role_id">
                                        <option>الصلاحيات</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="box-footer" style="padding: 50px">
                                    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div>
        </section><!-- #dash-content -->
    </div>


@endsection
