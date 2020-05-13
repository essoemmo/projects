@extends('admin.layout.index',[
'title' => _i('Edit Home Page Section'),
'subtitle' => _i('Edit Home Page Section'),
'activePageName' => _i('Edit Home Page Section'),
'additionalPageUrl' => url('/admin/panel/section_products') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Home Page Section') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('section_products.update',$content->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                                {{ _i('Languages') }} </label>
                            <select class="form-control" style="width: 100%;" id="lang_id" name="lang_id" required data-validate="true">
                                <option disabled selected>{{ _i('Select') }}</option>
                                @foreach ($languages as $item)
                                    @if($content_data != null)
                                        <option value="{{ $item->id }}"  {{ ( $content_data->lang_id == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endif
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
                            <input type="text" name="title" id="title" value="{{ $content->title }}" class="form-control">
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
                                <option @if($content->order == 1) selected @endif value="1">1</option>
                                <option @if($content->order == 2) selected @endif value="2">2</option>
                                <option @if($content->order == 3) selected @endif value="3">3</option>
                                <option @if($content->order == 4) selected @endif value="4">4</option>
                                <option @if($content->order == 5) selected @endif value="5">5</option>
                                <option @if($content->order == 6) selected @endif value="6">6</option>
                                <option @if($content->order == 7) selected @endif value="7">7</option>
                                <option @if($content->order == 8) selected @endif value="8">8</option>
                                <option @if($content->order == 9) selected @endif value="9">9</option>
                                <option @if($content->order == 10) selected @endif value="10">10</option>
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
                            <select class="form-control selectpicker" multiple style="width: 100%;" id="country_id" name="country_id[]" required="" data-validate="true">
                                @foreach ($country as $coun)
                                    @foreach ($coun->hasDescription->where('language_id',checknotsessionlang()) as $co)
                                        <option value="{{$co->country_id}}"
                                                @foreach($section_country as $item)
                                                    @if($item['country_id'] == $co->country_id) selected @endif
                                                @endforeach >
                                            {{ $co->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="product_id">
                                {{ _i('Products') }} </label>
                            <select class="form-control selectpicker" multiple style="width: 100%;" id="product_id" name="product_id[]" required data-validate="true">
                                @foreach ($products as $key =>  $item)
                                    <option value="{{ $key }}"  @foreach($section_product as $product)
                                        @if($product->product_id == $key)
                                            selected
                                        @endif
                                    @endforeach
                                    >{{ $item }}</option>
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
                        <button type="submit" class="btn btn-primary">{{ _i('save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection
