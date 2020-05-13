@extends('admin.layout.admin_auth',[
'title' => _i('Admin Login '),
] )
@section('content')

   

<form class="md-float-material" method="post" action="{{route('postLogin')}}">
    {!! csrf_field() !!}
    {{method_field('post')}}

  
    <div class="auth-box">
          <div class="text-center">
              
                @if(settings() != null)
            <img src="{{ asset('uploads/setting/'.settings()->loge) }}" alt="logo.png" style="height: 98px">
        @endif
    </div>
        
        <div class="row m-b-20">
            <div class="col-md-12">
                <h3 class="text-left txt-primary">{{_i('Login')}}</h3>
            </div>
        </div>
         @if ($errors->all())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="{{ _i('email') }}">
            <span class="md-line"></span>
        </div>
        <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="{{ _i('password') }}">
            <span class="md-line"></span>
        </div>
        <div class="row m-t-25 text-left">
            <div class="col-sm-7 col-xs-12">
                <div class="checkbox-fade fade-in-primary">
                    <label>
                        <input type="checkbox" id="remember" name="remember_me" value="1">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">{{ _i('remember me') }}</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                <a href="{{ url('admin/panel/forgetPassword') }}" class="text-right f-w-600 text-inverse"> {{ _i('forget password') }} ?</a>
            </div>
        </div>
        <div class="row m-t-30">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{_i('login')}}</button>
            </div>
        </div>
        <hr/>

    </div>
</form>

@endsection
