@extends('admin.AdminLayout.index')

<!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/adminpanel/settings/footer/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title_1" class="col-sm-2 control-label" > {{_i('Title')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('Footer Title')}}" data-parsley-length="[3, 191]">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>


            <!-- ================================== country =================================== -->
            <div class="form-group row">

                <label for="country_id" class="col-sm-2 control-label">{{_i('Category')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                    <input type="hidden" id="category_id_1" name="category_id" value="">
                    <select required="" class="form-control" name="category_id"  id="category_id_2" >
                        <option value="" disabled>{{_i('Choose')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================== link =================================== -->
            <div class="form-group row">

                <label for="link_1" class="col-sm-2 control-label" >{{_i('Link')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                     <input  class="form-control" id="link_1" name="link" maxlength="191"	data-parsley-maxlength="191"
                                type="url" data-parsley-type="url" required="">

                    @if ($errors->has('link'))
                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
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

    <form class="form-horizontal"  id="form_1" method="post" action="{{route('footer.store')}}"  data-parsley-validate="">
        @csrf

        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title" class="col-sm-2 control-label" >{{_i('Title')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" maxlength="191" data-parsley-maxlength="191" required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================== category =================================== -->
            <div class="form-group row">

                <label for="category_id" class="col-sm-2 control-label">{{_i('Category')}} <span style="color: #db1b4c"> * </span> </label>

                <div class="col-sm-10">

                    <select required="" class="form-control" name="category_id" id="category_id">
                        <option value="" disabled>{{_i('Choose')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================== link =================================== -->
            <div class="form-group row">

                <label for="link" class="col-sm-2 control-label" >{{_i('Link')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                                <input  class="form-control" id="link" name="link" maxlength="191"	data-parsley-maxlength="191"
                                          type="url" data-parsley-type="url" required="">{{old('link')}}

                    @if ($errors->has('link'))
                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================Submit==================================== -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
            </div>

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
                    <h4 class="modal-title">{{_i('Edit Footer')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add Footer')}}</h4>
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

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.AdminLayout.message')
            <div  id="dataTableBuilder_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="dt-buttons" style="padding-right: 330px;">
                    <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default">
                        <span><i class="ti-plus"></i> {{_i('create new footer ')}} </span>
                    </button>
                    <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">
                        <span><i class="ti-printer"></i></span>
                    </button>
                </div>



                <table class="table table-hover text-center table table-bordered table-striped table-responsive dataTable" id="jobtypes_table">
                    <thead><tr>
                        <th class="sorting" >{{ _i('ID')}}</th>
                        <th class="sorting" >{{ _i('Title')}}</th>
                        <th class="sorting" >{{ _i('Link')}}</th>
                        <th class="sorting" >{{ _i('Category')}}</th>
                        <th class="sorting" >{{ _i('Created At')}}</th>
                        <th class="sorting" >{{ _i('Action')}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection


<!-- ==============================Head=============================================-->
@section('title')

    {{_i('Footers')}}

@endsection

@section('page_header_name')
    {{_i('Footers')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="ti-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/settings/footer/all')}}">{{_i('Footers')}}</a></li>
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
                ajax: '{{url('/adminpanel/settings/footer/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'link', name: 'link'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title,link,category_id){
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#link_1').val(link);
            $('#category_id_2').val(category_id).change();

        }

    </script>
    <style>
        .table{
            display: table !important;
        }

        .row,#jobtypes_table_wrapper{
            width: 100% !important;
        }
    </style>

@endpush

