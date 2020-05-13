@extends('front.layout.app')

@section('content')

    @if(Session::has('flash_message'))
        <br />
        <h6 class="alert alert-info text-center" > <b>   {{ Session::get('flash_message') }} </b></h6>
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
                            <div class="col-md-12">
                                <table id="exams-table" class="table table-bordered table-striped dataTable text-center" role="grid">
                                    <thead>
                                    <tr role="row" >
                                        <th class="sorting" > {{_i('ID')}}</th>
                                        <th class="sorting"  > {{_i('Title')}}</th>
                                        <th class="sorting"  > {{_i('Exam')}}</th>
                                        <th class="sorting"  > {{_i('Language')}}</th>
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
        </div>
    </div>

@endsection


@push('js')

    <script  type="text/javascript">

        $(function() {
            $.noConflict();
            $('#exams-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/user/course_exam/all/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'exam'},
                    {data: 'type_id', name: 'course'},
                    {data: 'lang_id', name: 'language'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endpush





