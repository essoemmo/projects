
@extends('admin.layout.index',[
'title' => _i('Add Home Page Section'),
'subtitle' => _i('Add Home Page Section'),
'activePageName' => _i('Add Home Page Section'),
'additionalPageUrl' => url('/admin/panel/section_products') ,
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
                <h5 >{{ _i('add new Home Page Section') }}</h5>
                <div class="card-header-right">
{{--                    <i class="icofont icofont-rounded-down"></i>--}}
{{--                    <i class="icofont icofont-refresh"></i>--}}
{{--                    <i class="icofont icofont-close-circled"></i>--}}
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('section_products.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                            {{ _i('Languages') }} </label>
                            <select class="form-control" style="width: 100%;" id="lang_id" name="lang_id" required data-validate="true">
                                <option disabled selected>{{ _i('Select') }}</option>
                                @foreach ($languages as $item)
                                    <option value="{{ $item->id }}"  {{ ( old("lang_id") == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('lang_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="title">
                            {{ _i('Title') }} </label>
                        <input type="text" name="title" id="title" class="form-control">
                        @if ($errors->has('title'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="order">
                            {{ _i(' Order ') }} </label>
                        <select class="form-control" style="width: 100%;" id="order" name="order" required data-validate="true">
                            <option disabled selected>{{ _i('Select') }}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        @if ($errors->has('order'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('order') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-------------------   choose country ------>
                    <div class="form-group">
                        <label class="col-xs-2 " for="country_id"> {{_i('Countries')}} </label>
{{--                        <select class="form-control" name="country_id" required="">--}}
{{--                            <option selected disabled>{{_i('Choose Country....')}}</option>--}}
{{--                            @foreach ($country as $coun)--}}
{{--                                @foreach($coun->hasDescription->where('language_id',checknotsessionlang()) as $co )--}}
{{--                                    <option value="{{$co->country_id}}">{{$co->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                        <select class="form-control selectpicker" multiple style="width: 100%;" id="country_id" name="country_id[]" required="" data-validate="true">
                            @foreach ($country as $coun)
                                @foreach ($coun->hasDescription->where('language_id',checknotsessionlang()) as $co)
                                    <option value="{{$co->country_id}}"  {{ ( old("country_id") == $co->country_id ? "selected":"") }} >{{ $co->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="product_id">
                            {{ _i('Products') }} </label>
                        <select class="form-control selectpicker" multiple style="width: 100%;" id="product_id" name="product_id[]" required data-validate="true">
{{--                            <option disabled selected>{{ _i('Select') }}</option>--}}
                            @foreach ($products as $key =>  $item)
                                <option value="{{ $key }}"  {{ ( old("product_id") == $key ? "selected":"") }} >{{ $item }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_id'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('product_id') }}</strong>
                            </span>
                        @endif
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
