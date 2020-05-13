@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Article Categories')}}
@endsection

@section('page_url')
    <li class="breadcrumb-item">
        <a href="{{url('adminpanel')}}">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{_i('Article Categories')}}</a>
    </li>
@endsection

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>


    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.AdminLayout.message')
                {!! $dataTable->table([
                    'class'=> 'table table-bordered table-striped  text-center'
                ],true) !!}
            </div>
        </div>
    </div>

    <!--------------------------------------------- modal trans start ----------------------------------------->
    <div class="modal fade modal_create " id="langedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        {{--    <div class="modal fade modal_create " id="langedit" role="dialog" aria-labelledby="exampleModalLabel" >--}}
        <div class="modal-dialog" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="header"> {{_i('Trans To')}} : </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  action="{{url('/adminpanel/article_cat/lang/store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                            {{method_field('post')}}
                            {{csrf_field()}}

                            <input type="hidden" name="id" id="id_data" value="">
                            <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                            <div class="box-body">
                                <!----============================== title =============================-->
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                    <div class="col-md-10">
                                        <input type="text"  placeholder="{{_i('Article Category Title')}}" name="title"  value=""
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required="" id="titletrans" >
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

                                <button type="submit" class="btn btn-primary" >
                                    {{_i('Save')}}
                                </button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--------------------------------- modal trans end ------------------------------->



@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script  type="text/javascript">

        /// translate button
        $('body').on('click','.lang_ex',function (e) {
            e.preventDefault();
            var transRowId = $(this).data('id');
            var lang_id = $(this).data('lang');
            // console.log(transRowId);
            // console.log(lang_id);

            $.ajax({
                url: '{{ url('adminpanel/article_cat/get/lang/value') }}',
                method: "get",
                data: {
                    lang_id: lang_id,
                    transRowId: transRowId,
                },
                success: function (response) {
                    if (response.data == 'false'){
                        $('#titletrans').val('');
                    }else{
                        //alert(response.data.info);
                        $('#titletrans').val(response.data.title);
                    }

                }
            });

            // get lang title
            $.ajax({
                url: '{{ url('adminpanel/get/lang') }}',
                method: "get",
                data: {
                    lang_id: lang_id,
                },
                success: function (response) {
                    $('#header').empty();
                    $('#header').text('Translate to : '+response);
                    $('#id_data').val(transRowId);
                    $('#lang_id_data').val(lang_id);
                }
            }); // end get language title

            // submit translate lang && save translation
            $('body').on('submit','#lang_submit',function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        if (response.errors){
                            $('#masages_model').empty();
                            $.each(response.errors, function( index, value ) {
                                $('#masages_model').show();
                                $('#masages_model').append(value + "<br>");
                            });
                        }
                        if (response == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Translated Successfully')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            $('.modal.modal_create').modal('hide');
                        }
                    },
                });

            })


        });

    </script>
@endpush
