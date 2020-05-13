
@extends('admin.layout.admin_auth',[
'title' => trans('admin.forget_password'),
] )

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        <h1>{{ session('success') }}</h1>
    </div>
@endif


<form class="md-float-material" method="post" >
    {!! csrf_field() !!}

    <div class="text-center">
        <img src="{{ asset('uploads/setting/'.settings()->loge) }}" alt="logo.png">
    </div>
    <div class="auth-box">
        <div class="row m-b-20">
            <div class="col-md-12">
                <h3 class="text-left txt-primary">{{trans('admin.forget_password')}}</h3>
            </div>
        </div>
        <hr/>
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="{{ trans('admin.email') }}">
            <span class="md-line"></span>
        </div>

        <div class="row m-t-30">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{ trans('admin.reset_password') }}</button>
            </div>
        </div>
        <hr/>

    </div>
</form>

 @endsection

