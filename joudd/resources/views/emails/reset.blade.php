@component('mail::message')

@if($isAdmin == 1)
    <p> {{_i('Your Reset Code is :')}} {{$code}} </p>

    <a href="{{ config('app.url') }}/admin/password/update">{{_i('click here to reset')}}</a>

@else
    <p> Your Dosn`t have The Right </p>
@endif



Thanks,<br>
{{ config('app.name') }}

@endcomponent


