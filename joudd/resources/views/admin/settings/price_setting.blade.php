@extends('admin.layout.layout')

@section('title')
    {{_i('Price Setting')}}
@endsection

@section('box-title' )
    {{_i('Website commission rate')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Website commission rate setting')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/price_setting')}}">{{_i('Price Setting')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/price_setting')}}" method="post" class="form-horizontal"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    @if($price_setting == null)
                    <!----===================================== bill ===============================--------->

                    <div class="form-group row">
                        <label for="gender" class="col-xs-4 control-label">{{_i('Type')}}</label>
                        <div class="col-xs-5">
                            <input class="form-check-input" required type="radio" name="type" id="optionsRadios1" value="net" checked>
                            <label class="form-check-label" for="optionsRadios1"> {{_i(' Amount ')}} </label>

                            <input class="form-check-input" required type="radio" name="type" id="optionsRadios2" value="perc">
                            <label class="form-check-label" for="optionsRadios2"> {{_i('Percent')}} </label>

                        </div>
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="price_setting">
                            {{_i('Amount')}} </label>
                        <div class="col-xs-6">
                            <input type="number" name="price" value="" id="price_setting" class="form-control" placeholder="{{_i('Amount')}}"
                                   data-parsley-maxlength="8" required="">
                        </div>
                    </div>

                     @else

                            <div class="form-group row">
                                <label for="gender" class="col-xs-4 control-label">{{_i('Type')}}</label>
                                <div class="col-xs-5">
                                    <input class="form-check-input" required type="radio" name="type" id="optionsRadios1" value="net" {{$price_setting->type == "net" ? 'checked' : ''}} >
                                    <label class="form-check-label" for="optionsRadios1"> {{_i(' Amount ')}} </label>

                                    <input class="form-check-input" required type="radio" name="type" id="optionsRadios2" value="perc" {{$price_setting->type == "perc" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="optionsRadios2"> {{_i('Percent')}} </label>

                                </div>
                            </div>

                            <div class="form-group row" >

                                <label class="col-xs-2 col-form-label " for="price_setting">
                                    {{_i('Amount')}} </label>
                                <div class="col-xs-6">
                                    <input type="number" name="price" value="{{$price_setting->price}}" id="price_setting" class="form-control" placeholder="{{_i('Amount')}}"
                                           data-parsley-maxlength="8"  required="">
                                </div>
                            </div>

                    @endif

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>


@endsection


