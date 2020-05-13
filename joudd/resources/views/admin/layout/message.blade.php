

@if(Session::has('flash_message'))
    <script>
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: "{{session('flash_message')}}",
            showConfirmButton: false,
            timer: 5000
        })
    </script>

@endif


{{--@if (session('status'))--}}
    {{--<div class="alert alert-success">--}}
        {{--{{ session('status') }}--}}
    {{--</div>--}}


    {{--<script>--}}
    {{--Swal.fire({--}}
    {{--position: 'top-end',--}}
    {{--type: 'success',--}}
    {{--title: "{{ session('status') }}",--}}
    {{--showConfirmButton: false,--}}
    {{--timer: 5000--}}
    {{--})--}}
    {{--</script>--}}
{{--@endif--}}



{{--@if (session('status'))--}}
    {{--<p>{{ session('status') }}</p>--}}
{{--@endif--}}
