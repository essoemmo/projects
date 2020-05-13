@extends('front.layout.master')
@section('content')
<section class="register-form common-wrapper ">
    <div class="container">
        <div class="row">
            <div class="login-box-msg">{{ _i('Reset Password') }}</div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{route('chaneg-pass' , LaravelGettext::getLocale())}}" data-parsley-validate="">
                @csrf
                {{method_field('put')}}
                <div class="form-group has-feedback">
                    <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('pin_code')}}"
                           name="email" required="" placeholder="{{_i('E-mail')}}" style="width: 500%" >

                    @if ($errors->has('email'))
                        <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group has-feedback">
                    <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}"
                           name="password" required="" placeholder="{{_i('Password')}}" style="width: 500%">

                    @if ($errors->has('password'))
                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input type="password" id="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}"
                           name="password_confirmation" required="" placeholder="{{_i('Confirm Password')}}" style="width: 500%">

                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>


                <div class="form-group row text-center">
                        <button type="submit" class="btn btn-pink col-md-7 center">
                            {{ _i('Save') }}
                        </button>


                </div>

            </form>

            @foreach ([ 'success', 'danger'] as $key)
                @if(Session::has($key))

                    <div class="container alert alert-{{ $key }}">
                        <strong> <p >{{ Session::get($key) }}</p> </strong>
                    </div>

                @endif
            @endforeach
        </div>
    </div>
    </div>
</section>

    @endsection

@section('script')

    <script>

        $("#update_password").hide();

        @if(session('success'))

        $(document).ready(function()
        {
            $("#update_password").show(1000);
        });


        @endif
    </script>

@endsection

