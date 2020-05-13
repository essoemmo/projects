<a href="{{url('/')}}" class="navbar-brand">
    <img data-src="{{asset('uploads/setting/'.settings()->loge)}}" alt="" class="img-fluid lazy">
</a>

# Reset Account Password
    Welcome {{ $data['data']->username }}

    @component('mail::button', ['url' => url('resetPassword/' . $data['token'])])
        Reset Your Password
    @endcomponent
{{--<a href="{{ url('resetPassword/' . $data['token']) }}" class="btn btn-info">{{ url('resetPassword/' . $data['token']) }}</a>--}}


Or <br>
    Copy This Link <br>
    <a href="{{ url('resetPassword/' . $data['token']) }}">{{ url('resetPassword/' . $data['token']) }}</a>

    Thanks,<br>
    {{ config('app.name') }}

