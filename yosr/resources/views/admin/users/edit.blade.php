@extends('admin.layout.master')
@section('content')

    <div class="wrap">
        <section class="app-content">

            <h3>تعديل مستخدم</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">المستخدمين</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تعديل مستخدم</li>
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
                        <form action="{{route('users.update',$rows->id)}}" method="post" style="padding: 20px">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="">name</label>
                                    <input type="text" class="form-control" id="" name="name"
                                           value="{{old('name',$rows->name)}}"
                                           placeholder=" name">
                                </div>

                                <div class="form-group">
                                    <label for="">email</label>
                                    <input type="email" class="form-control" id="" name="email"
                                           value="{{old('email',$rows->email)}}"
                                           placeholder=" email">
                                </div>


                                {{--                                @dd($rows->hasRole('uploader'))--}}
                                <div class="form-group">
                                    <label for="">Roles </label>
                                    <select class="form-control select2" name="role_id">
                                        <option>Choose role</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{$rows->hasRole($role->name) == 'true'? 'selected':''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="box-footer" style="padding: 50px">
                                    <button type="submit" class="btn btn-primary btn-block">تعديل</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div>
        </section><!-- #dash-content -->
    </div>


@endsection
