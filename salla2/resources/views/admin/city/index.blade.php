@extends('admin.AdminLayout.index')

@push('css')

    <style>
        .table{
            display: table !important;
        }
    </style>

@endpush

<!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/adminpanel/city/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title_1" class="col-sm-3 control-label" >{{_i('Name')}}</label>

                <div class="col-sm-8">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('City Name')}}" data-parsley-length="[3, 150]">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== country =================================== -->
            <div class="form-group row">

                <label for="country_id" class="col-sm-3 control-label">{{_i('Country')}} </label>

                <div class="col-sm-8">
                    <input type="hidden" id="country_id_1" name="country_id" value="">
                    <select required class="form-control select2 select2-hidden-accessible" name="country_id" id="country_id_2" style="width:100%" aria-hidden="true">
                        <option value="" disabled>{{_i('Choose')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->title}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
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
    <form  class="form-horizontal" action="{{url('/adminpanel/city/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="name" class="col-sm-3 control-label" >{{_i('Name')}}</label>

                <div class="col-sm-8">
                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('City Name')}}"
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

                <label for="country_id" class="col-sm-3 control-label">{{_i('Country')}} </label>

                <div class="col-sm-8">
                    <select required="" class="form-control select2" style="width:100%" aria-hidden="true" name="country_id" id="country_id">
                        <option value selected disabled>{{_i('Choose')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->title}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
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
                    <h4 class="modal-title">{{_i('Edit City')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add City')}}</h4>
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

    <!-- Page-header start -->
    <div class="page-header">

        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Cities')}}</a>
                </li>
            </ul>
        </div>
    </div>

    <div style="clear:both;"></div>
    <!-- Page-header end -->
    <!-- Page-body start -->

    <style>
        .table{
            width: 145% !important;
        }
    </style>
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-header">
                <h5>{{_i('Cities')}}</h5>
            </div>
            <div class="card-block">
                <div class="dt-buttons" style="float: right;margin-top: -64px;margin-right: 421px;">
                    <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default">
                        <span><i class="ti-plus"></i> {{_i('create new city ')}} </span>
                    </button>
                    <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">
                        <span><i class="ti-printer"></i></span>
                    </button>
                </div>
            <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap">
                <table class="table table-bordered table-striped table-responsive text-center" id="jobtypes_table">
                    <thead><tr>
                        <th class="sorting" >{{ _i('ID')}}</th>
                        <th class="sorting" >{{ _i('Name')}}</th>
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
    </div>
@endsection


<!-- ==============================Head=============================================-->
@section('title')

    {{_i('Cities')}}

@endsection


@section('box-title')
    {{_i('Cities')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Cities')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i>{{_i('Home')}}</a></li>
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

@push('js')
    <script  type="text/javascript">

        /* Data table display*/
        $(document).ready(
            $("#jobtypes_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/city/get_datatable')}}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'country_id'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // { data:'delete',name:'delete'}
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title,country_id){
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#country_id_2').val(country_id).change();
        }

    </script>


    <script>
        $('.select2').select2()
    </script>

    <style>

    .table {
         width: 100% !important;
    }

    .dataTables_length{

    float: right;
    margin-top: -67px;
    margin-right: -261px;

    }


    .dataTables_filter{
        margin-top: -65px;
    }

    </style>

@endpush
