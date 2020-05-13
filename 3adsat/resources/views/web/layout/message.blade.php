
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
