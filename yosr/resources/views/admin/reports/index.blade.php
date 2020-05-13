@extends('admin.layout.master')
@section('content')

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">التقارير</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="table-responsive">
                    <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <select class="form-control search" name="day" id="day">
                                        <option value=" ">البحث باليوم</option>
                                        @for($i =1 ; $i<= 31 ; $i++ )
                                        <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    <select class="form-control search" name="month" id="month">
                                        <option value=" ">البحث بالشهر</option>
                                        @for($m =1 ; $m<= 12 ; $m++ )
                                            <option value="{{$m}}">{{$m}}</option>
                                        @endfor
                                    </select>
                                    <select class="form-control search" name="year" id="year">
                                        <option value=" ">البحث بالسنة</option>
                                        @for($y =2019 ; $y <= date('Y') ; $y++ )
                                            <option value="{{$y}}">{{$y}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <br>
{{--                                <a href="{{route('uploads.create')}}" style="float: left" class="btn btn-info btn-sm">--}}
{{--                                    <i class="fa fa-plus"></i>--}}
{{--                                    اضافة جديد--}}
{{--                                </a>--}}

                                <div>
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <table id="master_table" class="table table-bordered table-hover text-center">
                                        </table>
                                    </div>
                                </div><!-- .widget-body -->
                            </div><!-- .widget -->
                        </div>

                        @endsection

                        @push('js')
                            <script>

                                // samer
                                $(function () {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $('.search').on('change', function () {
                                        $('#master_table').DataTable().draw(true);
                                    })

                                    var table = $('#master_table').DataTable({
                                        responsive: true,
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            url: "{{ route('reports.index') }}",
                                            type: 'GET',
                                            data: function (d) {
                                                d.day = $('#day').val();
                                                d.month = $('#month').val();
                                                d.year = $('#year').val();
                                            }
                                        },
                                        // select: true,
                                        columns: [
                                            {data: 'id', name: 'id' ,title:'id'},
                                            {data: 'name', name: 'name',title:'الاسم'},
                                            {data: 'uploadNumber', name: 'uploadNumber',title:'الرقم التسلسلي'},
                                            // {data: 'category_id', name: 'category_id',title:'القسم الرئيسي'},
                                            // {data: 'subCat', name: 'subCat',title:'القسم الفرعي'},
                                            {data: 'action', name: 'action',title:'التحميل' ,searchable: 'false'},
                                            // {data: 'add_lang', name: 'add_lang',title:'add_lang' ,searchable: 'false'}
                                        ]
                                    });

                                    {{--$('body').on('change','#day',function(e){--}}
                                    {{--    e.preventDefault();--}}

                                    {{--    var day = $(this).val();--}}
                                    {{--    var url = '{{ route("reports.day", ":id") }}';--}}
                                    {{--    url = url.replace(':id', day);--}}

                                    {{--    $.ajax({--}}
                                    {{--        url: url,--}}
                                    {{--        method: "get",--}}
                                    {{--        data: {--}}
                                    {{--            day: day,--}}
                                    {{--        },--}}
                                    {{--        success: function (response) {--}}
                                    {{--                console.log(response);--}}

                                    {{--            // table.ajax.reload();--}}
                                    {{--            // table.draw(true)--}}
                                    {{--            // console.log(response);--}}
                                    {{--            // window.location.reload();--}}
                                    {{--        }--}}
                                    {{--    });--}}
                                    {{--})--}}


                                })



                            </script>

    @endpush

