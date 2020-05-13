



@extends('admin.layout.layout')


@section('title')

    {{_i('Trainers Reports')}}

@endsection


@section('box-title')
    {{_i('Trainers Reports')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Trainers Reports')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/trainer/create')}}">{{_i('Add Trainer')}}</a></li>
            <li class="active"><a href="{{url('/admin/trainer/all')}}">{{_i('All Trainers')}}</a></li>
            <li class="active"><a href="{{url('/admin/trainer/report')}}">{{_i('Trainers Reports')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <!-- /.box-header -->
        <div class="box-body">

            <!--=============================== gender====================================-->
            <div class="form-group row">
                <label for="gender_selected_type" class="col-xs-1 control-label">{{_i(' Gender :')}}</label>
                <div class="col-xs-4">
                    <select class="form-control" id="gender_selected_type" name="gender"  onchange="search()">
                        <option value="" disabled selected>{{_i('Choose')}}</option>
                        <option value="Male">{{_i('Male')}}</option>
                        <option value="Female">{{_i('Female')}}</option>
                    </select>
                </div >

                <div class="col-xs-2">
                </div>
                <!--=============================== Hiring Date ====================================-->
                <div class="form-group row">
                    <label for="hiring_date" class="col-xs-2 control-label">{{_i('Date of hiring :')}}</label>
                    <div class="col-xs-3">
                        <input id="hiring_date" class="form-control" placeholder="Date of Hiring"
                               type="date"   data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" name="created_at"  onchange="date_search()" >

                    </div >

                </div>

            </div>


        </div>
        </div>

        <div class="box-footer">
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
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

                <div class="box-footer clearfix">
                    <div class="pull-left">
                        <a  >
                            <button type="button" class="btn btn-success " id="print">{{_i('Print')}}</button>
                        </a>

                        <form  action="{{url('/admin/trainer/export')}}" method="post" class="inline" >
                            @csrf
                            <button type="submit" class="btn btn-warning ">{{_i('Export ')}}</button>
                            <input type="hidden" name="txt_gender" id="txt_gender" />
                            <input type="hidden" name="txt_date" id="txt_date" />
                        </form>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.box-body -->



@endsection




@section('footer')

    <script  type="text/javascript">

        var table;
        $(function() {
            table =$('#trainers-table').DataTable({
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

                    ]
                });
        });

        function search() {
            var gender = $('#gender_selected_type').val();
            $("#txt_gender").val(gender);

            $("#trainers-table").html("");
            table.destroy();

            table = $('#trainers-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{url('/admin/trainer/all/get_datatable')}}?gender="+gender,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'skills', name: 'skills'},
                    {data: 'gender', name: 'gender'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        }
        function date_search() {
            var date = $('#hiring_date').val();
            $("#txt_date").val(date);

            $("#trainers-table").html("");
            table.destroy();

            table = $('#trainers-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{url('/admin/trainer/all/get_datatable')}}?date="+date,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'skills', name: 'skills'},
                    {data: 'gender', name: 'gender'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        }

    </script>

    <script>

        $('#print').click(function(){
            var printme = document.getElementById('trainers-table');
            var wme = window.open("","","width=900,height=600");
            wme.document.write(printme.outerHTML);
            wme.document.close();
            wme.focus();
            wme.print();
            wme.close();
        });

    </script>

@endsection





