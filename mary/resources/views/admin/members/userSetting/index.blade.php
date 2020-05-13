@extends('admin.index')
@section('title', $title)
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <a href="{{route('setting-member-new')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>{{_i('add new')}}</a>
            <table id="setting_user" class="table table-bordered table-hover dataTable text-center" >
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
@push('js')
    <script type="text/javascript">
        // $('.datepicker').datepicker();
        // var allEditors = document.querySelectorAll('.ckeditor');
        //
        // for (var i = 0; i < allEditors.length; ++i) {
        //     ClassicEditor.create(allEditors[i]);
        // }
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#setting_user').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('setting-member') }}",
                    type: 'GET',
                },
                // select: true,
                columns: [
                    {data: 'id', name: 'id' ,title:'id'},
                    {data: 'user_id', name: 'user_id' ,title:"user"},
                    {data: 'action', name: 'action',title:'action' ,searchable: 'false'}
                ]
            });

            $('body').on('click','.add-data',function (e) {
                // e.preventDefault();

                var id = $(this).data('id');
                $('#user_id').val(id);
                });


            $('body').on('click','#submitdata',function (e) {
                e.preventDefault();
                $('#form').submit();
            });

            $('body').on('click','.show',function (e) {
                // e.preventDefault();

                var id = $(this).data('id');
                $.ajax({
                    type:'get',
                    url:"{{route('get-date')}}",
                    data:{
                        id:id
                    },
                    success:function(response) {
                        $('#dataId').val(response);
                    }
                });
            });


            $('body').on('click','.delete',function (e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "{{_i('Are you sure ?')}}",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("{{_i('yes')}}", 'btn btn-success mr-2', function () {
                            that.closest('form').submit();
                        }),

                        Noty.button("{{_i('no')}}", 'btn btn-primary mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            });//end of delete

            $('body').on('submit','.delform',function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        console.log(response);
                        if (response['0'] == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('deleted is Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();
                        }


                    },

                });

            })
        });
    </script>

@endpush
