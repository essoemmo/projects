
@extends('admin.AdminLayout.index')

@section('title')
    {{_i('All Permissions')}}
@endsection


@section('page_header_name')
    {{_i('All Permissions')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
@endsection


@section('content')

    <div class="row">

        <div class="col-sm-12 mbl">
            <span class="pull-left">
                  <a href="{{url('adminpanel/permission/add')}}" data-toggle="modal" data-target="#create" class="btn btn-primary create add-permission">
                        <i class="ti-plus"></i>{{_i('create new permission')}}
                    </a>

            </span>
        </div>

        <div class="col-sm-12">

            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Permission List') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive text-center">
                        <table id="permission_table"  class="table table-striped table-bordered nowrap text-center">
                            <thead>
                            <tr role="row">
                                <th  > {{_i('ID')}}</th>
                                <th  > {{_i('Permission Name')}}</th>
                                <th  > {{_i('created_at')}}</th>
                                <th  > {{_i('updated_at')}}</th>
                                <th  > {{_i('Controll')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <!-- /.box-body -->


    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{_i('Permission Add')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{url('/adminpanel/permission/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                        @csrf
                        <div class="form-group row">

                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <label for="" class="col-md-12 col-form-label"> {{_i('Permission Name')}} </label>

                                <div class="col-md-12">
                                    <input type="text"  placeholder="Permission Name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required="" >
                                    @if ($errors->has('name'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

                            <button type="submit" class="btn btn-primary" >
                                {{_i('Add')}}
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{_i('Permission Edit')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editmodel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
                    <button type="button" class="btn btn-primary" id="editform">{{_i('Save')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection



@push('js')
    <script  type="text/javascript">

        $(function() {

            $('#permission_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/permission/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: true, searchable: true}

                ]
            });
        });

        $(document).ready(function () {

            $('body').on('click','.add-permission',function (e) {
                e.preventDefault();
            });


            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');


                var html = `<form  action="{{url('adminpanel/permission/update')}}" method="post" class="form-horizontal"  id="formedit" data-parsley-validate="">

            @csrf
                    {{method_field('put')}}
                    <input type='hidden' name='id' value=${id}>
                    <div class="box-body">
                        <div class="form-group row">
                            <label for="" class="col-md-12 col-form-label  "> {{_i('Permission Name')}} </label>

                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="${name}"  placeholder="Permission Name" required="" >
                        @if ($errors->has('name'))
                    <span class="text-danger invalid-feedback" >
                            <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                        @endif
                    </div>
                </div>
            </div>

                    </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);


            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })

        });



    </script>


@endpush

























