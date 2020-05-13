


@extends('admin.layout.layout')

@section('title')
        {{_i('Add Gallery')}}
@endsection

@section('header')
{{--<!-- Select2 -->--}}
{{--<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">--}}

        <!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
@endsection

@section('page_header_name')
    {{_i('Add Gallery')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Add Gallery')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/gallery/all')}}">{{_i('All')}}</a></li>
            <li class="active"><a href="{{url('/admin/gallery/create')}}">{{_i('Add')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/gallery/create')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- ================================== language =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="lang_id">
                            {{_i('Language')}} </label>
                        <div class="col-xs-6">
                            <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                                @endforeach

                                @if ($errors->has('lang_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

<!----==========================  link ==========================--->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="link">
                            {{_i('Link')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="href" id="link" required="" class="form-control">
                            @if ($errors->has('href'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('href') }}</strong>
                            </span>
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
                            <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" >
                        </label>

                     </div>

                    </div>


                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label">{{_i('Photo')}}</label>
                        <div class="col-xs-5">
                            <input type="file" name="file" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">

                            @if ($errors->has('file'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @endif
                        </div>
                        <!-- Photo -->
                        <img class="img-responsive pad" id="course_img" hidden style="margin-top: -150px; margin-left:70%; margin-bottom: -1%;">
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Add')}}
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