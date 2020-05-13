
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ setting()['title'] }}</title>

    @include('front.layout.style')

</head>
<body>


@include('front.layout.header')
@yield('content')
@include('front.layout.session')
@include('front.layout.footer')

@include('front.layout.script')

@include('front.layout.addCart')
@include('front.layout.updateTotal')
</body>
</html>

