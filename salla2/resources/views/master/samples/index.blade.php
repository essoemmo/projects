@extends('master.layout.index',[
'title' => _i('All Samles'),
'subtitle' => _i('All Samles'),
'activePageName' => _i('All Samles'),

])

@section('content')

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> {{_i('Add Sample')}} </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="{{url('master/samples/store')}}" method="POST" id="form_1"
                    data-parsley-validate="" id="fileupload" enctype="multipart/form-data">

                    @csrf

                    <div class="box-body">

                       <!-- ================================== lang =================================== -->

                       <div class="form-group row" >
                           <label class=" col-sm-2 col-form-label"><?=_i('Language')?> </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="lang_id">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                @foreach($languages as $lang)
                                <option value="<?=$lang['id']?>"
                           <?=old('lang_id') == $lang['id'] ? 'selected' : ''?>><?=_i($lang['title'])?>
                                </option>
                                @endforeach
                            </select>
                        </div>
                        </div>


                        <!-- ================================== Stores =================================== -->

                        <div class="form-group row" id="store_id">

                            <label for="store_id" class=" col-sm-2 col-form-label"> {{_i('Stores')}}
                            </label>

                            <div class="col-sm-10">
                                <select class="form-control" name="store_id">
                                    @foreach($stores as $value)
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <!-- ================================== image =================================== -->
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label" for="img_url">{{_i('Image')}}</label>
                            <div class="col-sm-10">
                                <input type="file" name="img_url" id="img_url" onchange="showBannerImage(this)"
                                    class="btn btn-default" accept="image/*"
                                    value="{{old('img_url')}}" required="">
                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('image')}}</strong>
                                </span>
                            </div>
                            <!-- Photo -->
                            <img class="img-responsive pad" id="img_url" hidden
                                style="margin-top: -130px;  margin-right:370px;">
                        </div>
                        <!-- ================================== description =================================== -->

                        <div class="form-group row" >

                            <label class="col-sm-2 col-form-label" for="txtUser">
                                {{_i('Description')}} </label>
                            <div class="col-sm-6">
                                <textarea id="editor1" class="form-control" name="description"
                                data-parsley-minlength="20"
                                placeholder="Place write content here...">{{old('description')}}</textarea>
                            </div>
                        </div>



                    </div>
                    <!-- ================================Submit==================================== -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> {{_i('Close')}}
                        </button>
                        <button class="btn btn-info" type="submit" id="s_form_1"> {{_i('Save')}} </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="box-body">

        <div class="row">
            <div class="col-sm-12 mb-3">
                <span class="pull-left">

                    <button class="btn btn-primary create add-permissiont" type="button" data-toggle="modal"
                        data-target="#modal-default">
                        <span><i class="ti-plus"></i> {{_i('create new Sample ')}} </span>
                    </button>

                </span>
            </div>


            <div class="col-sm-12">
                <!-- Zero config.table start -->
                <div class="card">
                    <div class="card-header">
                        <h5>{{_i('All Samples')}}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>
                    <div class="card-block">

                        <div class="dt-responsive table-responsive text-center">
                            <table id="sample_table" class="table table-bordered table-striped dataTable text-center">

                                <thead>
                                    <tr role="row">
                                        <th class="sorting"> {{_i('ID')}}</th>
                                        <th class="sorting_desc"> {{_i('Store Name')}}</th>
                                        <th class="sorting"> {{_i('Image')}}</th>
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
                    <form  action="{{route('sample_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                        {{method_field('post')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id_data" value="">
                        <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                        <div class="box-body">
                            <!----============================== content =============================-->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label"> {{_i('description')}} </label>

                                <div class="col-sm-6">
                                    <textarea id="editor1" class="form-control editor1" name="description"
                                    data-parsley-minlength="20"
                                    placeholder="Place write content here...">{{old('description')}}</textarea>
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



@push('js')

 <script  type="text/javascript">

    $(function () {
        CKEDITOR.replace('editor1', {
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('master/bower_components/ckeditor/ck_upload.php')}}",
            filebrowserUploadMethod: 'form'
        });
    });

    $(function () {
        $('#sample_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('master/samples/get_datatable')}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'store_id'},
                {data: 'img_url', name: 'img_url'},
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
    url: '{{route('sample_lang_value')}}',
            method: "get",
            "_token": "{{ csrf_token() }}",
            data: {
                lang_id: lang_id,
                transRowId: transRowId,
            },
            success: function (response) {

            console.log(response);
            if (response.data == 'false'){
            //$('#titletrans').val('');
            $('#editor1').val('');
            } else{
            // alert(response.data.info);
            //$('#titletrans').val(response.data.name);
            CKEDITOR.instances.editor1.setData(response.data.description);
            }

            }
    });
    // get lang title
    $.ajax({
    url: '{{route('masterall_lang')}}',
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
    })


    });


</script>

@endpush

@endsection
