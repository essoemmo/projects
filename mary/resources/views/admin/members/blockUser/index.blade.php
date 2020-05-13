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
            <table id="block_data" class="table table-bordered table-hover dataTable text-center" >
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('add the date of expire')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('block-member-store')}}" method="post" id="form" data-parsley-validate="">
                        {{csrf_field()}}
                        {{method_field('post')}}

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label>{{_i('date of expire')}}</label>
                        </div>
                        <input type="hidden" name="user_id" value="" id="user_id">
                        <div class="col-md-9">
                            <input type="date" name="date" class="form-control" data-parsley-required="true"/>
                        </div>

                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="submitdata">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('date of expire')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>{{_i('date of expire')}}</label>
                            </div>
                            <input type="hidden" name="user_id" value="" id="user_id">
                            <div class="col-md-9">
                                <input type="date" id="dataId" class="form-control">
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                </div>
            </div>
        </div>
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

            var table = $('#block_data').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('block-member') }}",
                    type: 'GET',
                },
                // select: true,
                columns: [
                    {data: 'id', name: 'id' ,title:'id'},
                    {data: 'username', name: 'username',title:'username'},
                    {data: 'status', name: 'status',title:'status'},
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

        });
    </script>

@endpush
