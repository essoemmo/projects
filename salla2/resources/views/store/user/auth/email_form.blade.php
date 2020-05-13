@extends('store.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' ,app()->getLocale()) }}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Reset Password')}}</li>
            </ol>
        </div>
    </nav>



    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="@if(\App\Bll\Utility::getTemplateCode() != 'shade')col-md-6 offset-md-3 @endif">
                    <div class="center">

                        <a href="{{route('register' ,app()->getLocale())}}" class="btn btn-green "> {{_i('Don\'t have an account? Click here to register')}} </a>
                    </div>
                <form class="shadow-lg" action="{{route('resetpasssend' ,app()->getLocale())}}" method="post" data-parsley-validate="">

                        @csrf

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="{{_i('Email')}}"  data-parsley-maxlength="191">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif


                                <div class="">
                                    <div class="right" style="display:inline-block;">
                                        <button type="submit" class="btn btn-red"> {{_i('Send a password reset code')}}</button>
                                    </div>
                                    <div class="left" style="text-align: left; display:inline-block; float: left;" id="update_password">
                                        <a href="{{url(app()->getLocale().'/password/update')}}">
                                            <button type="button"  class="btn btn-green" >
                                                  {{_i('Change Password')}}
                                            </button>
                                        </a>
                                    </div>
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

@push('js')

    <script>
        //        $(document).ready(function() {
        $("#update_password").hide();
        //        });
    </script>

    @if(session('success'))

        <script>
            $(document).ready(function()
            {
                $("#update_password").show(1000);
            });
        </script>

    @endif

@endpush