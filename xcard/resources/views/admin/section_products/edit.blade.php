@extends('admin.layout.index',[
'title' => _i('Edit Home Page Section'),
'subtitle' => _i('Edit Home Page Section'),
'activePageName' => _i('Edit Home Page Section'),
'additionalPageUrl' => url('/admin/panel/section_products') ,
'additionalPageName' => _i('All'),
] )


@section('content')



    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Edit Home Page Section') }}</h5>
        </div>
        <div class="card-block">
            <form role="form" class="j-forms" action="{{route('section_products.update',$content->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('put')}}


                <div class="content">

                    <!----
                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                            {{ _i('Languages') }} </label>
                        <select class="form-control" style="width: 100%;" id="lang_id" name="lang_id" required data-validate="true">
                            <option disabled selected>{{ _i('Select') }}</option>
                            @foreach ($languages as $item)
                                <option value="{{ $item->id }}"  {{ ( $content_data->locale == $item->id ? "selected":"") }} >{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('lang_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    -->

                    @foreach($languages as $lang)
                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="title">
                                {{$lang->title}} {{ _i('Title') }} </label>
                        <input type="text" name="{{ $lang->locale }}_title" id="title" value="{{ $contents_title->where('locale' ,$lang->locale )->first()['title'] }}" class="form-control" required data-validate="true">

                    </div>
                    @endforeach


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


                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Select Product') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Products') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" name="product_id[]" data-tags="true" data-placeholder="{{ _i('Select a Product') }}"  multiple="multiple" required="">
                                        @foreach ($products as $key =>  $item)
                                            <option value="{{ $key }}"
                                                    @foreach($section_product as $product)
                                                        @if($product->product_id == $key)
                                                            selected
                                                        @endif
                                                    @endforeach
                                            >{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>


    </div>




@endsection
