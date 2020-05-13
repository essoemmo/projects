
@extends('admin.layout.index',[
'title' => _i('All Currencies'),
'subtitle' => _i('All Currencies'),
'activePageName' => _i('Add Currencies'),
'additionalPageUrl' => url('/admin/panel/Currencies') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Currencies') }}</h5>
        </div>



    @include('admin.layout.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <div class="blog common-wrapper" >
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-primary " data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-fw fa-plus-square"></i>
                            {{_i('Add New')}}
                        </a>
 @include("admin.translate_buttons",["table" => "currencies"])
                        @if(count($currencies) >0 )
                            <table id="courseRequest" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th > {{_i('ID')}}</th>
                                    <th > {{_i('Title')}}</th>
                                    <th > {{_i('Language')}}</th>
                                    <th > {{_i('Country')}}</th>
                                    <th > {{_i('Created')}}</th>
                                    <th > {{_i('Controll')}}</th>
                                </tr>
                                </thead>

                                @foreach($currencies as $item)
                                    {{--                                @dd($item)--}}
                                    <tbody>

                                    <tr>
                                        <th class="font-weight-normal" scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->title }}</td>
                                        <td>{{_i( \App\Models\Language::where('id' , $item->lang_id)->first()->name) }}</td>
                                        <td>{{_i( \App\Models\Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')->where('countries.id' , $item->country_id)->where('country_descriptions.language_id',checknotsessionlang())->first()["name"]) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <button type="button" class="btn waves-effect waves-light btn-success showEdit" data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="fa fa-eye"></i>
                                                <input type="hidden" name="request_id" class="item_id" value="{{$item->id}}" id="{{$item->id}}" >
                                            </button>
                                            <a style="color: #fff;" class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{route('currency-delete',$item->id)}}" data-id="{{$item->id}}" data-target="#custom-width-modal">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                @endforeach

                            </table>

                        @else
                            <div class="text-center alert-danger alert">
                                {{ _i('No Currencies') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- ==============================Add Model=============================================-->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{_i('Add Currency')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/admin/panel/currency/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="box-body">
                            <!-- ================================== Title =================================== -->
                            <div class="form-group">

                                <label for="title" class="col-xs-3 control-label" >{{_i('Title')}}</label>

                                <div class="col-xs-8">
                                    <input id="title" type="text" class="form-control" name="title"  placeholder="{{ _i('Title')}}"  required="">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <!-- ================================== Title =================================== -->
                            <div class="form-group">

                                <label for="code" class="col-xs-3 control-label" >{{_i('Code')}}</label>

                                <div class="col-xs-8">
                                    <input id="code" type="text" class="form-control" name="code"  placeholder="{{ _i('Code')}}"  required="">

                                    @if ($errors->has('code'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <!-- ================================== language =================================== -->
                            <div class="form-group " >
                                <label class="col-xs-3 col-form-label " for="language_addform">
                                    {{_i('Language')}} </label>
                                <div class="col-xs-8">
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
                            <div class="form-group " >
                                <label class="col-xs-3 col-form-label " for="get_country">
                                    {{_i('Country')}} </label>
                                <div class="col-xs-8">
                                    <select required="" id="get_country" class="form-control" style="width:100%" aria-hidden="true" name="country_id" >

                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- ================================== currency rate =================================== -->
                        <div class="form-group">

                            <label for="code" class="col-xs-3 control-label" >{{_i('Rate')}}</label>

                            <div class="col-xs-8">
                                <input id="rate" type="text" class="form-control" name="rate"  placeholder="{{ _i('rate')}}"  required="">

                                @if ($errors->has('rate'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rate') }}</strong>
                                        </span>
                                @endif

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
    <!-- ==============================end Add Model=============================================-->
    <!-- ============================== start edit Model=============================================-->
    <!--edit & show Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1"  style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLongTitle">{{ _i('Edit Currency')}}</h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" action="" method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
                        @csrf
                        <div class="box-body">
                            <!-- ================================== Title =================================== -->
                            <div class="form-group">

                                <label for="title" class="col-xs-3 control-label" >{{_i('Title')}}</label>

                                <div class="col-xs-8">
                                    <input id="title" type="text" class="form-control" name="title"  placeholder="{{ _i('Title')}}"  required="">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <!-- ================================== Title =================================== -->
                            <div class="form-group">

                                <label for="code" class="col-xs-3 control-label" >{{_i('Code')}}</label>

                                <div class="col-xs-8">
                                    <input id="code" type="text" class="form-control" name="code"  placeholder="{{ _i('Code')}}"  required="">

                                    @if ($errors->has('code'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <!-- ================================== language =================================== -->
                            <div class="form-group " >
                                <label class="col-xs-3 col-form-label " for="language_addform_2">
                                    {{_i('Language')}} </label>
                                <div class="col-xs-8">
                                    <select id="language_addform_2" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

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
                            <div class="form-group " >
                                <label class="col-xs-3 col-form-label " for="get_country">
                                    {{_i('Country')}} </label>
                                <div class="col-xs-8">
                                    <select required="" id="get_country_2" class="form-control" style="width:100%" aria-hidden="true" name="country_id" >

                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- ================================== currency rate =================================== -->
                        <div class="form-group">

                            <label for="code" class="col-xs-3 control-label" >{{_i('Rate')}}</label>

                            <div class="col-xs-8">
                                <input id="rate" type="text" class="form-control" name="rate"  placeholder="{{ _i('rate')}}"  required="">

                                @if ($errors->has('rate'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rate') }}</strong>
                                        </span>
                                @endif

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End edit & show Modal -->
    <!-- delete Modal -->
    <form action="" method="POST" class="remove-record-model">
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">{{ _i('Delete') }}</h4>
                    </div>
                    <div class="modal-body">
                        <h4>{{ _i('are you sure to delete this one?') }}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ _i('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">{{ _i('Delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            //add form get countries
            $('#language_addform').change(function(){
                var languageID = $(this).val();
                console.log(languageID);
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

            $('#language_addform_2').change(function(){
                var languageID = $(this).val();
                console.log(languageID);
                if(languageID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('admin/panel/country/list')}}?lang_id="+languageID,
                        dataType:'json',
                        success:function(res){
                            if(res){
                                $("#get_country_2").empty();
                                $("#get_country_2").append('<option disabled selected>{{ _i('Choose') }}</option>');
                                $.each(res,function(key,value){
                                    $("#get_country_2").append('<option value="'+key+'">'+value+'</option>');
                                });

                            }else{
                                $("#get_country_2").empty();
                            }
                        }
                    });
                }else{
                    $("#get_country_2").empty();
                }
            });

            // edit form
            $('#lang_select').click(function(){
                // var saved_lang = $("#saved_lang_id").val();
                var languageID = $(this).val();

                // var html = $("#country_id_2").append('<option selected> ' + cat + '</option>');
                loadCountries(languageID)

            });

            function loadCountries(languageID)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/panel/country/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            html = $("#get_country_2").empty();
                            html += $("#get_country_2").append('<option disabled >{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                                html += $("#get_country_2").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_country_2").empty();
                        }
                    }
                });
            }
        </script>

        <script>
            $(function () {
                'use strict';
                $('.showEdit').click(function () {
                    var item_id = $(this).children('.item_id').val();
                    $.ajax({
                        url:'{{ route('currencyShow') }}',
                        DataType:'json',
                        type:'get',
                        data: {item_id: item_id},
                        success:function (res) {
                            //console.log(res.lang_id);
                            $('#exampleModalCenter').find('#form_2').attr('action',"{{url('/admin/panel/currency/')}}/"+ res.id + '/update');
                            $('#exampleModalCenter').find('#title').val(res.title);
                            $('#exampleModalCenter').find('#code').val(res.code);
                            $('#exampleModalCenter').find('#rate').val(res.rate);
                            $('#exampleModalCenter').find('#language_addform_2').val(res.lang_id);
                            // loadCountries(res.lang_id);
                            $('#exampleModalCenter').find('#get_country_2').val(res.country_id);
                            //console.log(res.country_id);
                            $.ajax({
                                type:"GET",
                                url:"{{url('admin/panel/country/list')}}?lang_id="+res.lang_id,
                                dataType:'json',
                                success:function(res){
                                    if(res){
                                         $("#get_country_2").empty();
                                         $("#get_country_2").append('<option disabled >{{ _i('Choose') }}</option>');
                                        $.each(res,function(key,value){
                                             $("#get_country_2").append('<option value="'+key+'">'+value+'</option>');
                                        });
                                    }
                                }
                            });

                        }
                    })
                });
            })
        </script>

        <script>
            $(document).ready(function(){
                // For A Delete Record Popup
                $('.remove-record').click(function() {
                    var id = $(this).attr('data-id');
                    var url = $(this).attr('data-url');
                    var token = '{{csrf_token()}}';
                    $(".remove-record-model").attr("action",url);
                    $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
                    $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
                });
                $('.remove-data-from-delete-form').click(function() {
                    $('body').find('.remove-record-model').find( "input" ).remove();
                });
                $('.modal').click(function() {
                    // $('body').find('.remove-record-model').find( "input" ).remove();
                });
            });

        </script>
    @endpush

@endsection
