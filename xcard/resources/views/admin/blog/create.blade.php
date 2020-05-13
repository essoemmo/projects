@extends('admin.layout.index',[
'title' => _i('Create Blog'),
'activePageName' => _i('Create Blog'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create blog') }}</h5>
        </div>
            {!! Form::open(['route' => 'blog.store', 'method' => 'POST','files'=>true, 'data-parsley-validate']) !!}
                <div class="row">
                <div class="col-sm-8">
                    <div class="card-block">
                    @csrf
                    <div class="content">

                        <div class="row form-group">
                            <div class="col-lg-12">

                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    @foreach($langs as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                            <div class="slide"></div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content card-block">
                                    @foreach($langs as $key => $lang)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}" role="tabpanel" aria-expanded="false">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="{{ $lang->locale }}_title" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}" @if($key == 0)required @endif>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('content') }}</label>
                                                <div class="col-sm-10">
                                                    <textarea name="{{ $lang->locale }}_content" class="form-control editor" placeholder="{{ $lang->title }} {{ _i('content') }}" @if($key == 0)required @endif></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-content card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ _i('image') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" onchange="showImg(this)" name="image" >
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content card-block">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <img class="img-fluid pad" style="width: 150px" id="image">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
                <div class="col-sm-4">
                    <div class="card-block">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-left">{{ _i('publish') }}</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="form-radio">
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <div class="radio radiofill radio-primary radio-inline">
                                                <label>
                                                    <input type="radio" name="publish" value="1" required>
                                                    <i class="helper"></i>{{ _i('publish') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="radio radiofill radio-primary radio-inline">
                                                <label>
                                                    <input type="radio" name="publish" value="2" required>
                                                    <i class="helper"></i>{{ _i('draft') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-left">{{ _i('categories') }}</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row form-group">
                                    @if(count($categories) > 0)
                                            <select  class="form-control" name="category_id" required="">
                                                <option selected disabled><?=_i('CHOOSE')?></option>
                                                @foreach($categories as $category)
                                                    <option value="<?=$category['id']?>" <?=old('lang_id') == $category['id'] ? 'selected' : ''?> ><?=_i($category['title'])?></option>
                                                @endforeach
                                            </select>

                                    <!-----
                                    @foreach($categories as $category)
                                            <div class="col-sm-12">
                                                <div class="checkbox-fade fade-in-primary">
                                                    <label>
                                                        <input type="checkbox" name="category_id" value="{{ $category->id }}">
                                                        <span class="cr float-right">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                        <span class="mr-4">{{ $category->title }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        --->
                                    @else
                                        <div class="col-sm-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" name="category_id" value="" disabled="">
                                                    <span class="cr float-right">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span class="mr-4">{{ _i('no category') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-left">{{ _i('tags') }}</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row form-group">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select an option') }}" name="tag_id[]" multiple="multiple">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}"> {{$tag->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {!! Form::close() !!}
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

@endpush
