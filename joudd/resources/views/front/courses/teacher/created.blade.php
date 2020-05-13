@extends('front.layout.app')
@section('box-title' , 'Courses')
@section('content')

        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-info text-center" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @elseif(Session::has('danger'))
            <br />
            <h6 class="alert alert-danger text-center" > <b>   {{ Session::get('danger') }} </b></h6>
        @endif


<div class="single-course-page after-enroll-page pt-5">
        <div class="container">
    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data Courses With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="trainers-table" class="table table-bordered table-striped dataTable text-center" role="grid">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc"  > {{_i('Title')}}</th>
{{--                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Trainer')}}</th>--}}
                                <th class="sorting" > {{_i('Start Date')}}</th>
                                <th class="sorting" > {{_i('End Date')}}</th>
                                <th class="sorting" > {{_i('Duration')}}</th>
                                <th class="sorting" > {{_i('Cost')}}</th>
                                <th class="sorting" > {{_i('Is Active ')}}</th>
                                <th class="sorting" > {{_i('Created At')}}</th>
                                <th class="sorting" > {{_i('Updated At')}}</th>
                                <th class="sorting"  style="width: 170px;"> {{_i('Controll')}}</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
        </div>
</div>

@endsection

@if(request()->is('user/created'))
@section('script')

    <script  type="text/javascript">

        $(function() {
            $.noConflict();
            $('#trainers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/user/myCourses/get_user_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    // {data: 'trainer', name: 'trainer'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'duration', name: 'duration'},
                    {data: 'cost', name: 'cost'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                   {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection
@endif

@if(request()->is('user/pending'))
@section('script')

    <script  type="text/javascript">

        $(function() {
            $.noConflict();
            $('#trainers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/user/myCourses/get_user_pendingCourse_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    // {data: 'trainer', name: 'trainer'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'duration', name: 'duration'},
                    {data: 'cost', name: 'cost'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection
@endif




