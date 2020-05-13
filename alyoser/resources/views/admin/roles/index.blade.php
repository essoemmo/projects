@extends('admin.layout.master')
@section('content')

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">الصلاحيات</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="table-responsive">
                    <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                        <div class="row">
                            <div class="col-md-12">
                                @if(auth()->user()->hasPermission('create_users'))
                                <a href="{{route('roles.create')}}" style="float: left" class="btn btn-info btn-sm">
                                    <i class="fa fa-plus"></i>
                                    اضافة جديد
                                </a>
                                @else
                                    <button style="float: left" class="btn btn-info btn-sm disabled"> <i class="fa fa-plus"></i>اضافة جديد</button>

                                @endif

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

                                    var table = $('#master_table').DataTable({
                                        responsive: true,
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            url: "{{ route('roles.index') }}",
                                            type: 'GET',
                                        },
                                        // select: true,
                                        columns: [
                                            {data: 'id', name: 'id' ,title:'id'},
                                            {data: 'name', name: 'name',title:'name'},
                                            {data: 'action', name: 'action',title:'action' ,searchable: 'false'},
                                            // {data: 'add_lang', name: 'add_lang',title:'add_lang' ,searchable: 'false'}
                                        ]
                                    });


                                    $('body').on('submit','#delform',function (e) {
                                        e.preventDefault();
                                        var url = $(this).attr('action');
                                        // alert(url);

                                        $.ajax({
                                            url: url,
                                            method: "delete",
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                            },
                                            success: function (response) {

                                                if (response.status == 'success'){
                                                    new Noty({
                                                        type: 'success',
                                                        layout: 'topRight',
                                                        text: "تم الحذف بنجاح",
                                                        timeout: 2000,
                                                        killer: true
                                                    }).show();
                                                    table.ajax.reload();
                                                }
                                                // console.log(response);
                                                // window.location.reload();
                                            }
                                        });
                                    })


                                })



                            </script>

    @endpush

