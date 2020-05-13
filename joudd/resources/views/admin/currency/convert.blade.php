@extends('admin.layout.layout')

<!-- ==============================Head=============================================-->
@section('title')
{{_i('Currencies')}}
@endsection

@section('page_header')
<section class="content-header">
    <h1>
        {{_i('Currency Rates')}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
        <li class="active"><a href="{{url('/admin/convert')}}">{{_i('All')}}</a></li>
    </ol>
</section>
@endsection

<!-- ==============================Main=============================================-->

@section('content')


<div class="box box-info">
    <div class="box-body">
        <div class="blog common-wrapper" >
            <div class="row">
                <div class="col-sm-12">


                    <div class="form-group row" >

                        <label class="col-xs-3 col-form-label " for="id">
                            {{_i('ID')}} </label>

                        <label class="col-xs-3 col-form-label " for="id">
                            {{_i('Code')}} </label>

                        <label class="col-xs-3 col-form-label " for="id">
                            {{_i('Rate')}} </label>
                    </div>

                    <form action="" method="POST" class="remove-record-model">
                        <?php foreach ($currencies as $currency) { ?>
                            @csrf


                            <div class="form-group row" >


                                <div class="col-xs-3">
                                    {{$currency->id}}
                                </div>
                                <div class="col-xs-3">
                                    <input value=" {{$currency->country_code}}" type="text" name="code[]"  id="txtUser" required="" class="form-control">


                                </div>
                                <div class="col-xs-3">
                                    <input value=" {{$currency->rate}}" type="text" name="rate[]"  id="txtUser" required="" class="form-control">

                                </div>
                            </div>



                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-fw fa-plus-square"></i>
                            {{_i('Save')}}
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /.box-body -->

@endsection

