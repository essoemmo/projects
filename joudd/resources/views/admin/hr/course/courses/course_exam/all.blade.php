@extends('admin.layout.layout')


@section('title')

    {{_i('Control In All Courses Exams')}}

@endsection


@section('box-title' , 'Courses Exams')


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Courses Exams')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="#">{{_i('Course Exams')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data Courses With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="exams-table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" > {{_i('ID')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Title')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Type')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Language')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;"> {{_i('Controll')}}</th>
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




@push('js')

    <script  type="text/javascript">

        $(function() {
            $('#exams-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course_exam/all/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'exam'},
                    {data: 'type', name: 'type'},
                    {data: 'lang_id', name: 'language'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endpush





