@extends('admin.layout.layout')

<!-- <?php echo '<pre>';var_dump(session('flash_message')); ?> -->

        <!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/admin/course/bank_transfer/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== language =================================== -->
            <div class="form-group row" >
                <label class="col-xs-3 col-form-label " for="language_editform">
                    {{_i('Language')}} </label>
                <div class="col-xs-8">
                    <select id="lang_id_1" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

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

                <label for="title_1" class="col-xs-3 control-label" >{{_i('Program Name')}}</label>

                <div class="col-xs-8">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description_1" class="col-xs-3 control-label" >{{_i('Program Description')}}</label>

                <div class="col-xs-8">
                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                    <textarea id="description_1"  class="form-control" name="description"></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger invalid-feedback" role="alert">
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
    <form  class="form-horizontal" action="{{url('/admin/course/bank_transfer/add')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== language =================================== -->
            <div class="form-group row" >
                <label class="col-xs-3 col-form-label " for="language_editform">
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

                <label for="name" class="col-xs-3 control-label" >{{_i('Bank Name')}}</label>

                <div class="col-xs-8">
                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('Bank Name')}}"  required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description" class="col-xs-3 control-label" >{{_i('Bank Description')}}</label>

                <div class="col-xs-8">
                    <textarea id="description"  class="form-control" name="description"   ></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger invalid-feedback" role="alert">
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
                    <h4 class="modal-title">{{_i('Edit Bank Transfer')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add Bank Transfer')}}</h4>
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
    <div class="box box-info box-body">

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover text-center" id="jobtypes_table">
                <thead><tr>
                    <th class="sorting" >{{ _i('ID')}}</th>
                    <th class="sorting" >{{ _i('Bank Name')}}</th>
                    <th class="sorting" >{{ _i('Language')}}</th>
                    <th class="sorting" >{{ _i('Created At')}}</th>
                    <th class="sorting" >{{ _i('Action')}}</th>
                </tr>
                </thead></table>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection


            <!-- ==============================Head=============================================-->
@section('title')

    {{_i('Bank Transfers')}}

@endsection


@section('box-title')
    {{_i('Bank Transfers')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Bank Transfers')}}
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
                    ajax: '{{url('/admin/course/bank_transfer/get_datatable')}}',
                    columns: [
                        {data: 'id'},
                        {data: 'title'},
                        {data: 'lang_id'},
                        {data: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                }));

        /* initlizing edit form with id and values */
        function edit(id,title,description,lang_id){
            console.log(id);
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#description_1').val(description);
            $('#lang_id_1').val(lang_id);
        }

    </script>

@endsection

