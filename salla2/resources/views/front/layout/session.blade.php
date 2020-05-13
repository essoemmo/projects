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
 
 @if($errors->any())
 
    {{$all= implode('', $errors->all(':message')) }}
    @push('js')
        <script>
            new Noty({
                //position: 'top-end',
                icon: 'error',
                title: "{{$all}}",
                showConfirmButton: false,
                timer: 4000
            });

        </script>
    @endpush
@endif



@if(Session::has('flash_message'))
    @push('js')
        <script>
            new Noty({
                //position: 'top-end',
                icon: 'success',
                title: "{{Session::get('flash_message')}}",
                showConfirmButton: false,
                timer: 4000
            });

        </script>
    @endpush

@endif

  @foreach (['error', 'warning', 'success', 'info' ] as $msg)
           
        @if(Session::has($msg))
        
         @push('js')
        <script>
            new Noty({
                //position: 'top-end',
                icon: '{{$msg}}',
                title: "{{Session::get($msg)}}",
                showConfirmButton: false,
                timer: 4000
            });

        </script>
    @endpush
        
               
            @endif
        @endforeach