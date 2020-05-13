@extends('layouts.app')

@section('content')
<div class="login-box-body" style="direction: rtl">
    <div class="login-box-msg">{{ _i('Reset Password') }}</div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{url('/admin/password/reset') }}" data-parsley-validate="">
        @csrf
        <div class="form-group has-feedback">
            <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="">
            <div class="right" style="display:inline-block;">
                <button type="submit" class="btn btn-primary">{{ _i('Send Password Reset Link') }}</button>
            </div>
            <div class="left" style="text-align: left; display:inline-block; float: left;" id="update_password" >
                <a href="{{url('/admin/user/password/update')}}">
                    <button type="button"  class="btn btn-green" >{{_i('Change Password')}}</button>
                </a>
            </div>
        </div>

    </form>

    @foreach ([ 'success', 'danger'] as $key)
        @if(Session::has($key))
        <div class="form-group row">
            <div class="col-md-12 col-form-label  alert alert-{{ $key }}">
                <strong> <p >{{ Session::get($key) }}</p> </strong>
            </div>
        </div>

        @endif
    @endforeach

</div>
@endsection

@section('footer')

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
