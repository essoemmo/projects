
@extends('admin.layout.index',[
'title' => _i('Add Country'),
'subtitle' => _i('Add Country'),
'activePageName' => _i('Add Country'),
'additionalPageUrl' => url('/admin/panel/Countries') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
{{--                        <li class="breadcrumb-item"><a href="{{url('/admin/panel/transferBank')}}" class="btn btn-default"><i class="ti-list"></i>{{ _i('All Banks') }}</a></li>--}}

                    </ol>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">

            <div class="card-header">
                <h5 >{{ _i('add new Country') }}</h5>
                <div class="card-header-right">
{{--                    <i class="icofont icofont-rounded-down"></i>--}}
{{--                    <i class="icofont icofont-refresh"></i>--}}
{{--                    <i class="icofont icofont-close-circled"></i>--}}
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('countries.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">

                    @foreach ($languages as $lang)
                    <div class="form-group">
                        <label for="name[{{ $lang->id }}]" class="col-xs-2 exampleInputEmail1">{{ _i('Country Name') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}">
                                    </span>
                                <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Country Name') }}" value="{{ old('name['.$lang->id.']') }}" required data-minlength="2">
                                @if ($errors->has('name[' .  $lang->id  . ']'))
                                    <span class="text-danger invalid-feedback">
                                        <strong>{{ $errors->first('name[' .  $lang->id  . ']') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                        </div>
                    </div>
                    @endforeach

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="iso_code">
                            {{ _i('Code') }} </label>
                        <input type="text" class="form-control" id="iso_code" name="iso_code" placeholder="{{ _i('Code') }}" value="{{ old('iso_code') }}" data-minlength="2">
                        @if ($errors->has('iso_code'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('iso_code') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="language_ids">
                            {{ _i('Languages') }} </label>
                            <select class="form-control selectpicker" multiple="multiple" style="width: 100%;" id="language_ids[]" name="language_ids[]" required data-validate="true">
                                @foreach ($languages as $item)
                                    <option value="{{ $item->id }}"  {{ ( old("language_ids[]") == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        @if ($errors->has('language_ids'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('language_ids') }}</strong>
                            </span>
                        @endif
                    </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="default_country">
                                {{ _i('Default') }} </label>
                                <select name="default_country" id="default_country" class="form-control">
                                    <option value="0" {{ ( old("default_country") == 0 ? "selected":"") }}>{{ _i('No') }}</option>
                                    <option value="1" {{ ( old("default_country") == 1 ? "selected":"") }}>{{ _i('Yes') }}</option>
                                </select>
                            @if ($errors->has('default_country'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('default_country') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="input-status">
                                {{ _i('Status') }} </label>
                                <select name="status" id="input-status" class="form-control">
                                    <option value="0" {{ ( old("status") == 0 ? "selected":"") }}>{{ _i('Enabled') }}</option>
                                    <option value="1" {{ ( old("status") == 1 ? "selected":"") }}>{{ _i('Disabled') }}</option>
                                </select>
                            @if ($errors->has('input-status'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('input-status') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="image">{{_i('Image')}}</label>
                            <input type="file" name="image" id="image" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                   value="{{old('image')}}">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>
                            <!-- Photo -->
                            <img class="img-responsive pad" id="image" >
                        </div>


            </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i>{{_i('Save')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
@endsection
