
@extends('admin.layout.index',[
'title' => _i('Add Category '),
'subtitle' => _i('Add Category '),
'activePageName' => _i('Add Category'),
'additionalPageUrl' => url('/admin/panel/categories') ,
'additionalPageName' => _i('All'),
] )


@push('css')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css"></style>
<style type="text/css">
.form-group {
    margin-top: 15px;
}

</style>
@endpush
{{--@include('boilerplate::load.icheck')--}}
@section('content')
{{-- {{ Form::open(['route' => 'boilerplate.categories.store', 'autocomplete' => 'off', 'class' =>
'form-horizontal']) }} --}}
<form class="form-horizontal" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" data-parsley-validate="" id="addForm" role="form" data-toggle="validator" >
    @csrf

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("categories.index") }}" class="btn btn-default">
                               <i class="ti-list"></i> {{_i('Categories List') }}
                            </a></li>
                        <li class="breadcrumb-item active pull-left"><button type="submit" class="btn btn-primary">
                                <i class="ti-save"></i>{{_i('save') }}
                            </button></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">{{ _i('Add Category') }}</h5>
                        </div>
{{--                    {{dd($language_id)}}--}}
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label  for="parent_id">{{ _i('Parent') }}</label>
                                    <select class="form-control" style="width: 100%;" id="parent_id" name="parent_id">
                                        <option value="0" {{ ( old("parent_id") == 0 ? "selected":"") }}>{{ _i('None') }}</option>

                                        @foreach ($categories as $item)

                                            <option value="{{ $item->id }}" {{ ( old("parent_id") == $item->id ? "selected":"") }}>{{ $item->getParentsNames($language_id) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="input-status"></label>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="top" value="1" id="top" checked>{{ _i('Top Menu') }}&nbsp;</label>
                                        </div>
                                    </div>

                                    <label for="sort_order" class="col-md-4 control-label">{{ _i('Sort Order') }}</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" min="1" id="sort_order" name="sort_order" placeholder="{{ _i('Sort Order') }}" data-parsley-type="number" value="{{ old('sort_order', 1) }}">
                                    </div>

                                    <label class="col-md-4 control-label" for="input-status">{{ _i('Status') }}</label>
                                    <div class="col-md-4">
                                        <select name="status" id="input-status" class="form-control">
                                            <option value="0" {{ ( old("status") == 0 ? "selected":"") }}>{{ _i('Enabled') }}</option>
                                            <option value="1" {{ ( old("status") == 1 ? "selected":"") }}>{{ _i('Disabled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="" id="tab-data">
                                    <div class="col-sm-1"></div>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Custom Tabs -->
                                            <div class="card">
                                                <div class="d-flex p-0">
                                                    <ul class="nav nav-pills ml-auto p-2">
                                                        {{--                                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Tab 1</a></li>--}}
                                                        {{--                                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Tab 2</a></li>--}}
                                                        {{--                                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a></li>--}}

                                                        @foreach ($languages as $lang)
                                                            <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#language{{ $lang->id }}" data-toggle="tab">
                                                                    <img src="{{ asset('languages/'.$lang->image) }}"> {{ _i($lang->name) }} <i class="fa"></i></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        @foreach ($languages as $lang)
                                                            <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">
                                                                <span></span>
                                                                <div class="form-group">
                                                                    <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Category Name') }}<span style="color: #F00;">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" required=""  id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Category Name') }}" value="{{ old('name['.$lang->id.']') }}" data-minlength="2">
                                                                        {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="meta_title[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Title') }}<span style="color: #F00;">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="meta_title[{{ $lang->id }}]" name="meta_title[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Title') }}" required="" value="{{ old('meta_title['.$lang->id.']') }}">
                                                                        <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                                                                        @if ($errors->has('meta_title['.$lang->id.']'))
                                                                            <span class="text-danger invalid-feedback">
                                                    <strong>{{ $errors->first('meta_title['.$lang->id.']') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control ckeditor" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">{{ old('description['.$lang->id.']') }}</textarea>
                                                                        {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="meta_description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Description') }}</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" id="meta_description[{{ $lang->id }}]" name="meta_description[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Description') }}" rows="5">{{ old('meta_description['.$lang->id.']') }}</textarea>
                                                                        @if ($errors->has('meta_description['.$lang->id.']'))
                                                                            <span class="text-danger invalid-feedback">
                                                    <strong>{{ $errors->first('meta_description['.$lang->id.']') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="meta_keyword[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Keywords') }}</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" id="meta_keyword[{{ $lang->id }}]" name="meta_keyword[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Keywords') }}" rows="5">{{ old('meta_keyword['.$lang->id.']') }}</textarea>
                                                                        @if ($errors->has('meta_keyword['.$lang->id.']'))
                                                                            <span class="text-danger invalid-feedback">
                                                    <strong>{{ $errors->first('meta_keyword['.$lang->id.']') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div><!-- /.card-body -->
                                            </div>
                                            <!-- ./card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                </div>

                            </div>
{{--                            <!-- /.card-body -->--}}

{{--                            <div class="card-footer">--}}
{{--                                <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                            </div>--}}

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

{{--     {{ Form::close() }} --}}
</form>
@endsection
{{--@include('boilerplate::load.select2')--}}
{{--@include('boilerplate::load.fileinput')--}}
@push('js')
<script src="{{ asset('dashboard/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
<script>
{{--$('#parent_id').select2();--}}

{{--// $('#image').fileinput({--}}
{{--//     showUpload: false,--}}
{{--//     uploadAsync: false--}}
{{--// });--}}

</script>
@endpush
