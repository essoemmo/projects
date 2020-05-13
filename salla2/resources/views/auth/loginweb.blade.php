@extends('front.layout.inner')
@section('content')


<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{_i('Login')}}</li>
        </ol>
    </div>
</nav>


<section class="register-form common-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="center3">
                    <a href="signup" class="btn btn-pink ">{{_i('No account? Click here to register a membership')}}</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="shadow-lg" method="POST" action="" aria-label="{{ __('Login') }}">
                    @csrf
                    {{ method_field('post') }}
                    <div class="row">

                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                   placeholder="{{_i("Email")}}" name="email">
                            <input type="password" class="form-control" id="Password" placeholder="{{_i('Password')}}" name="password">

                            <div class="custom-control2 custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                <label class="custom-control-label" for="customCheck1">{{_i("Remember me")}}</label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="reset/password" >
                                    {{ _i('Forgot Your Password') }}
                                </a>
                            @endif

                            <div class="centerlogin">
                            <button type="submit" class="btn btn-grad">{{_i('login')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
