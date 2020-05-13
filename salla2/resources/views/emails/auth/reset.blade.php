@component('mail::message')

<p> Your Reset Code is : {{$code}} </p>

@if($isAdmin == 1)
    <a href="{{ config('app.url') }}/adminpanel/user/password/update">click here to reset</a>
@else
    <a href="{{ config('app.url') }}/updatepassword">click here to reset</a>
@endif

Thanks,<br>


@endcomponent