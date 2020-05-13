@extends('admin.layout.layout')

        <!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal form_edit" action=""  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-3 control-label " for="language_editform">
                    {{_i('Language')}}: </label>
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
            <!-- ================================== parent category =================================== -->
            <div class="form-group">

                <label for="cat_name" class="col-xs-3 control-label" >{{_i('Parent')}}:</label>

                <div class="col-xs-8">
                    <input type="hidden" id="parent_cat_1" name="country_id" value="">
                    <select class="form-control{{ $errors->has('parent_cat') ? ' is-invalid' : '' }}" id="cat_parent" name="parent_cat">
{{--                        <option selected disabled>{{_i('Choose Parent')}}</option>--}}
{{--                        @foreach($categories as $category)--}}
{{--                            <option value="{{$category->id}}"> {{$category->cat_name}}</option>--}}
{{--                        @endforeach--}}

                    </select>

                </div>
            </div>
            <!-- ================================== Title =================================== -->
            <div class="form-group">

                <label for="name" class="col-xs-3 control-label" >{{_i('Category Name')}}:</label>

                <div class="col-xs-8">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="cat_name" required="">

                    @if ($errors->has('cat_name'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cat_name') }}</strong>
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
    <form  class="form-horizontal" action="{{url('/admin/course/category/create')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-3 control-label " for="lang_id">
                    {{_i('Language')}}: </label>
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
            <div class="form-group">

                <label for="cat_name" class="col-xs-3 control-label" >{{_i('Parent')}}:</label>

                <div class="col-xs-8">

                    <select id="parent_cat_addform" class="form-control{{ $errors->has('parent_cat') ? ' is-invalid' : '' }}" name="parent_cat">

                    </select>

                </div>
            </div>

            <div class="form-group">

                <label for="cat_name" class="col-xs-3 control-label" >{{_i('Title')}}:</label>

                <div class="col-xs-8">
                    <input id="cat_name" type="text" class="form-control" name="cat_name"  placeholder="{{ _i('Category Name')}}"  >

                    @if ($errors->has('cat_name'))
                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cat_name') }}</strong>
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
                    <h4 class="modal-title">{{_i('Edit Course Category')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add Course Category')}}</h4>
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



    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-fw fa-plus-square"></i>
        {{_i('Add New')}} </button>
    @foreach($languages as $lang)
                <a href="{{ url('admin/translation/' . $translation->id . '?lang=' . $lang->id ) }}" target="_blank">
                    <button class="dt-button btn btn-default"  type="button">
                        <span><i class="fa fa-globe"></i> {{_("To")}} {{ $lang->title }}</span>
                    </button>
                </a>
            @endforeach
    <div class="box box-info box-body">

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover text-center" id="jobtypes_table">
                <thead><tr>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 30px;">{{ _i('ID')}}</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;">{{ _i(' Category Name')}}</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;">{{ _i('Language')}}</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;">{{ _i('Main Category')}}</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;">{{ _i('Action')}}</th>
                </tr>
                </thead></table>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection


            <!-- ==============================Head=============================================-->
@section('title')

    {{_i('Course Cartegory')}}

@endsection


@section('box-title' , _i('Course Cartegory'))


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Course Cartegory')}}
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
                    ajax: '{{url('/admin/course/category/all/get_datatable')}}',
                    columns: [
                        {data: 'id'},
                        {data: 'cat_name'},
                        {data: 'lang_id'},
                        {data: 'parent_id'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                }));

        /* initlizing edit form with id and values */
        function edit(id,cat_name,parent_id,lang_id){

            $('#id_1').val(id);
            $('#title_1').val(cat_name);
           // $('#cat_parent').val(parent_id);
            $('#language_editform').val(lang_id);
            $('#form_2').attr('action',id+'/edit');

            if( $(lang_id).val() == '' ) {
                $("#cat_parent").empty();
            }else{
                console.log(parent_id);
                $("#cat_parent").empty();
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/course/category/list')}}?lang_id="+lang_id,
                    dataType:'json',
                    success:function(res){
                        // console.log(res);
                        if(res){

                            $("#cat_parent").append('<option disabled selected>{{ _i('Choose Parent') }}</option>');
                            $.each(res,function(key,value){
                                $("#cat_parent").append('<option value="'+key+'">'+value+'</option>'); //cat_value
                            });
                            $('#cat_parent').val(parent_id);

                        }
                    }
                });
            }
        }

        // select add form
        $('#language_addform').click(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/course/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#parent_cat_addform").empty();
                            $("#parent_cat_addform").append('<option disabled selected>{{ _i('Choose Parent') }}</option>');
                            $.each(res,function(key,value){
                                $("#parent_cat_addform").append('<option value="'+key+'">'+value+'</option>'); //cat_value
                            });

                        }else{
                            $("#parent_cat_addform").empty();
                        }
                    }
                });
            }else{
                $("#parent_cat_addform").empty();
            }
        });

// edit form
      $('#language_editform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/course/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                       // console.log(res);
                        if(res){
                            $("#cat_parent").empty();
                            $("#cat_parent").append('<option disabled selected>{{ _i('Choose Parent') }}</option>');
                            $.each(res,function(key,value){
                                $("#cat_parent").append('<option value="'+key+'">'+value+'</option>'); //cat_value
                            });

                        }else{
                            $("#cat_parent").empty();
                        }
                    }
                });
            }
        });


    </script>

@endsection

