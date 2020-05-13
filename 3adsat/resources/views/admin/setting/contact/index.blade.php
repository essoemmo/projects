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
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('create')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contact">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click','#show',function (e) {
                e.preventDefault();

                var title = $(this).data('title');
                var content = $(this).data('content');
                var email = $(this).data('email');

                var html = `
                       <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                        <div class="header">

                                 <p>email : ${email}</p>
                                <p>title : ${title}</p>



                               <textarea disabled>${content}</textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>

               `;
                $('#contact').empty();
                $('#contact').append(html);


            })
        })


    </script>
@endpush
