
@extends('admin.layout.index',[
'title' => _i('Product Ratings'),
'subtitle' => _i('Product Ratings'),
'activePageName' => _i('Product Ratings'),
'additionalPageUrl' => url('/admin/panel/rating/all') ,
'additionalPageName' => _i('All'),
] )
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

    <div class="row">
        <div class="col-sm-12 mbl">
            {{--        <span class="pull-right">--}}
            {{--            <a href="{{ route("manufacturers.create") }}" class="btn btn-primary">{{ _i('Add Manufacturer') }}</a>--}}
            {{--        </span>--}}
        </div>

        <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="box-title">{{ _i('Product Rating List') }}</h5>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive text-center">
            <table id="rate_table" class="table table-striped table-bordered nowrap text-center" >
                <thead>
                <tr>
                    <th>{{_i('ID')}}</th>
                    <th>{{_i('Name')}}</th>
                    <th>{{_i('Email')}}</th>
                    <th>{{_i('Phone')}}</th>
                    <th>{{_i('Country')}}</th>
                    <th>{{_i('Sent Time')}}</th>
                    <th>{{_i('Controll')}}</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection

@push('js')
    <script  type="text/javascript">

        $(function() {
            $('#rate_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/rating/datatable')}}',
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

@endpush