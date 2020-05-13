@extends('admin.AdminLayout.index')

@section('title')
{{_i('index')}}
@endsection


@section('content')

<!-- Page-header start -->
<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('Currency')}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">{{_i('Currency')}}</a>
            </li>
        </ul>
    </div>
</div>
<!-- Page-header end -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('Add Currency')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('adminpanel/settings/currency/store')}}" id="form">
                        {{csrf_field()}}
                        {{method_field('post')}}

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
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <label class=" " for="checkbox">
                                    <input type="checkbox" class=" js-single" id="checkbox" name="show" value="1" {{old('show') == 1 ? 'checked' : ''}} >
                                    {{_i('Show')}}

                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                                <label>{{_i('Title')}}</label>
                                <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{{_i('Code')}}</label>
                            <input type="text" name="code" class="form-control">
                         </div>

                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
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
                    <form  action="{{route('currency_lang_store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                        {{method_field('post')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id_data" value="">
                        <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                        <div class="box-body">
                            <!----============================== title =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>

                                <div class="col-md-10">
                                    <input type="text"  placeholder="{{_i('Title')}}" name="title"  value=""
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


<div class="card">
    <!-- Blog-card start -->
    <div class="card-header">

        <div class="card-title">
            <h5>
                {{_i('Currency')}}
            </h5>
        </div>
    </div>

<div class="card-block">


    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">


        <div class="dt-buttons">
            <button class="dt-button btn btn-default" type="button" data-toggle="modal" data-target="#modal-default">
                <span><i class="ti-plus"></i> {{_i('create new Currency ')}} </span>
            </button>

        </div>
        <table id="currency-table" class="table table-hover text-center table table-bordered table-responsive"
            role="grid" style="width: 100% ;display: table !important">
            <thead>
                <tr>
                    <th>{{_i('id')}}</th>
                    <th>{{_i('title')}}</th>
                    <th>{{_i('Show IN The WebSite')}}</th>
                    <th>{{_i('control')}}</th>

                </tr>
            </thead>
        </table>
    </div>



</div>
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
    $('#currency-table').DataTable({
    processing: true,
            serverSide: true,
            ajax: '{{route('allcurrency')}}',
            columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'show', name: 'show'},
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
    url: '{{route('currency_lang_value')}}',
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
    })


    });



</script>

 @endpush

 @endsection
