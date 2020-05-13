@component('mail::message')

@if($isAdmin == 1)
    <h4> {{_i('There is a restriction open for review')}} </h4>

    <a href="{{url('/admin/communication/commoperation/create/operation')}}/?id={{$id}}">{{_i('click here to open')}}</a>

@endif
{{--<h4> {{_i('There is a restriction open for review')}} </h4>--}}
{{--@if($isAdmin == 1)--}}

    {{--@component('mail::button', ['url' => "{{ url('/subscriptions//admin/communication/commoperation/create/operation/'.'?id='.$id) }}", 'color' => 'green'])--}}
    {{--View Invoice--}}
    {{--@endcomponent--}}
    {{--[Safe Unsubscribe]({{ url('/subscriptions//admin/communication/commoperation/create/operation/'.'?id='.$id) }})--}}


{{--@endif--}}


Thanks,<br>
{{ config('app.name') }}

@endcomponent


