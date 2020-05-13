@component('mail::message')
# Reset Account Password
Welcome {{ $data['data']->name }}

@component('mail::button', ['url' => aUrl('resetPassword/' . $data['token'])])
Reset Your Password
@endcomponent

Or <br>
Copy This Link <br>
<a href="{{ aUrl('resetPassword/' . $data['token']) }}">{{ aUrl('resetPassword/' . $data['token']) }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
