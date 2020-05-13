
@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif

{{--    <div class="flash-message text-center">--}}
{{--        @foreach (['danger', 'warning', 'success', 'info'] as $msg)--}}
{{--            @if(Session::has($msg))--}}
{{--                <br />--}}
{{--                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </div>--}}