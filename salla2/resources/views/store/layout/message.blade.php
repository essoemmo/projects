 
 @if($errors->any())
 
    {{$all= implode('', $errors->all(':message')) }}
    @push('js')
        <script>
            Swal.fire({
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
            Swal.fire({
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
            Swal.fire({
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

 @if(Session::has('custom_message'))
     @push('js')
         <script>

             Swal.fire({
                 icon: 'error',
                 title: '{{_i('Oops...')}}',
                 text: "{{Session::get('custom_message')}}",
             })

         </script>
     @endpush

 @endif