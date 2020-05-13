


@extends('admin.layout.layout')


@section('title')

    {{_i('Control In All Applicant Pendings')}}

@endsection


@section('box-title' )
    {{_i('All Applicant Pendings')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('All Applicant Pendings')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/course/applicant/create')}}">{{_i(' Add Applicant')}}</a></li>
            <li ><a href="{{url('/admin/course/applicant/pending/all')}}">{{_i(' All Applicants Pending')}}</a></li>
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
                    <div class="col-xs-12">
                        <table id="pendings-table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc"  > {{_i('Applicat Name')}}</th>
                                <th class="sorting_desc" > {{_i('Course Name')}}</th>
                                <th class="sorting_desc" > {{_i('Media Name')}}</th>
                                <th class="sorting_desc"> {{_i('Coupon')}}</th>
                                <th class="sorting_desc"  > {{_i('Cost')}}</th>
                                <th class="sorting_desc"  > {{_i('Amount')}}</th>
                                <th class="sorting_desc"  > {{_i('Is Paid')}}</th>
                                <th class="sorting_desc"  > {{_i('Created Time')}}</th>
                                <th class="sorting" > {{_i('Transaction No')}}</th>
                                <th class="sorting"   > {{_i('Transaction Type')}}</th>
                                <th class="sorting"  > {{_i('Nationality')}}</th>
                                <th class="sorting"  style="width: 120px; !important;" > {{_i('Controll')}}</th>
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

        $(function() { //'course_id', 'applicant_id', 'cost', 'amount', 'coupon_id', 'is_paid', 'created', 'transaction_id', 'transaction_type', 'nationality_id'
            $('#pendings-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/course/applicant/pending/datatable')}}',
                columns: [
                    {data: 'pid', name: 'pid'},
                    {data: 'first_name', name: 'applicants.first_name'},
                    {data: 'title', name: 'courses.title'},
                    {data: 'media', name: 'media'},
                    {data: 'code', name: 'discount_codes.code'},
                    {data: 'cost', name: 'applicant_course_pendings.cost'},
                    {data: 'amount', name: 'applicant_course_pendings.amount'},
                    {data: 'is_paid', name: 'applicant_course_pendings.is_paid'},
                    {data: 'created', name: 'applicant_course_pendings.created'},
                    {data: 'transaction_id', name: 'applicant_course_pendings.transaction_id'},
                    {data: 'transaction_type', name: 'applicant_course_pendings.transaction_type'},
                    {data: 'country_name', name: 'nationalities.country_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
//                columns: [
//                    {data: 'id', name: 'id'},
//                    {data: 'applicant_id', name: 'applicant_id'},
//                    {data: 'course_id', name: 'course_id'},
//                    {data: 'coupon_id', name: 'coupon_id'},
//                    {data: 'cost', name: 'cost'},
//                    {data: 'amount', name: 'amount'},
//                    {data: 'is_paid', name: 'is_paid'},
//                    {data: 'created', name: 'created'},
//                    {data: 'transaction_id', name: 'transaction_id'},
//                    {data: 'transaction_type', name: 'transaction_type'},
//                    {data: 'nationality_id', name: 'nationality_id'},
//                    {data: 'action', name: 'action', orderable: false, searchable: false}
//                ]
            });

        });




    </script>




@endsection
