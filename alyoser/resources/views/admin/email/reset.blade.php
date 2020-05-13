<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>لوحة الدخول | اليسر</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="اليسر" />
    <link rel="shortcut icon" sizes="196x196" href="{{asset('logo.jpg')}}">

    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/misc-pages.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/plugins/noty/noty.min.js') }}"></script>
</head>
<body class="simple-page">
<div id="back-to-home">
    <a href="" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="/">
            <span><img src="{{asset('logo.jpg')}}" style="width: 100px"></span>
            {{--            <span>Yosr</span>--}}
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">كلمة المرور الجديدةا</h4>
        <form method="POST" action="{{ route('reset-password-admin-post',$check_token->token) }}">
            @csrf

            <input type="hidden" name="token" value="">

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $check_token->email }}" required autocomplete="email" autofocus>

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div><!-- #login-form -->


</div><!-- .simple-page-wrap -->

@include('admin.layout.session')
</body>
</html>


