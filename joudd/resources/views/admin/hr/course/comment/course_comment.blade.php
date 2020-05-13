@extends('admin.layout.layout')

@section('title')
    {{_i('Courses Comments')}}
@endsection

@section('box-title' , 'Courses Comments')

@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Courses Comments')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/course_comment/all')}}">{{_i('All Comments')}}</a></li>
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
                        <table id="comments-table" class="table table-bordered table-striped table-responsive text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('course Name')}}</th>
                                <th class="sorting_desc" > {{_i('Applicant Name')}}</th>
                                <th class="sorting_desc" > {{_i('Applicant Email')}}</th>
                                <th class="sorting_desc" > {{_i('Status')}}</th>
                                <th class="sorting" > {{_i('Send Time')}}</th>
                                <th  > {{_i('Action')}}</th>
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
            $('#comments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course_comment/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'course_id', name: 'course_id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'approve', name: 'approve'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>

@endsection





