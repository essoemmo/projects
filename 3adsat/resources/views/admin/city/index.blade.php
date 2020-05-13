
@extends('admin.layout.index',[
'title' => _i('All Cities'),
'subtitle' => _i('All Cities'),
'activePageName' => _i('Add Cities'),
'additionalPageUrl' => url('/admin/panel/city') ,
'additionalPageName' => _i('All'),
] )


@push('css')

    <style>
        #jobtypes_table_wrapper {
            width: 100%;
        }
    </style>

@endpush

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Cities') }}</h5>
        </div>



    @include('admin.layout.message')
    <!-- /.box-header -->
        <div class="card-body">
            <div  id="dataTableBuilder_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="dt-buttons" style="width: 100% !important;">
                    <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default">
                        <span><i class="fa fa-plus"></i> {{_i('create new city ')}} </span>
                    </button>
                    <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">
                        <span><i class="fa fa-print"></i></span>
                    </button>
                    
                    
                  @include("admin.translate_buttons",["table" => "cities"])
                </div>



                <table class="table table-hover text-center table-bordered dataTable" id="jobtypes_table">
                    <thead><tr>
                        <th class="sorting" >{{ _i('ID')}}</th>
                        <th class="sorting" >{{ _i('Name')}}</th>
                        <th class="sorting" >{{ _i('Country')}}</th>
                        <th class="sorting" >{{ _i('Language')}}</th>
                        <th class="sorting" >{{ _i('Created At')}}</th>
                        <th class="sorting" >{{ _i('Action')}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
        <!-- /.box-body -->
    </div>


    <!-- =============================== Create Model ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Add City')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/admin/panel/city/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="card-body">


                            <!-- ================================== language =================================== -->
                            <div class="form-group row" >
                                <label class="col-sm-3 col-form-label " for="lang_id">
                                    {{_i('Language')}} </label>
                                <div class="col-sm-8">
                                    <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                        <option disabled selected> {{_i('Choose')}}</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->name)}} </option>
                                        @endforeach

                                        @if ($errors->has('lang_id'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- ================================== country =================================== -->
                            <div class="form-group row">

                                <label for="country_id" class="col-sm-3 control-label">{{_i('Country')}} </label>

                                <div class="col-sm-8">
                                    <select required="" id="get_country" class="form-control"  name="country_id">
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- ================================== country =================================== -->
{{--                            <div class="form-group row">--}}

{{--                                <label for="country_id" class="col-sm-3 col-form-label">{{_i('Country')}} </label>--}}

{{--                                <div class="col-sm-8">--}}
{{--                                    <select required="" class="form-control selectpicker" style="width:100%" aria-hidden="true" name="country_id" id="country_id">--}}
{{--                                        <option value selected disabled>{{_i('Choose')}}</option>--}}
{{--                                        @foreach ($countries as $key => $country)--}}
{{--                                            <option value="{{ $key }}">{{ $country }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @if ($errors->has('country_id'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                             <strong>{{ $errors->first('country_id') }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- ================================== Title =================================== -->
                            <div class="form-group row">

                                <label for="name" class="col-sm-3 col-form-label" >{{_i('Name')}}</label>

                                <div class="col-sm-8">
                                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('City Name')}}"
                                           data-parsley-length="[3, 150]" required="">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =============================== Edit Model ============================================== -->
    <div class="modal fade" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Edit City')}}</h4>
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" action="{{url('/admin/panel/city/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
                        @csrf
                        <div class="card-body">


                            <!-- ================================== language =================================== -->
                            <div class="form-group row" >
                                <label class="col-sm-3 col-form-label " for="language_editform">
                                    {{_i('Language')}} </label>
                                <div class="col-sm-8">
                                    <select id="language_editform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                        <option disabled selected> {{_i('Choose')}}</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->name)}} </option>
                                        @endforeach

                                        @if ($errors->has('lang_id'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- ================================== country =================================== -->
                            <div class="form-group row">

                                <label for="country_id" class="col-sm-3 control-label">{{_i('Country')}} </label>

                                <div class="col-sm-8">
                                    <input type="hidden" id="country_id_1" name="country_id" value="">
                                    <select required class="form-control " name="country_id" id="country_id_2" >
                                        <option value="" disabled>{{_i('Choose')}}</option>

                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
{{--                            <!-- ================================== country =================================== -->--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="country_id" class="col-sm-3 col-form-label">{{_i('Country')}} </label>--}}

{{--                                <div class="col-sm-8">--}}
{{--                                    <input type="hidden" id="country_id_1" name="country_id" value="">--}}
{{--                                    <select required class="form-control selectpicker" name="country_id" id="country_id_2" style="width:100%" aria-hidden="true">--}}
{{--                                        <option value="" disabled>{{_i('Choose')}}</option>--}}
{{--                                        @foreach ($countries as $key => $country)--}}
{{--                                            <option value="{{ $key }}">{{ $country }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @if ($errors->has('country_id'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('country_id') }}</strong>--}}
{{--                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <!-- ================================== Title =================================== -->
                            <div class="form-group row">

                                <label for="title_1" class="col-sm-3 col-form-label" >{{_i('Name')}}</label>

                                <div class="col-sm-8">
                                    <input type="hidden" id="id_1" name="id" value="">
                                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('City Name')}}" data-parsley-length="[3, 150]">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script  type="text/javascript">

        /* Data table display*/
        $(document).ready(
            $("#jobtypes_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/city/get_datatable')}}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'country_id'},
                    {data: 'lang_id'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // { data:'delete',name:'delete'}
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title,country_id,lang_id){
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#country_id_2').val(country_id).change();
            $('#language_editform').val(lang_id);

            $.ajax({
                type:"GET",
                url:"{{url('admin/panel/country/list')}}?lang_id="+lang_id,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#country_id_2").empty();
                        html += $("#country_id_2").append('<option disabled >{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            html += $("#country_id_2").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#country_id_2").empty();
                    }
                }
            });
        }



        //add form
        $('#language_addform').click(function(){
            var languageID = $(this).val();
            //console.log(languageID);
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/panel/country/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_country").empty();
                            $("#get_country").append('<option disabled selected>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_country").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_country").empty();
                        }
                    }
                });
            }else{
                $("#get_country").empty();
            }
        });

        // edit form
        $('#language_editform').click(function(){
            // var saved_lang = $("#saved_lang_id").val();
            var languageID = $(this).val();

            // var html = $("#country_id_2").append('<option selected> ' + cat + '</option>');
            $.ajax({
                type:"GET",
                url:"{{url('admin/panel/country/list')}}?lang_id="+languageID,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#country_id_2").empty();
                        html += $("#country_id_2").append('<option disabled >{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            html += $("#country_id_2").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#country_id_2").empty();
                    }
                }
            });

        });

    </script>

@endpush
