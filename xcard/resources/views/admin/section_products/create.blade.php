
@extends('admin.layout.index',[
'title' => _i('Add Home Page Section'),
'subtitle' => _i('Add Home Page Section'),
'activePageName' => _i('Add Home Page Section'),
'additionalPageUrl' => url('/admin/panel/section_products') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="card">
        <div class="card-header">
            <h5>{{ _i('add new Home Page Section') }}</h5>
        </div>
        <div class="card-block">
            <form role="form" action="{{route('section_products.store')}}" class="j-forms" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}


            <div class="content">

                <!---
                <div class="form-group">
                    <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                        {{ _i('Languages') }} </label>
                    <select class="form-control" style="width: 100%;" id="lang_id" name="lang_id" >
                        <option disabled selected>{{ _i('Select') }}</option>
                        @foreach ($langs as $item)
                            <option value="{{ $item->id }}"  {{ ( old("lang_id") == $item->id ? "selected":"") }} >{{ $item->title }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('lang_id'))
                        <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('lang_id') }}</strong>
                            </span>
                    @endif
                </div>
                -->

                <!---
                <div class="form-group">
                    <label class="col-xs-2 exampleInputEmail1" for="title">
                        {{ _i('Title') }} </label>
                    <input type="text" name="title" id="title" class="form-control" required data-validate="true">
                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                    @endif
                </div>
                -->

                @foreach($langs as $lang)
                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="title">
                            {{$lang->title}} {{ _i('Title') }} </label>
                        <input type="text" name="{{ $lang->locale }}_title" id="title" value="{{ old($lang->locale.'_title') }}" class="form-control" required data-validate="true">

                    </div>
                @endforeach

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


                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('Select Product') }}</span>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ _i('Products') }}</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-multiple form-control" name="product_id[]" data-tags="true" data-placeholder="{{ _i('Select a Product') }}"  multiple="multiple" required="">
                                    @foreach($products as $key =>  $item)
                                        <option value="{{ $key }}"  {{ ( old("product_id") == $key ? "selected":"") }} >{{ $item }}</option>
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
