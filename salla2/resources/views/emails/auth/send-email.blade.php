@component('mail::message')

<p> Your Email Account to Hailh is : {{$email}} </p>
<p> Your Password Account to Hailh is : {{$password}} </p>


<a href="{{url('/user/login')}}">click here to login</a>


Thanks,<br>


@endcomponent