@extends('master.layout.index',[
'title' => _i('Country'),
'subtitle' => _i('Country'),
'activePageName' => _i('Country'),

] )


@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="card-title">
            {{_i('Countries')}}
        </h5>
    </div>

    <div class="card-block">


        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">


            <div class="dt-buttons" style="float: right;margin-top:-60px;">
                <button class="dt-button btn btn-default" type="button" data-toggle="modal" data-target="#modal-default">
                    <span><i class="ti-plus"></i> {{_i('create new country ')}} </span>
                </button>

            </div>

            <table id="country_table" class="table table-hover text-center table table-bordered table-responsive"
                   role="grid" style="width: 100% ;display: table !important;">

                        <thead>
                        <tr role="row">
                        <th class="sorting"> {{_i('ID')}}</th>
                        <th class="sorting_desc"> {{_i('Title')}}</th>
                        <th class="sorting"> {{_i('Code')}}</th>
                        <th class="sorting"> {{_i('Logo')}}</th>
                        <th class="sorting"> {{_i('Controll')}}</th>
                        </tr>
                        </thead>

            </table>
        </div>
    </div>
</div>



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
                    <form  action="{{route('country_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                        {{method_field('post')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id_data" value="">
                        <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                        <div class="box-body">
                            <!----============================== title =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                <div class="col-md-10">
                                    <input type="text"  placeholder="{{_i('title')}}" name="title"  value=""
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required="" id="titletrans" >
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





<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> {{_i('Add Country')}} </h4>
            </div>
            <div class="modal-body">

                <form  action="{{url('/master/country/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                    @csrf
                    <div class="box-body">
                        <!-- ============= lang ================!-->
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" name="lang_id" id="language_addform" required="">
                                    <option selected disabled="">{{_i('CHOOSE')}}</option>
                                    @foreach($langs as $lang)
                                    <option value="{{$lang->id}}">{{($lang->title)}}</option>
                                    @endforeach
                                </select>
                                <small  class="form-text text-muted">{{_i('Please select language ')}}</small>
                            </div>


                        </div>
                        <!--================================== Title =================================== !-->
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label " for="txtUser">
                                {{_i('Title')}} </label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{old('title')}}" id="txtUser" required="" class="form-control">
                                @if ($errors->has('title'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label " for="code">
                                {{_i('County Code')}} </label>
                            <div class="col-sm-10">
                                <input type="number" name="code" value="{{old('code')}}" id="code" required="" class="form-control">
                                @if ($errors->has('code'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label" for="logo">{{_i('Logo')}}</label>
                            <div class="col-sm-4">
                                <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                       value="{{old('logo')}}">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                            </div>
                            <!-- Photo -->
                            <div class="col-sm-12">
                                <img class="img-responsive pad" id="article_img" style="margin: 0 auto;display: block;">
                            </div>
                        </div>

                    <!-- ================================Submit==================================== -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> {{_i('Close')}} </button>
                        <button class="btn btn-info" type="submit" id="s_form_1"> {{_i('Save')}} </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
            $('#country_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('master/country/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'code', name: 'code'},
                    {data: 'logo', name: 'logo'},
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
    url: '{{route('country_lang_value')}}',
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
            //CKEDITOR.instances.editor1.setData(response.data.description);
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
    })


    });



</script>

@endpush

@endsection
