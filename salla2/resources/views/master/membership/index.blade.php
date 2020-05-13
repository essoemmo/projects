
@extends('master.layout.index',[
'title' => _i('All Membership'),
'subtitle' => _i('All Membership'),
'activePageName' => _i('All Membership'),
'additionalPageUrl' => url('/master/membership/add') ,
'additionalPageName' => _i('Add'),
] )

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <span class="pull-left">
                 <a href="{{url('master/membership/add')}}"  class="btn btn-primary create add-permission">
                      <i class="ti-plus"></i>{{_i('create new membership')}}
                 </a>
            </span>
        </div>

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('All Membership')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        <table id="draw_datatable" class="table table-bordered table-striped dataTable text-center">
                            <thead>
                            <tr role="row " class="text-center">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('Membership Title')}}</th>
                                <th class="sorting" > {{_i('Price')}}</th>
                                <th class="sorting" > {{_i('Duration')}}</th>
                                <th class="sorting" > {{_i('Status')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
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
                        <form  action="{{url('/master/membership/lang/store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                            {{method_field('post')}}
                            {{csrf_field()}}

                            <input type="hidden" name="id" id="id_data" value="">
                            <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                            <div class="box-body">
                                <!----============================== title =============================-->
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                    <div class="col-md-10">
                                        <input type="text"  placeholder="{{_i('Membership Title')}}" name="title"  value=""
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required="" id="titletrans" >
                                    </div>
                                </div>

                                <!----============================== description =============================-->
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 control-label"> {{_i('Description')}} </label>

                                    <div class="col-sm-10">
                                        <textarea id="descriptiontrans"  class="form-control" name="description"  placeholder="{{_i('Membership Description')}}" ></textarea>

                                    </div>
                                </div>

                                <!----============================== description =============================-->
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 control-label"> {{_i('Info')}} </label>

                                    <div class="col-sm-10">
                                        <textarea id="editor1" class="form-control editor1" name="info"></textarea>
                                        <small  class="form-text text-muted">{{_i('Please insert data row by row')}}</small>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

                                <button type="submit" class="btn btn-primary" >
                                    {{_i('Add')}}
                                </button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--------------------------------- modal trans end ------------------------------->
@endsection
        @push('css')
            <style>
                .modal_create  {
                    margin: 2px auto;
                    z-index: 1100 !important;
                }

            </style>
        @endpush
@push('js')

    <script  type="text/javascript">
        $(function () {

            CKEDITOR.editorConfig = function (config) {
                config.baseFloatZIndex = 102000;
                config.FloatingPanelsZIndex = 100005;

            };
            CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton,colordialog',
            });


        });

        $(function() {
            $('#draw_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/master/membership')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'price', name: 'price'},
                    {data: 'duration', name: 'duration'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

        /// translate button
        $('body').on('click','.lang_ex',function (e) {
            e.preventDefault();
            var transRowId = $(this).data('id');
            var lang_id = $(this).data('lang');
           // console.log(transRowId);
           // console.log(lang_id);

            $.ajax({
                url: '{{ url('master/membership/get/lang/value') }}',
                method: "get",
                data: {
                    lang_id: lang_id,
                    transRowId: transRowId,
                },
                success: function (response) {
                    if (response.data == 'false'){
                        $('#titletrans').val('');
                        $('#descriptiontrans').val('');
                        $('#editor1').val('');
                    }else{
                        //alert(response.data.info);
                        $('#titletrans').val(response.data.title);
                        $('#descriptiontrans').val(response.data.description);
                        //$('#editor1').val(response.data.info);
                        CKEDITOR.instances.editor1.setData( response.data.info );
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