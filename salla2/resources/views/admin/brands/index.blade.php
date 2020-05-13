
@extends('admin.AdminLayout.index')

@section('title')
    brands
@endsection

@section('page_header_name')
    brands
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Brands')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div style="clear:both;"></div>

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <span class="pull-left">
                    <a href="{{route('brands.create')}}" class="btn btn-primary create add-permissiont" type="button"><span><i class="ti-plus"></i> {{_i('create new Brand ')}} </span></a>
                </span>
            </div>

            <div class="col-sm-12">
                <!-- Zero config.table start -->
                <div class="card">
                    <div class="card-header">
                        <h5>{{_i('All Brands')}}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive text-center">
                            <table id="brand_table" class="table table-bordered table-striped dataTable text-center">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting"> {{_i('Name')}}</th>
                                        <th class="sorting"> {{_i('Image')}}</th>
                                        <th class="sorting"> {{_i('Link')}}</th>
                                        <th class="sorting"> {{_i('Created At')}}</th>
                                        <th class="sorting"> {{_i('Controll')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------------------------- modal trans start ----------------------------------------->
<div class="modal fade modal_create " id="langedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:40px;">
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
                    <form  action="{{route('brand_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                        {{method_field('post')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id_data" value="">
                        <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                        <div class="box-body">
                            <!----============================== title =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                <div class="col-md-10">
                                    <input type="text"  placeholder="{{_i('name')}}" name="name"  value=""
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required="" id="titletrans" >
                                </div>
                            </div>
                            <!----============================== content =============================-->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label"> {{_i('description')}} </label>

                                <div class="col-sm-10">
                                    <textarea id="editor1" class="form-control editor1" name="description"></textarea>
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

</div>

    @push('js')
       <script>

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

            
    $(function () {
        $('#brand_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('allbrands')}}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
                {data: 'link', name: 'link'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ]
        });

        
    });

     /// translate button
     $('body').on('click', '.lang_ex', function (e) {
        e.preventDefault();
        var transRowId = $(this).data('id');
        var lang_id = $(this).data('lang');
        console.log(transRowId);
        console.log(lang_id);
        $.ajax({
        url: '{{route('brand_lang_value')}}',
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
                $('#titletrans').val(response.data.name);
                CKEDITOR.instances.editor1.setData(response.data.description);
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

@endsection
