@extends('admin.AdminLayout.index')

        <!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/adminpanel/product_type/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title_1" class="col-sm-4 control-label" >{{_i('Name')}}</label>

                <div class="col-sm-8">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('Product type Name')}}" data-parsley-length="[3, 150]">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description_1" class="col-sm-4 control-label" >{{_i('Description')}}</label>

                <div class="col-sm-8">
                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                    <textarea id="description_1"  class="form-control" name="description" placeholder="{{ _i('Product type Name')}}" ></textarea>
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
    <form  class="form-horizontal" action="{{url('/adminpanel/product_type/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="name" class="col-sm-4 control-label" >{{_i('Name')}}</label>

                <div class="col-sm-8">
                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('Product type Name')}}"
                           data-parsley-length="[3, 150]" required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group row">

                <label for="description" class="col-sm-4 control-label" >{{_i('Description')}}</label>

                <div class="col-sm-8">
                    <textarea id="description"  class="form-control" name="description"  placeholder="{{ _i('Product type Description')}}" ></textarea>
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
                    <h4 class="modal-title">{{_i('Edit Product Type')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add Product Type')}}</h4>
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

{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
{{--        <i class="fa fa-fw fa-plus-square"></i>--}}
{{--        {{_i(' Add New ')}} --}}
{{--    </button>--}}


<!-- Page-header start -->
<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('Product Types')}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">{{_i('Product Types')}}</a>
            </li>
        </ul>
    </div>
</div>
<!-- Page-header end -->
<!-- Page-body start -->
<div class="box-body">

    <div class="row">
        <div class="col-sm-12 mb-3">
            <span class="pull-left">

                <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default">
                    <span><i class="ti-plus"></i> {{_i('create new product type ')}} </span>
                </button>

                <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">
                    <span><i class="ti-printer"></i></span>
                </button>

            </span>
        </div>


        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Product Types')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        <table id="jobtypes_table" class="table table-bordered table-striped dataTable text-center">

                            <thead>
                                <tr role="row">
                                    <th class="sorting" >{{ _i('ID')}}</th>
                                    <th class="sorting" >{{ _i('Name')}}</th>
                                    <th class="sorting" >{{ _i('Created At')}}</th>
                                    <th class="sorting" >{{ _i('Action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

    <style>
        .table{
            display: table !important;
        }
    </style>
    @endsection


            <!-- ==============================Head=============================================-->
@section('title')

    {{_i('Product Types')}}

@endsection


@section('box-title')
    {{_i('Product Types')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Product Types')}}
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
                    ajax: '{{url('/adminpanel/product_type/get_datatable')}}',
                    columns: [
                        {data: 'id'},
                        {data: 'title'},
                        {data: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                }));

        /* initlizing edit form with id and values */
        function edit(id,title,description){
            console.log(id);
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#description_1').val(description);
        }
        $(function () {
            'use strict'
            $('#jobtypes_table_wrapper').find('.row').removeClass('row')
        })
    </script>

@endpush

