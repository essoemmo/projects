



@extends('admin.layout.layout')


@section('title')

    {{_i('Control In All Trainers')}}

@endsection


@section('box-title')
    {{_i('Trainers')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Trainers')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/trainer/create')}}">{{_i('Add Trainer')}}</a></li>
            <li class="active"><a href="{{url('/admin/trainer/all')}}">{{_i('All Trainers')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="trainers-table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('First Name')}}</th>
                                <th class="sorting"> {{_i('Last Name')}} </th>
                                <th class="sorting"> {{_i('Skills')}}</th>
                                <th class="sorting"> {{_i('Gender')}}</th>
                                <th class="sorting"> {{_i('Status')}}</th>
                                <th class="sorting"> {{_i('Hiring Date')}}</th>
                                <th class="sorting"> {{_i('Controll')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('footer')
    <script  type="text/javascript">
        $(function() {
            $('#trainers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/trainer/all/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'skills', name: 'skills'},
                    {data: 'gender', name: 'gender'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection





