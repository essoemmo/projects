@extends('admin.layout.layout')

@section('title')
    {{_i('Courses Ratings')}}
@endsection

@section('box-title' )
    {{_i('Courses Ratings')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Courses Ratings')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/country/create')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    @push('css')
        <style>
            .star-ratings-css {
                unicode-bidi: bidi-override;
                color: #c5c5c5;
                font-size: 25px;
                height: 25px;
                width: 100px;
                margin: 0 auto;
                position: relative;
                padding: 0;
                text-shadow: 0px 1px 0 #a2a2a2;
            }
            .star-ratings-css-top {
                color: #106E9F;
                padding: 0;
                position: absolute;
                z-index: 1;
                display: block;
                top: 0;
                right: 0;
                overflow: hidden;
            }
            .star-ratings-css-bottom {
                padding: 0;
                display: block;
                z-index: 0;
            }
            .star-ratings-sprite {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                font-size: 0;
                height: 21px;
                line-height: 0;
                overflow: hidden;
                text-indent: -999em;
                width: 110px;
                margin: 0 auto;
            }
            .star-ratings-sprite-rating {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                background-position: 0 100%;
                float: left;
                height: 21px;
                display: block;
            }

        </style>
    @endpush

    <div class="box box-info">

        <div class="box-header">

        </div>

        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="country_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting text-center"  > {{_i('ID')}}</th>
                                <th class="sorting text-center"  > {{_i('Course')}}</th>
                                <th class="sorting text-center"  > {{_i('Ratings')}}</th>
                                <th class="sorting text-center"  > {{_i('Status')}}</th>
                                <th class="sorting text-center"  > {{_i('User')}}</th>
                                <th class="sorting text-center"  > {{_i('Rate Time')}}</th>
                                <th class="sorting text-center"  > {{_i('Action')}}</th>
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
            $('#country_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/rating/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'course', name: 'course'},
                    {data: 'rating', name: 'rating'},
                    {data: 'approve', name: 'approve'},
                    {data: 'user_email', name: 'user_email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'},
                ]
            });
        });


    </script>

@endsection