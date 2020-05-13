


@extends('admin.layout.layout')


@section('title')

    {{_i('Applicants')}}

@endsection


@section('box-title' , 'Roles')


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Applicants')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>  {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/course/applicant/create')}}">  {{_i('Add Applicant')}}</a></li>
            <li class="active"><a href="{{url('/admin/course/applicant/all')}}">  {{_i('Applicants')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">

        </div>

        <form  action="" class="form-horizontal"  id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">

                <div class="row">
                    <!--========================================== course name =======================================-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 control-label" >{{ _i(' Course Name :') }}</label>

                        <div class="col-md-3">

                            <select class="form-control" id="course_select_id" name="course_id" onchange="search()" >
                                <option value="0">{{_i("All")}}</option>
                                @foreach($courses as  $course)
                                    <option  value="{{$course->id}}" > {{$course->title}} </option>
                                @endforeach

                                @if ($errors->has('title'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title')}}</strong>
                                </span>
                                @endif

                            </select>

                        </div>

                        <!--========================================== education level =======================================-->
                        <label for="name" class="col-md-3 control-label" >{{ _i('Education levels') }}</label>

                        <div class="col-md-3">

                            <select class="form-control" id="education_ID"  onchange="search_educationLevel()" >
                                <option value="0">{{_i("All")}}</option>
                                @foreach($education_levels as  $item)
                                    <option  value="{{$item->id}}" > {{$item->title}} </option>
                                @endforeach
                            </select>
                    </div>

                </div>

            </div>


        </form>

        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="applicant-table" class="table table-bordered table-striped dataTable text-center">
                            <thead>
                            <tr role="row">
                                <th>  {{_i('ID')}}</th>
                                <th>  {{_i('First Name')}}</th>
                                <th>  {{_i('Last Name')}}</th>
                                <th>  {{_i('Email')}} </th>
                                <th>  {{_i('Is Added By Admin')}} </th>
{{--                                <th>  {{_i('Phone')}} </th>--}}
                                <th>  {{_i('Address')}} </th>
                                <th>{{_i('Is Active ')}} </th>
                                <th>{{_i('Action')}}</th>
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

        var table;
        function search()
        {
        var id = $("#course_select_id").val();

         $("#applicant-table").dataTable().fnDestroy();

        $('#applicant-table').DataTable({
        processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course/applicant/ajax_search')}}?course_id='+id,
                columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                 {data: 'website', name: 'website'},
                // {data: 'mobile', name: 'mobile'},
                {data: 'address', name: 'address'},
                        //                    {data: 'dob', name: 'dob'},
                        {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
        });
       // table.draw();
        }

        function search_educationLevel()
        {
            var education_level_id = $("#education_ID").val();
            console.log(education_level_id);

            $("#applicant-table").dataTable().fnDestroy();

            $('#applicant-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course/applicant/ajax_search')}}?education_level='+education_level_id,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'website', name: 'website'},
                    {data: 'address', name: 'address'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
            // table.draw();
        }

        $(function () {
        $('#applicant-table').DataTable({
        processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course/applicant/get_datatable')}}',
                columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'website', name: 'website'},
                // {data: 'mobile', name: 'mobile'},
                {data: 'address', name: 'address'},
                        //                    {data: 'dob', name: 'dob'},
                        {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
        });
        });

    </script>

@endsection





