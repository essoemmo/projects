

@extends('admin.AdminLayout.index')

@section('title')
{{_i('index')}}
@endsection

@section('content')


    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card">

            <h5 class="card-header">{{_i('Edit currency')}}</h5>

            <div class="card-block">

<div class="box box-default">

    <div class="box-body">


        <form  action="{{url('/adminpanel/settings/currency/'.$currency->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

            @csrf
            <div class="box-body">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                    <div class="col-sm-6">
                        <select class="form-control" name="lang_id" id="language_addform" required="">
                            <option selected disabled="">{{_i('CHOOSE')}}</option>
                            @foreach($langs as $lang)
                                <option value="{{$lang->id}}" {{$currency_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                            @endforeach
                        </select>
                        <small  class="form-text text-muted">{{_i('Please select language')}}</small>
                    </div>
                </div>

                <!-- ================================== lang =================================== -->
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>
                            <input type="checkbox" class="js-single" id="checkbox" name="show" value="1" {{$currency->show == 1 ? 'checked' : ''}} >
                            {{_i('show')}}
                        </label>
                    </div>
                </div>

                <!-- ================================== Title =================================== -->
                <div class="form-group row ">
                    <label for="name" class="col-md-1 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span> </label>
                    <div class="col-md-11">
                        <input  type="text" class="form-control" name="title" placeholder="{{_i('Currency Title')}}"
                                value="{{$currency_data->title}}" data-parsley-length="[3, 191]" required="">

                        <span class="text-danger invalid-feedback">
                             <strong>{{$errors->first('title')}}</strong>
                        </span>

                    </div>
                </div>


                <div class="form-group row ">
                    <label for="name" class="col-md-1 col-form-label"> {{_i('Code')}} <span style="color: #F00;">*</span> </label>
                    <div class="col-md-11">
                        <input  type="text" class="form-control" name="code" placeholder="{{_i('Currency Code')}}"
                                value="{{$currency->code}}" data-parsley-length="[3, 191]" required="">

                        <span class="text-danger invalid-feedback">
                             <strong>{{$errors->first('code')}}</strong>
                        </span>

                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <button type="submit" class="btn btn-info pull-left col-md-12" >
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


@endsection

