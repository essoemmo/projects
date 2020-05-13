
@extends('admin.layout.layout')

@section('title')
    {{_i('Online Orders')}}
@endsection

@section('box-title' )
    {{_i('Online Orders')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Online Orders')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/orders/online/all')}}">{{_i('All')}}</a></li>
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
                    <div class="col-sm-12">
                        <table id="article_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting text-center"  > {{_i('ID')}}</th>
                                <th class="sorting_desc center"  > {{_i('User Name')}}</th>
                                <th class="sorting_desc center"  > {{_i('Transaction Type')}}</th>
                                <th class="sorting_desc center"  > {{_i('Holder Name')}}</th>
                                <th class="sorting_desc center"  > {{_i('Card No')}}</th>
                                <th class="sorting_desc center"  > {{_i('Total')}}</th>
                                <th class="sorting_desc center"  > {{_i('Title')}}</th>
{{--                                <th class="sorting_desc center"  > {{_i('Currency')}}</th>--}}
                                <th class="sorting_desc center"  > {{_i('Status')}}</th>
                                <th class="sorting_desc center"  > {{_i('Time')}}</th>
                                <th class="sorting_desc center"  > {{_i('Action')}}</th>
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
            $('#article_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/orders/online/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'holder_name', name: 'holder_name'},
                    {data: 'holder_card_number', name: 'holder_card_number'},
                    {data: 'total', name: 'total'},
                    {data: 'course', name: 'course'},
                    // {data: 'currency', name: 'currency'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'delete', name: 'delete'},
                ]
            });
        });

    </script>
@endsection