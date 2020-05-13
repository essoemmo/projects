@extends('admin.layout.layout')

@section('title')
    {{_i('Contacts ')}}
@endsection

@section('box-title' , 'Contacts ')

@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Contacts ')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/contact/all')}}">{{_i('All Contacts')}}</a></li>
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
                        <table id="contact_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" > {{_i('ID')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Name ')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('E-mail')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('Message Title')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('Sent Time')}}</th>
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
            $('#contact_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/contact/all/getDatatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection