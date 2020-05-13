@extends('admin.layout.layout')

<!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/admin/education_level/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-3 control-label " for="language_editform">
                    {{_i('Language')}} </label>
                <div class="col-xs-8">
                    <select id="language_editform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                        <option disabled selected> {{_i('Choose')}}</option>
                        @foreach($languages as $language)
                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{$language->title}} </option>
                        @endforeach

                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                        @endif
                    </select>
                </div>
            </div>
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title_1" class="col-xs-3 control-label" >{{_i('Name ')}}</label>

                <div class="col-xs-8">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('education level Name')}}" data-parsley-length="[3, 150]">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== country =================================== -->
            <div class="form-group row">

                <label for="country_id" class="col-xs-3 control-label">{{_i('Country')}} </label>

                <div class="col-xs-8">
                    <input type="hidden" id="country_id_1" name="country_id" value="">
                    <select required class="form-control select2 select2-hidden-accessible" name="country_id" id="country_id_2" style="width:100%" aria-hidden="true">
{{--                        <option value="" disabled>{{_i('Choose')}}</option>--}}
{{--                        @foreach ($countries as $country)--}}
{{--                            <option value="{{$country->id}}">{{$country->title}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description_1" class="col-xs-3 control-label">{{_i('Description')}} </label>

                <div class="col-xs-8">
                    <textarea id="description_1" class="form-control" name="description"></textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

        </div>
        <!-- ================================Submit==================================== -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>
        </div>
    </form>
@endsection
<!-- ==============================Add Form=============================================-->
@section('job_type_form')
    <form  class="form-horizontal" action="{{url('/admin/education_level/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-3 control-label" for="language_editform">
                    {{_i('Language')}} </label>
                <div class="col-xs-8">
                    <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                        <option disabled selected> {{_i('Choose')}}</option>
                        @foreach($languages as $language)
                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{$language->title}} </option>
                        @endforeach

                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                        @endif
                    </select>
                </div>
            </div>
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="name" class="col-xs-3 control-label" >{{_i('Name ')}}</label>

                <div class="col-xs-8">
                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('education level Name')}}"
                           data-parsley-length="[3, 150]" required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== country =================================== -->
            <div class="form-group row">

                <label for="country_id" class="col-xs-3 control-label">{{_i('Country')}} </label>

                <div class="col-xs-8">
                    <select id="get_country" multiple class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="country_id[]" id="country_id">
{{--                        <option value selected disabled>{{_i('Choose')}}</option>--}}
{{--                        @foreach ($countries as $country)--}}
{{--                            <option value="{{$country->id}}">{{$country->title}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description_2" class="col-xs-3 control-label">{{_i('Description')}} </label>

                <div class="col-xs-8">
                   <textarea id="description_2" class="form-control" name="description">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

        </div>
        <!-- ================================Submit==================================== -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
        </div>
    </form>
@endsection
<!-- ==============================Edit Model=============================================-->
@section('jobtype_edit_model')
    <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Edit Education Level')}}</h4>
                </div>
                <div class="modal-body">
                    @yield('jobtype_edit_form')
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ==============================Add Model=============================================-->
@section('jobtype_add_edit_model')
    <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Add Education Level')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    @yield('job_type_form')
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- ==============================Table Show=============================================-->
@section('jobtype_show_model')

    <div class="box  box-body">

        <!-- /.box-header -->
        <div class="box-body  ">

            <div  id="dataTableBuilder_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="dt-buttons" style="padding-right: 330px;">
                    <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default">
                        <span><i class="fa fa-plus"></i> {{_i('create new education level ')}} </span>
                    </button>
{{--                    <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">--}}
{{--                        <span><i class="fa fa-print"></i></span>--}}
{{--                    </button>--}}
                </div>



                <table class="table table-hover text-center table table-bordered table-striped table-responsive dataTable" id="jobtypes_table">
                    <thead><tr>
                        <th class="sorting" >{{ _i('ID')}}</th>
                        <th class="sorting" >{{ _i('Name ')}}</th>
                        <th class="sorting" >{{ _i('Language')}}</th>
                        <th class="sorting" >{{ _i('Country')}}</th>
                        <th class="sorting" >{{ _i('Created At')}}</th>
                        <th class="sorting" >{{ _i('Action')}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection


<!-- ==============================Head=============================================-->
@section('title')

    {{_i('Education levels')}}

@endsection


@section('box-title')
    {{_i('Education levels')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Education levels')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>{{_i('Home')}}</a></li>
        </ol>
    </section>


@endsection

<!-- ==============================Main=============================================-->
@section('content')
    @yield('jobtype_edit_model')
    @yield('jobtype_add_edit_model')
    @yield('jobtype_show_model')

@endsection

<!-- ==============================footer=============================================-->

@section('footer')
    <script  type="text/javascript">

        /* Data table display*/
        $(document).ready(
            $("#jobtypes_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/education_level/get_datatable')}}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'lang_id'},
                    {data: 'country_id'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title,country_id,description,lang_id){
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#country_id_2').val(country_id).change();
            $('#description_1').val(description);
            $('#language_editform').val(lang_id);

            $.ajax({
                type:"GET",
                url:"{{url('admin/country/list')}}?lang_id="+lang_id,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#country_id_2").empty();
                        html += $("#country_id_2").append('<option disabled>{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            html += $("#country_id_2").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }else{
                        $("#country_id_2").empty();
                    }
                }
            });

        }


        //add form
        $('#language_addform').click(function(){
            var languageID = $(this).val();
            console.log(languageID);
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/country/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_country").empty();
                            $("#get_country").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_country").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_country").empty();
                        }
                    }
                });
            }else{
                $("#get_country").empty();
            }
        });


        // edit form
        $('#language_editform').click(function(){
            // var saved_lang = $("#saved_lang_id").val();
            var languageID = $(this).val();

            // var html = $("#country_id_2").append('<option selected> ' + cat + '</option>');
            $.ajax({
                type:"GET",
                url:"{{url('admin/country/list')}}?lang_id="+languageID,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#country_id_2").empty();
                        html += $("#country_id_2").append('<option disabled>{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            html += $("#country_id_2").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#country_id_2").empty();
                    }
                }
            });

        });
    </script>


    <script>
        $('.select2').select2()
    </script>

@endsection

