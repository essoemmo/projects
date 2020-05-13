@component('mail::message')
# Reset Account Password
Welcome {{ $data['data']->name }}

@component('mail::button', ['url' => url('resetPassword/' . $data['token'])])
Reset Your Password
@endcomponent

Or <br>
Copy This Link <br>
<a href="{{ url('resetPassword/' . $data['token']) }}">{{ url('resetPassword/' . $data['token']) }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
