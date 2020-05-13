@extends('admin.layout.index',[
'title' => _i('Edit Country'),
'subtitle' => _i('Edit Country'),
'activePageName' => _i('Edit Country'),
'additionalPageUrl' => url('/admin/panel/countries') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Country') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('countries.update',$country->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body card-block">

                        @foreach ($languages as $lang)
                            @if (in_array($lang->id, $languageIds))
                                @foreach ($rowTranslation as $trans)
                                    @if ($lang->id == $trans->language_id)
                                        <div class="form-group">
                                            <label for="name[{{ $lang->id }}]" class="col-xs-2 exampleInputEmail1">{{ _i('Country Name') }}<span style="color: #F00;">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}">
                                                </span>
                                                    <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Country Name') }}" value="{{ $trans->name }}" required data-minlength="2">

                                                    <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">
                                                    @if ($errors->has('name[' .  $lang->id  . ']'))
                                                        <span class="text-danger invalid-feedback">
                                                    <strong>{{ $errors->first('name[' .  $lang->id  . ']') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            @else

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

                            @endif
                        @endforeach

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="iso_code">
                                {{ _i('Code') }} </label>
                            <input type="text" class="form-control" id="iso_code" name="iso_code" placeholder="{{ _i('Code') }}" value="{{ $country->iso_code }}" data-minlength="2">
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
                                    <option value="{{ $item->id }}"  @if($countryLanguages->containsStrict('language_id', $item->id)) selected @endif >{{ $item->name }}</option>
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
                                <option value="0" {{ ($country->default_country == 0 ? "selected":"") }}>{{ _i('No') }}</option>
                                <option value="1" {{ ($country->default_country == 1 ? "selected":"") }}>{{ _i('Yes') }}</option>
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
                                <option value="0" {{ ( $country->input_status == 0 ? "selected":"") }}>{{ _i('Enabled') }}</option>
                                <option value="1" {{ ( $country->input_status == 1 ? "selected":"") }}>{{ _i('Disabled') }}</option>
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
                            <img class="img-responsive pad" src="{{ asset('/images/countries/'. $country->image) }}" id="image">
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ _i('save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection
