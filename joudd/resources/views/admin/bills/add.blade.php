


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
    {{_i('Add bills')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Add bills')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/bills/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/bills/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-- ================================== user =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="user_id">
                            {{_i('user')}} </label>
                        <div class="col-xs-6">
                            <select id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{old('user_id') == $user->id ? 'selected' : '' }}> {{$user->first_name}} {{$user->last_name}} </option>
                                @endforeach

                                @if ($errors->has('user_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- ================================== amount =================================== -->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="amount">
                            {{_i('amount')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="amount" id="amount" required="" class="form-control">
                            @if ($errors->has('amount'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- ================================== language =================================== -->
                    <div class="form-group " >
                        <label class="col-xs-2 col-form-label " for="language_addform">
                            {{_i('Language')}} </label>
                        <div class="col-xs-6">
                            <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($langs as $language)
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

                    <!-- ================================== currency =================================== -->
                    <div class="form-group " >
                        <label class="col-xs-2 col-form-label " for="get_currency">
                            {{_i('Currency')}} </label>
                        <div class="col-xs-6">
                            <select required="" id="get_currency" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="currency_id" >

                            </select>
                            @if ($errors->has('currency_id'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('currency_id') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>

                    <!-- ================================== title =================================== -->

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


<!----==========================  link ==========================--->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="description">
                            {{_i('description')}} </label>
                        <div class="col-xs-6">
                            <textarea name="description" id="description" required="" class="form-control">
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
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
    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/currency/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_currency").empty();
                            $("#get_currency").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_currency").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_currency").empty();
                        }
                    }
                });
            }else{
                $("#get_currency").empty();
            }
        });

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
