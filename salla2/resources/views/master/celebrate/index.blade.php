@extends('master.layout.index',[
'title' => _i('celebrates'),
'subtitle' => _i('celebrates'),
'activePageName' => _i('celebrates'),
] )
<!-- ==============================Table Show=============================================-->
@section('content')

    <!-- Page-header start -->
{{--    <div class="page-header">--}}

{{--        <div class="page-header-breadcrumb">--}}
{{--            <ul class="breadcrumb-title">--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="javascript:void(0)">--}}
{{--                        <i class="icofont icofont-home"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item"><a href="#!">{{_i('celebrates')}}</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div style="clear:both;"></div>
    <!-- Page-header end -->
    <!-- Page-body start -->

    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-header">
                <h5>{{_i('celebrates')}}</h5>
            </div>
            <div class="card-block">
                <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="form-group">
                        <!-- Table -->
                        <table id="master_table" class="table table-bordered table-hover text-center">
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection




<!-- ==============================footer=============================================-->

@push('js')
    <script  type="text/javascript">
        /* Data table display*/
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#master_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('master/celebrates/all') }}",
                    type: 'GET',
                },
                // select: true,
                columns: [
                    {data: 'id', name: 'id' ,title:'id'},
                    {data: 'store_id', name: 'store_id',title:'store_id'},
                    // {data: 'language', name: 'language',title:'language'},
                    {data: 'action', name: 'action',title:'action' ,searchable: 'false'}
                ]
            });
        });
    </script>





@endpush
