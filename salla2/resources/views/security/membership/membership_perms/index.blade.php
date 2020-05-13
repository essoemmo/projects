

@extends('admin.AdminLayout.index')


@section('title')

    {{_i('Control In All Volunteers')}}

@endsection


@section('box-title' )
    {{_i('Volunteers')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Volunteers')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/adminpanel/volunteer/create')}}">{{_i('Add Volunteer')}}</a></li>
            <li class="active"><a href="{{url('/adminpanel/volunteer/all')}}">{{_i('All Volunteers')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">


        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="volunteers-table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('Membership Name')}}</th>
                                <th class="sorting_desc" > {{_i('Price')}}</th>
                                <th class="sorting_desc" > {{_i('Duration')}}</th>
                                <th class="sorting_desc" > {{_i('Is Active')}}</th>

                                <th class="sorting"> {{_i('Created At')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
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
            $('#volunteers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/membership/membership_perms/datatable')}}',
                columns: [
                    {data: 'mp', name: 'mp'},
                    {data:'title', name: 'title'},
                    {data:'price', name: 'price'},
                    {data:'duration', name: 'duration'},
                    {data:'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'membership_perms.created_at'},
//
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>

@endsection





