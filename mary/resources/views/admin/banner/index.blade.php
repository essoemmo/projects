@extends('admin.index')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">

{{--<a href="{{route('members.create')}}" class="btn btn-primary "><i class="fa fa-plus"></i>{{_i('create Members')}}</a>--}}

            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script>
        $('body').on('submit','#delform',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var table = $('.dataTable').DataTable();
            // alert(url);

            $.ajax({
                url: url,
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {

                    table.ajax.reload();
                    if (response[0] === 'SUCCESS'){
                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                    }
                    // console.log(response);
                    // window.location.reload();
                }
            });
        })
    </script>
@endpush