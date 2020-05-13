@extends('admin.layout.index',[
'title' => _i('Edit Category'),
'activePageName' => _i('Edit Category'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit category') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::model($category,['route' => ['categories.update',$category->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>{{ _i('create category') }}</span>
                </div>

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
                            @foreach($langs as $lang)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}" role="tabpanel" aria-expanded="false">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="{{ $lang->locale }}_title" class="form-control" value="{{ $category->translate($lang->locale)->title }}" placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}">
                                                {{ $category->translate($lang->locale)->title }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if(count($categories) > 0)

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Parent & Main Menu') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control" name="parent_id">
                                <option value="">{{_i('select ...')}}</option>
                                @foreach($categories as $item)
                                    <option @if($category->parent_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input type="checkbox" name="main_menu" @if($category->main_menu == 1) checked @endif value="1">
                                    <span class="cr float-right">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                    <span class="mr-4">{{ _i('Main Menu') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                @endif
            </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
