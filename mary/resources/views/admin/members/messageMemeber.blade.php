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
            <table class="table table-bordered table-striped dataTable text-center" id="message_table">
            </table>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
@push('js')
    <script>
        $(function() {


            // $('#show').load('massege/all');

            $('#message_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/message/member/get_datatable/'.$id)}}',
                columns: [
                        {data: 'to_id', title: '{{_i('to')}}'},
                    {data: 'message', title: '{{_i('message')}}'},
                    {data: 'created_at', title: 'created_at'},
                    {data: 'action', title: 'action', orderable: true, searchable: true}

                ]
            });

            // var table = $('#notifaction_table').DataTable();
            // table.destroy();
        });


        $('body').on('click','#del',function (e) {
            e.preventDefault();

           var id= $(this).data('id');

            if(confirm("Are you sure ?")) {
                $.ajax({
                    url: '{{ route('remove-massege-member') }}',
                    method: "patch",
                    data: {_token: '{{ csrf_token() }}',
                        id: id,
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        })
    </script>
    @endpush
