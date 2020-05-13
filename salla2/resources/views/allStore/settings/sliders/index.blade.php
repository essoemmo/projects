@extends('admin.AdminLayout.index')
@section('title')
{{_i('index')}}
@endsection
@section('content')

<!------------- model start ------------------>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> {{_i('Add Slider')}} </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('adminpanel/settings/slider/store')}}" method="POST" id="form_1" data-parsley-validate="" id="fileupload" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                    <!-- ============= lang ================!-->
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="lang_id" id="language_addform" required="">
                                <option selected disabled="">{{_i('CHOOSE')}}</option>
                                @foreach($langs as $lang)
                                    <option value="{{$lang->id}}">{{_i($lang->title)}}</option>
                                @endforeach
                            </select>
                            <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                        </div>
                    </div>
                        <!-- ================================== Title =================================== -->
                        <div class="form-group row ">
                            <label for="name" class="col-sm-3 col-form-label"> {{_i('Name')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{_i('Slider Name')}}" value="{{old('name')}}"
                                    data-parsley-length="[3, 191]" required="">
                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>

                            </div>
                        </div>
                        <!-- ================================== url =================================== -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"> {{_i('Link')}} <span
                                    style="color: #F00;">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" name="link" placeholder="{{_i('Url')}}"
                                    value="{{old('link')}}" type="url" data-parsley-type="url" required="">
                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('link')}}</strong>
                                </span>

                            </div>
                        </div>
                        <!----==========================  published ==========================--->
                        <!-- checkbox -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label " for="checkbox">
                                {{_i('Publish')}}
                            </label>
                            <div class="col-sm-9">
                                <label>
                                    <input type="checkbox" class="minimal control-label" id="checkbox" name="published"
                                        value="1" {{old('published') == 1 ? 'checked' : ''}}>
                                </label>
                            </div>
                        </div>
                        <!-- ================================== description =================================== -->
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label"> {{_i('Description')}} </label>
                            <div class="col-sm-9">
                                <textarea id="description" class="form-control" name="description"
                                    placeholder="{{_i('Slider description')}}&hellip;">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <!-- ================================== image =================================== -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="logo">{{_i('Image')}} <span
                                    style="color: #F00;">*</span> </label>
                            <div class="col-sm-9">
                                <input type="file" name="image" id="image" onchange="showSliderImage(this)"
                                    class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                    value="{{old('image')}}" required="">
                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('image')}}</strong>
                                </span>
                            </div>
                            <!-- Photo -->
                            <img class="img-responsive pad" id="slider_img" hidden
                                style="margin-top: -130px;  margin-right:370px;">
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
                    <form  action="{{route('silder_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

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

<div class="card">

    <div class="card-header">
        <h5 class="card-title">
            {{_i('Sliders')}}
        </h5>
    </div>

    <div class="card-block">

        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">


            <div class="dt-buttons" style="float: right;margin-top:-60px;">
                <button class="dt-button btn btn-default" type="button" data-toggle="modal" data-target="#modal-default">
                    <span><i class="ti-plus"></i> {{_i('create new slider ')}}</span>
                </button>

            </div>

            <table id="sliders-table" class="table table-hover text-center table table-bordered table-responsive"
                role="grid" style="width: 100% ;display: table !important;">
                <thead>
                    <tr>
                        <th class="sorting"> {{_i('ID')}}</th>
                        <th class="sorting"> {{_i('Name')}}</th>
                        <th class="sorting"> {{_i('Url')}}</th>
                        <th class="sorting"> {{_i('Image')}}</th>
                        <th class="sorting"> {{_i('Created At')}}</th>
                        <th class="sorting" style="width: 11%;"> {{_i('Controll')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
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
                        $('#sliders-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{route('allsliders')}}',
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'url', name: 'link'},
                                {data: 'image', name: 'image'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'action', name: 'action', orderable: true, searchable: true}

                            ]
                        });
                    });

              /// translate button
              $('body').on('click','.lang_ex',function (e) {
            e.preventDefault();
            var transRowId = $(this).data('id');
            var lang_id = $(this).data('lang');

            console.log(transRowId);
             console.log(lang_id);

            $.ajax({
                url: '{{route('silder_lang_value')}}',
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
                    }else{
                        //alert(response.data.info);
                        $('#titletrans').val(response.data.name);
                        CKEDITOR.instances.editor1.setData( response.data.description );
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
                    "_token": "{{ csrf_token() }}",
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

@endsection
