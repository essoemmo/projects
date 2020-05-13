@extends('web.layout.index')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Reset Password')}}</li>
            </ol>
        </div>
    </nav>


    @foreach ([ 'success', 'danger'] as $key)
        @if(Session::has($key))

            <div class="container alert alert-{{ $key }}">
                <strong> <p >{{ Session::get($key) }}</p> </strong>
            </div>

        @endif
    @endforeach

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="#" class="btn btn-green "> {{_i('Reset Password')}} </a>
                    </div>
                    <form class="shadow-lg" action="{{url('/password/update')}}" method="post" data-parsley-validate="">

                        @csrf

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="number" class="form-control{{ $errors->has('pin_code') ? ' is-invalid' : '' }}"  id="pin_code"  required=""
                                       name="pin_code" data-parsley-maxlength="6" placeholder="{{_i('Code Number')}}" value="{{old('pin_code')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('pin_code'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pin_code') }}</strong>
                                    </span>
                                @endif

                                <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}"
                                       name="password" required="" min="6" data-parsley-min="6" placeholder="{{_i('Password')}}">

                                @if ($errors->has('password'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <input type="password" id="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}"
                                       name="password_confirmation" required="" min="6" data-parsley-min="6" data-parsley-equalto="#password" placeholder="تأكيد الرقم السري">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                                <div class="center">
                                      <button type="submit" class="btn btn-red">{{_i('Save')}}</button>
                                </div>


                            </div>
                        </div>
                    </form>

                    @foreach ([ 'success', 'danger'] as $key)
                        @if(Session::has($key))

                            <br />

                            <div class=" alert alert-{{ $key }}">
                                <span> <p >{{ Session::get($key) }}</p> </span>
                            </div>

                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>


@endsection
