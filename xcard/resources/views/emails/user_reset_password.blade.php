@component('mail::message')
# {{_i('Reset Account Password')}}
Welcome {{ $data['data']->name }}

@component('mail::button', ['url' => url('resetPassword/' . $data['token'])])
    {{_i('Reset Your Password')}}
@endcomponent

{{_i('Or')}} <br>
{{_i('Copy This Link')}} <br>
<a href="{{ url('resetPassword/' . $data['token']) }}">{{ url('resetPassword/' . $data['token']) }}</a>

{{_i('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
