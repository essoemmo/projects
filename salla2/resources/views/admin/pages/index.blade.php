
@extends('admin.AdminLayout.index',[
'title' => _i('Pages'),
'subtitle' => _i('Pages'),
'activePageName' => _i('Pages'),
'additionalPageUrl' => url('/adminpanel/pages') ,
'additionalPageName' => _i('All'),
] )
@section('content')
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Pages List') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                    </div>
                </div>
                <div class="card-block">

                    {!! $dataTable->table([
                    'class'=> 'table table-striped table-bordered  dataTable text-center '
                                        ],true) !!}

                </div>
            </div>
        </div>

    </div>

    <!--------------------------------------------- modal get link start ----------------------------------------->
    <div class="modal fade get_link " id="get_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:40px;">
        {{--    <div class="modal fade modal_create " id="langedit" role="dialog" aria-labelledby="exampleModalLabel" >--}}
        <div class="modal-dialog" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{_i('Page Link')}}  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  >
                            <div class="box-body">
                                <!----============================== link =============================-->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="text"  placeholder="{{_i('Article Category Title')}}" name="title"  value=""
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="link" >
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--------------------------------- modal trans end ------------------------------->

    <!--------------------------------------------- modal trans start ----------------------------------------->
    <div class="modal fade modal_create " id="langedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:40px;">
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
                        <form  action="{{route('page_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                            {{method_field('post')}}
                            {{csrf_field()}}

                            <input type="hidden" name="id" id="id_data" value="">
                            <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                            <div class="box-body">
                                <!----============================== title =============================-->
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                    <div class="col-md-10">
                                        <input type="text"  placeholder="{{_i('Page Title')}}" name="title"  value=""
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required="" id="titletrans" >
                                    </div>
                                </div>
                                <!----============================== content =============================-->
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 control-label"> {{_i('Content')}} </label>

                                    <div class="col-sm-10">
                                        <textarea id="editor1" class="form-control editor1" name="content"></textarea>
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

    @push('css')
        <style>
            .modal_create  {
                margin: 2px auto;
                z-index: 1100 !important;
            }

        </style>
    @endpush

@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script  type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            CKEDITOR.editorConfig = function (config) {
                config.baseFloatZIndex = 102000;
                config.FloatingPanelsZIndex = 100005;

            };
            CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton,colordialog',
                filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master')}}",
                filebrowserUploadMethod: 'form'
            });


        });

        //link
        $('body').on('click','.get_link',function (e) {
            var link = $(this).data('link');
            $('#link').val(link);
        });
      

         /// translate button
     $('body').on('click', '.lang_ex', function (e) {
        e.preventDefault();
        var transRowId = $(this).data('id');
        var lang_id = $(this).data('lang');
        console.log(transRowId);
        console.log(lang_id);
        $.ajax({
                url: '{{route('page_lang_value')}}',
                method: "get",
                "_token": "{{ csrf_token() }}",
                data: {
                'lang': lang_id,
                'transRow': transRowId,
                },
                success: function (response) {
    
                // console.log(response);
                if (response.data == 'false'){
                $('#titletrans').val('');
                $('#editor1').val('');
                } else{
                //alert(response.data.info);
                $('#titletrans').val(response.data.title);
                CKEDITOR.instances.editor1.setData(response.data.content);
                }
    
                }
        });
        // get lang title
        $.ajax({
        url: '{{route('all_langs')}}',
                method: "get",
                data: {
                lang_id: lang_id,
                },
                success: function (response) {
                $('#header').empty();
                $('#header').text('Translate to : ' + response);
                $('#id_data').val(transRowId);
                $('#lang_id_data').val(lang_id);
                }
        }); // end get language title
    
        // submit translate lang && save translation
        $('body').on('submit', '#lang_submit', function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        $.ajax({
        url: url,
                method: "post",
                "_token": "{{ csrf_token() }}",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,
                success: function (response) {
                if (response.errors){
                $('#masages_model').empty();
                $.each(response.errors, function(index, value) {
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
        });
        });

    </script>
@endpush