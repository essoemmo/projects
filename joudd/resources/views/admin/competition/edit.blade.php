
@extends('admin.layout.layout')
@section('title')
        {{_i('Edit competition')}}
@endsection


@section('page_header_name')
        {{_i('Edit competition')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Edit competition')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/competition/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/competition/'.$competition->id.'/update')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf

                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-- ================================== title =================================== -->
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"> {{_i('title')}} </label>

                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{ $competition->title }}" class="form-control" required="">
                            @if($errors->has('title'))
                                <strong>{{$errors->first('title')}}</strong>
                            @endif
                        </div>
                    </div>


                    <!-- ============================================= sart date ============================= -->
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label"> {{_i(' Start Date :')}} </label>

                        <div class="col-xs-6">
                            <input type="datetime-local" name="start" value="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                            @if($errors->has('start'))
                                <strong>{{$errors->first('start')}}</strong>
                            @endif
                        </div>
                        <label for="name" class="col-xs-2 control-label"> {{ $competition->start }} </label>
                    </div>

                    <!--========================================== end Date =======================================-->
                    <div class="form-group">

                        <label for="name" class="col-xs-2 control-label"> {{_i(' End Date :')}} </label>
                        <div class="col-xs-6">
                            <input type="datetime-local" name="end" value="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                            @if($errors->has('end'))
                                <strong>{{$errors->first('end')}}</strong>
                            @endif
                        </div>
                        <label for="name" class="col-xs-2 control-label"> {{ $competition->end }} </label>
                    </div>

                    <!----==========================  published ==========================--->
                    <!-- iCheck -->

                    <!-- checkbox -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="checkbox">
                            {{_i('Publish')}}
                        </label>
                        <div class="col-xs-6">

                            <label>
                                <input type="checkbox" @if($competition->is_active == 1) checked @endif class="minimal control-label" id="checkbox" name="is_active" value="1" >
                            </label>

                        </div>

                    </div>




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
