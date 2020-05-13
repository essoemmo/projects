@if(Session::has('flash_message'))
    <div class="container">

        <br>
        <div class=" alert alert-success" id="mes">
            <strong> تم  </strong>{{Session::get('flash_message')}} <strong> !  </strong>
        </div>
        

    </div>



@endif


@if($errors->has('password'))

    <div class="container">

        <br>
         <span class="text-danger invalid-feedback" role="alert">
               <strong>{{ $errors->first('password') }}</strong>
         </span>

    </div>



@endif
