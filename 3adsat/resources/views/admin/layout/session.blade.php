@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
@if (session('error'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: "{{ session('error') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif

@if (session('warning'))

    <script>
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: "{{ session('warning') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif