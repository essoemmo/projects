@extends('web.layout.master')

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
                    <div class="center">

                        <a href="{{url('/register')}}" class="btn btn-pink ">{{_i('Don\'t have an account? Click here to register')}}</a>
                    </div>
                    <form class="shadow-lg" action="{{route('rest-password-post')}}" method="post">
                        {{method_field('post')}}
                        {{csrf_field()}}
                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="{{_i('Email')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-grad">{{_i('Send')}}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br> <br><br><br><br><br>
@endsection
