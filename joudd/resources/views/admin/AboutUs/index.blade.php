@extends('admin.layout.layout')

@section('content')
<section class="content">
        <div class="box box-info">
                <div class="box-body pad">
                <form action="{{route('save_aboutus')}}" method="GET">
                        <textarea id="editor1" name="editor1" rows="10" cols="80"  style="visibility: hidden; display: none;"></textarea> 
                        <button  type="submit" class="btn btn-block btn-success btn-lg">Save</button>                                   
                  </form>
                </div>
              </div>
@endsection

@section('footer')
<script>
        $(function () {
          CKEDITOR.replace('editor1')
          $('.textarea').wysihtml5()
        })
      </script>
@endsection