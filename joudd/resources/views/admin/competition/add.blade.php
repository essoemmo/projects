


@extends('admin.layout.layout')

@section('title')
        {{_i('Add competition')}}
@endsection

@section('header')
{{--<!-- Select2 -->--}}
{{--<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">--}}

        <!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
@endsection

@section('page_header_name')
    {{_i('Add competition')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Add competition')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/competition/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/competition/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-- ================================== exam =================================== -->
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"> {{_i('title')}} </label>

                        <div class="col-xs-6">
                            <input type="text" name="title" class="form-control" required="">
                            @if($errors->has('title'))
                                <strong>{{$errors->first('title')}}</strong>
                            @endif
                        </div>
                    </div>


                    <!-- ============================================= sart date ============================= -->
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"> {{_i(' Start Date :')}} </label>

                        <div class="col-xs-6">
                            <input type="datetime-local" name="start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                            @if($errors->has('start'))
                                <strong>{{$errors->first('start')}}</strong>
                            @endif
                        </div>
                    </div>

                    <!--========================================== end Date =======================================-->
                    <div class="form-group">

                        <label for="name" class="col-xs-2 control-label"> {{_i(' End Date :')}} </label>

                        <div class="col-xs-6">
                            <input type="datetime-local" name="end" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                            @if($errors->has('end'))
                                <strong>{{$errors->first('end')}}</strong>
                            @endif
                        </div>
                    </div>

                    <!----==========================  published ==========================--->
                    <!-- iCheck -->

                    <!-- checkbox -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="checkbox">
                            {{_i('Publish')}}
                        </label>
                        <div class="col-xs-6">

                            <label>
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="is_active" value="1" >
                            </label>

                        </div>

                    </div>




                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>




@endsection

@section('footer')
    <script type="text/javascript">
        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#course_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }


    </script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
    {{--<!-- Select2 -->--}}
    {{--<script src="{{url('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>--}}
    {{--<script>--}}
        {{--$(function () {--}}
            {{--//Initialize Select2 Elements--}}
            {{--$('.select2').select2()})--}}
    {{--</script>--}}
    <script>

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    </script>
@endsection
