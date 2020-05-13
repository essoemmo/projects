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
                <h4 class="form-title m-b-xl text-center">سجل الدخول هنا</h4>
        <form action="{{route('login')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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

            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary" style="float: left">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label for="keep_me_logged_in">تذكرني</label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="تسجيل الدخول">
        </form>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('adminLogin-forget') }}">
                نسيت كلمة المرور
            </a>

        @endif
    </div><!-- #login-form -->


</div><!-- .simple-page-wrap -->
</body>
</html>


