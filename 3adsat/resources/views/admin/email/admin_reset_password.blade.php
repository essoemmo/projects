@component('mail::message')
# Reset Account Password
Welcome {{ $data['data']->name }}

@component('mail::button', ['url' => url('admin/panel/resetPassword/' . $data['token'])])
Reset Your Password
@endcomponent

Or <br>
Copy This Link <br>
<a href="{{ url('admin/panel/resetPassword/' . $data['token']) }}">{{ url('admin/panel/resetPassword/' . $data['token']) }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
