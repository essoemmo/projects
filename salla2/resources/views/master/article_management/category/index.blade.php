
@extends('master.layout.index',[
'title' => _i('Article Category'),
'subtitle' => _i('Article Category'),
'activePageName' => _i('Article Category'),
'additionalPageUrl' => url('/master/article_cat/create') ,
'additionalPageName' => _i('Add'),
] )
@section('content')
    <div class="row">


        <!-----
        <div class="col-sm-12 mbl">
         <span class="pull-left">
             <a href="{{url('master/article_cat/create')}}" target="_blank" class="btn btn-primary create ">
                 <i class="ti-plus"></i>{{_i('create new article category')}}
             </a>
         </span>
        </div>
----->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Articles Category List') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block text-center">

                    {!! $dataTable->table([
               'class'=> 'table table-striped table-bordered  dataTable text-center '
                    ],true) !!}

                </div>
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
                        <form  action="{{url('/master/article_cat/lang/store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

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
                url: '{{ url('master/article_cat/get/lang/value') }}',
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
                url: '{{ url('master/get/lang') }}',
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

