



@extends('admin.layout.layout')


@section('title')

    {{_i('Control In Pending Trainers')}}

@endsection


@section('box-title')
    {{_i('Pending Trainers')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Pending Trainers')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/trainer/create')}}">{{_i('Add Trainer')}}</a></li>
            <li class="active"><a href="{{url('/admin/trainer/all')}}">{{_i('Pending Trainers')}}</a></li>
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
                ajax: '{{url('/admin/trainer/all/pendingTrainersDatatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ],
                initComplete:function(){
                    $('.change_status').on('click', function (e) {
                        var table = $('#trainers-table').DataTable();
                        var trainer_id = $(this).children('#trainer_id').val();
                        console.log(trainer_id);
                        $.ajax({
                            url: "{{ url('/admin/trainer/') }}/" + trainer_id + "/change",
                            DataType:'json',
                            type:'get',
                            success:function (res) {
                                table.ajax.reload();
                            }
                        })
                    });
                }
            });
        });
    </script>


@endsection

@push('js')

    <script>
        $(function () {
            $('.change_status').on('click', function (e) {
                console.log('clicked');
                // var table = $('#trainers-table').DataTable();
                // var trainer_id = $(this).children('#trainer_id').val();
                // console.log(trainer_id);
                // $.ajax({
                //     url:'/admin/trainer/' + trainer_id + '/change',
                //     DataType:'json',
                //     type:'get',
                //     success:function (res) {
                //         table.ajax.reload();
                //     }
                // })
            });
        })
    </script>

@endpush





