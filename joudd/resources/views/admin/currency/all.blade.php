@extends('admin.layout.layout')

<!-- ==============================Head=============================================-->
@section('title')
    {{_i('Currencies')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Currencies')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/currency')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

<!-- ==============================Main=============================================-->

@section('content')

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
                    <form  class="form-horizontal" action="{{url('/admin/currency/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
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
                                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
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
                                    <select required="" id="get_country" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="country_id" >

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

                            <div class="form-group">

                                <label class="col-xs-3 control-label">{{ _i('title') }} </label>

                                <div class="col-xs-8">
                                    <input id="title" type="text" class="form-control" name="title" value="" placeholder="{{ _i('Title')}}"  required="">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="col-xs-3 control-label">{{ _i('Code') }} </label>

                                <div class="col-xs-8">
                                    <input id="code" type="text" class="form-control" name="code" value="" placeholder="{{ _i('Code')}}"  required="">

                                    @if ($errors->has('code'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <!-- ================================== language =================================== -->
                            <div class="form-group " >
                                <label class="col-xs-3 control-label " for="lang_id">
                                    {{_i('Language')}} </label>
                                <div class="col-xs-8 " id="editCurrency">
                                    <select id="lang_select" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                        <option disabled > {{_i('Choose')}}</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
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

                                <label for="country_id" class="col-xs-3 control-label">{{_i('Country')}} </label>

                                <div class="col-xs-8">
                                    <input type="hidden" id="country_id_1" name="country_id" value="">
                                    <select required class="form-control select2 select2-hidden-accessible" name="country_id" id="country_id_2" style="width:100%" aria-hidden="true">
                                        <option value="" disabled>{{_i('Choose')}}</option>

                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif
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
    <!-- delete Modal -->
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Currencies')}}</li>
            </ol>
        </div>
    </nav>
    <div class="box box-info">
    <div class="box-body">
    <div class="blog common-wrapper" >
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-fw fa-plus-square"></i>
                    {{_i('Add New')}}
                </button>

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
                                <td>{{_i( \App\Models\Language::where('id' , $item->lang_id)->first()->title) }}</td>
                                <td>{{_i( \App\Models\Countries::where('id' , $item->country_id)->first()["title"]) }}</td>
                                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-success showEdit" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="fa fa-eye"></i> {{ _i('Show') }}
                                        <input type="hidden" name="request_id" class="item_id" value="{{$item->id}}" id="{{$item->id}}" >
                                    </button>
                                    <a style="color: #fff;" class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ url('admin/currency/' . $item->id . '/delete') }}" data-id="{{$item->id}}" data-target="#custom-width-modal">
                                        <i class="fa fa-trash"></i>
                                        {{ _i('Delete') }}
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
    </div>
    <!-- /.box-body -->

@endsection


<!-- ==============================footer=============================================-->

@section('footer')

    <script>
        //add form get countries
        $('#language_addform').click(function(){
            var languageID = $(this).val();
            console.log(languageID);
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/country/list')}}?lang_id="+languageID,
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
        $('#lang_select').click(function(){
            // var saved_lang = $("#saved_lang_id").val();
            var languageID = $(this).val();

            // var html = $("#country_id_2").append('<option selected> ' + cat + '</option>');
           loadCountries(languageID)

        });

function loadCountries(languageID, selected="")
{
     $.ajax({
                type:"GET",
                url:"{{url('admin/country/list')}}?lang_id="+languageID,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#country_id_2").empty();
                        html += $("#country_id_2").append('<option disabled >{{ _i('Choose') }}</option>');
                        extra ="";
                        $.each(res,function(key,value){
                            
                            if(selected !="" & selected==key)
                            {
                                extra ="selected";
                            }
                            // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            html += $("#country_id_2").append('<option '+extra+' value="'+key+'">'+value+'</option>');
                            extra ="";
                        });

                    }else{
                        $("#country_id_2").empty();
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
                console.log(item_id);
                $.ajax({
                    url:'{{ route('currencyShow') }}',
                    DataType:'json',
                    type:'get',
                    data: {item_id: item_id},
                    success:function (res) {
                        //console.log(res);
                         loadCountries(res.lang_id, res.country_id);
                        
                        $('#exampleModalCenter').find('#form_2').attr('action',"{{url('admin/currency/')}}/"+ item_id + '/update');
                        $('#exampleModalCenter').find('#title').val(res.title);
                        $('#exampleModalCenter').find('#code').val(res.code);
                        $('#exampleModalCenter').find('#rate').val(res.rate);
                        $('#exampleModalCenter').find('#lang_select').val(res.lang_id);
                        
                        $('#country_id_2 option[value="'+res.country_id+'"]').prop("selected",true)
                        //alert({{old('lang_id')}});
                    
                       // $("#editCurrency select").val(res.lang_value);

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
                $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
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

@endsection

