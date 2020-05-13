 <?php
 //dd(session()->all());
 $all_errors ="";
 ?>
@if ($errors->any())

    
            @foreach ($errors->all() as $error)
             
              <?php
              $all_errors .=$error."<br/>";
              ?>
            @endforeach
       
      @push("js")
        <script>
        new Noty({
            type: 'error',
            layout: 'center',
            theme: 'semanticui',
            text: "<?= $all_errors ?>",
            timeout: 5000,
            killer: true
        }).show();
    </script>
    @endpush
    @endif
   @if(Session::has('success'))
   <div class="row">
       <div class="col-md-12">
    <div class="alert alert-success">{{Session::get("success")}}</div>
    </div></div>
   @push("js")
        <script>
        new Noty({
            type: 'success',
            layout: 'center',
            theme: 'semanticui',
            text: "{{Session::get("success")}}",
            timeout: 5000,
            killer: true
        }).show();
    </script>
    @endpush
    @endif
   @if(Session::has('error'))
   <div class="row">
       <div class="col-md-12">
    <div class="alert alert-danger">{{Session::get("error")}}</div>
    </div></div>
    @push("js")
        <script>
        new Noty({
            type: 'error',
            theme: 'semanticui',
            layout: 'center',
            text: '{{Session::get("error")}}',
            timeout: 5000,
            killer: true
        }).show();
    </script>
    @endpush
    @endif