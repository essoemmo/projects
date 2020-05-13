

@extends('admin.layout.layout')

@section('title')
    {{_i('All bills')}}
@endsection

@section('page_header_name')
    {{_i('All bills')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('All bills')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/bills/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data Rolles With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="gallery_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" > {{_i('ID')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Title')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('amount')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('user')}}</th>
{{--                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('created')}}</th>--}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('status')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" > {{_i('Controll')}}</th>
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
            $('#gallery_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/bills/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'total', name: 'total'},
                    {data: 'user_id', name: 'user_id'},
                    // {data: 'created', name: 'created'},
                    {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection
