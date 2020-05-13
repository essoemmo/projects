@extends('admin.layout.index',[
'title' => _i('Edit Blog'),
'activePageName' => _i('Edit Blog'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit blog') }}</h5>
        </div>
        {!! Form::model($blog,['route' => ['blog.update',$blog->id], 'method' => 'PUT','files'=>true, 'data-parsley-validate']) !!}
        <div class="row">
            <div class="col-sm-8">
                <div class="card-block">
                    @csrf
                    @honeypot {{--prevent form spam--}}
                    <div class="content">

                        <div class="row form-group">
                            <div class="col-lg-12">

                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    @foreach($langs as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab"
                                               href="#{{ $lang->locale }}" role="tab"
                                               aria-expanded="false">{{ $lang->title }}</a>
                                            <div class="slide"></div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content card-block">
                                    @foreach($langs as $lang)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}"
                                             role="tabpanel" aria-expanded="false">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                           value="{{ $blog->translate($lang->locale)->title }}"
                                                           name="{{ $lang->locale }}_title" class="form-control"
                                                           placeholder="{{ $lang->title }} {{ _i('Title') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('content') }}</label>
                                                <div class="col-sm-10">
                                                    <textarea name="{{ $lang->locale }}_content"
                                                              class="form-control ckeditor"
                                                              placeholder="{{ $lang->title }} {{ _i('content') }}"
                                                              required="">
                                                        {{ $blog->translate($lang->locale)->content }}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Seo') }}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Meta Title') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="{{ $lang->locale }}_meta_title"
                                                           value="{{ $blog->translate($lang->locale)->meta_title }}"
                                                           class="form-control"
                                                           placeholder="{{ $lang->title }} {{ _i('Meta Title') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Meta Description') }}</label>
                                                <div class="col-sm-10">
                                            <textarea rows="5" cols="5" name="{{ $lang->locale }}_meta_description"
                                                      class="form-control"
                                                      placeholder="{{ $lang->title }} {{ _i('Meta Description') }}">
                                                {{ $blog->translate($lang->locale)->meta_description }}
                                            </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Meta Keywords') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="{{ $lang->locale }}_meta_keywords"
                                                           value="{{ $blog->translate($lang->locale)->meta_keywords }}"
                                                           class="form-control"
                                                           placeholder="{{ _i('Meta Keywords (key1,key2,key3)') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-content card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ _i('image') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" onchange="showImg(this)"
                                                   name="image">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content card-block">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <img class="img-fluid pad" style="width: 150px" src="{{ $blog->image }}"
                                                 id="image">
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
                                                <input type="radio" @if($blog->publish == 1) checked
                                                       @endif name="publish" value="1" required>
                                                <i class="helper"></i>{{ _i('publish') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio radiofill radio-primary radio-inline">
                                            <label>
                                                <input type="radio" @if($blog->publish == 2) checked
                                                       @endif name="publish" value="2" required>
                                                <i class="helper"></i>{{ _i('draft') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
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
                            <!----
                                <div class="col-sm-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($blog->category_id == null) checked @endif name="category_id" value="">
                                            <span class="cr float-right">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                            <span class="mr-4">{{ _i('no category') }}</span>
                                        </label>
                                    </div>
                                </div>
                                -->

                                <select class="form-control" name="category_id" required="">
                                    <option selected disabled><?=_i('CHOOSE')?></option>
                                    @foreach($categories as $category)
                                        <option
                                            value="<?=$category['id']?>" <?=$blog->category_id == $category['id'] ? 'selected' : ''?> ><?=_i($category['title'])?></option>
                                    @endforeach
                                </select>

                            <!----
                                @foreach($categories as $category)
                                <div class="col-sm-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($blog->category_id == $category->id) checked @endif name="category_id" value="{{ $category->id }}">
                                                <span class="cr float-right">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                <span class="mr-4">{{ $category->title }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                -->

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
                                <select class="js-example-basic-multiple form-control" data-tags="true"
                                        data-placeholder="{{ _i('Select an option') }}" name="tag_id[]"
                                        multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option
                                            @foreach($blog_tags as $item) {{ $tag->id ==  $item->tag_id  ? 'selected' : ''}} @endforeach value="{{$tag->id}}"> {{$tag->title}}</option>
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
