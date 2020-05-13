@extends('master.layout.index',[
'title' => _i('Country'),
'subtitle' => _i('Country'),
'activePageName' => _i('Country'),
'additionalPageUrl' => url('/master/country/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card">

            <div class="card-title">
                <h5>{{_i('Edit Country')}}</h5>
            </div>

            <div class="card-block">
            <form  action="{{url('master/country/'.$country->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                @csrf
                @method('put')
                <div class="box-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="lang_id" id="language_addform" required="">
                                <option selected disabled="">{{_i('CHOOSE')}}</option>
                                @foreach($langs as $lang)
                                    <option value="{{$lang->id}}" {{$country_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                                @endforeach
                            </select>
                            <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                        </div>
                    </div>


                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="{{$country_data->title}}" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="code">
                            {{_i('Code')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="code" value="{{$country->code}}" id="code" required="" class="form-control">
                            @if ($errors->has('code'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="logo">{{_i('Logo')}}</label>

                        @if(is_file(public_path('uploads\\countries\\'.$country->id.'\\'.$country->logo)))
                            <div class="col-sm-4">
                                <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                            </div>

                            <div class="col-sm-6">
                                <img src="{{ asset('uploads/countries/'.$country->id.'/'.$country->logo) }}" id="old_img"  style="margin: 0 auto; width: 300px; height: 250px;display: block;" class="img-thumbnail">
                            </div>
                        @else

                            <div class="col-sm-4">
                                <input type="file" name="logo" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong> </span>
                            </div>
                            <!-- Photo -->
                        <div class="col-sm-6">
                            <img src="{{ asset('uploads/countries/'.$country->id.'/'.$country->logo) }}" class="img-responsive pad" id="new_img" style="margin: 0 auto; width: 300px; height: 250px;display: block;">
                        </div>
                        @endif
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
</div>


@endsection

@push('js')
    <script>



    </script>

@endpush
