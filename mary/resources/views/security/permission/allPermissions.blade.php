@extends('admin.index')


@section('title', 'All Permission')

@section('page_header_name' , 'All Permissions')


{{--@section('page_url')--}}
{{--    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>--}}
{{--    <li><a href="{{url('/admin/permission/add')}}">{{_i('Add')}}</a></li>--}}
{{--    <li class="active"><a href="{{url('/admin/permission/index')}}">{{_i('All')}}</a></li>--}}
{{--@endsection--}}


@section('content')
    <div class="box box-info">

        <div class="box-header">
            {{--<h3 class="box-title">Data Permissions With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{url('admin/permission/add')}}" data-toggle="modal" data-target="#create" class="btn btn-primary create add-permission"><i class="fa fa-plus"></i>{{_i('add')}}</a>
                </div>
            </div>
                <div class="row">
                <div class="col-sm-12">
                    <table id="permission_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
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
        <!-- /.box-body -->
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{url('/admin/permission/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

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

                            <!------ guard name ---------------->
                            {{--                       <div class="form-group row">--}}
                            {{--                           <label for="" class="col-xs-3 col-form-label"> {{_i('Guard Name')}} </label>--}}

                            {{--                           <div class="col-xs-6">--}}
                            {{--                               <select id="user_id" class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}" name="guard_name" required="">--}}
                            {{--                                   <option disabled selected> {{_i('Choose')}} </option>--}}
                            {{--                                   <option value="{{$guard_admin}}" {{old('guard_name') == $guard_admin ? 'selected' : ''}} > {{_i('Admin')}} </option>--}}
                            {{--                                   <option value="{{$guard_web}}" {{old('guard_name') == $guard_web ? 'selected' : ''}} > {{_i('Web')}} </option>--}}
                            {{--                                   <option value="{{$guard_store}}" {{old('guard_name') == $guard_store ? 'selected' : ''}} > {{_i('Store')}} </option>--}}
                            {{--                               </select>--}}
                            {{--                           </div>--}}
                            {{--                       </div>--}}


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="submit" class="btn btn-info" >
                                {{_i('Add')}}
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary" id="add">Save</button>--}}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editmodel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editform">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection



@section('footer')
    <script  type="text/javascript">

        $(function() {
            $('#permission_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/permission/get_datatable')}}',
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


                var html = `<form  action="{{url('admin/permission/update')}}" method="post" class="form-horizontal"  id="formedit" data-parsley-validate="">

            @csrf
                    {{method_field('put')}}
                    <input type='hidden' name='id' value=${id}>
                    <div class="box-body">
                        <div class="form-group row">
                            <label for="" class="col-md-12 col-form-label text-md-right "> {{_i('Permission Name')}} </label>

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


@endsection

























