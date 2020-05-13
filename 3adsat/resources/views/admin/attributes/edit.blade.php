
@extends('admin.layout.index',[
'title' => _i('Edit Attributes '),
'subtitle' => _i('Edit Attributes '),
'activePageName' => _i('Edit Attributes'),
'additionalPageUrl' => url('/admin/panel/attributes') ,
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

@section('content')
<form class="form-horizontal" action="{{ route('attributes.update', ['id' => $rowData->id]) }}" method="POST" enctype="multipart/form-data" data-parsley-validate="" id="editForm" role="form" data-toggle="validator">
    @csrf
    {{ method_field('PUT') }}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("attributes.index") }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('Attributes List') }}</a></li>
                        <li class="breadcrumb-item active"><button type="submit" class="btn btn-primary">
                             <i class="ti-save"></i>   {{ _i('save') }}
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
                            <h3 class="card-title">{{ _i('Edit Attributes ') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            @foreach ($languages as $lang)
                                @if (in_array($lang->id, $languageIds))
                                    @foreach ($rowTranslation as $trans)
                                        @if ($lang->id == $trans->language_id)

                                            <div class="form-group">
                                                <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Attribute Name') }}<span style="color: #F00;">*</span></label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}">
                                            </span>
                                                        <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Attribute Name') }}" value="{{ old('name['.$lang->id.']', $trans->name) }}" required="" data-minlength="2">
                                                        {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                    <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>

                                                    <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else

                                    <div class="form-group">
                                        <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Attribute Name') }}<span style="color: #F00;">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}">
                                </span>
                                                <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Attribute Name') }}" value="{{ old('name['.$lang->id.']') }}" required="" data-minlength="2">
                                                {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                            </div>
                                            <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>

                                            <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="0">
                                        </div>
                                    </div>

                                @endif
                            @endforeach

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="attribute_group_id">{{ _i('Attribute Group') }}</label>
                                <div class="col-sm-10">
                                    <select class="form-control" style="width: 100%;" id="attribute_group_id" name="attribute_group_id" required data-validate="true">
                                        <option value="" {{ ( old("attribute_group_id") == "" ? "selected":"") }} >  </option>
                                        @foreach ($attributeGroups as $item)
                                            <option value="{{ $item->id }}"  {{ ( old("attribute_group_id", $rowData->attribute_group_id) == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="col-sm-2 control-label">{{ _i('Sort Order') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" min="1" id="sort_order" name="sort_order" placeholder="{{ _i('Sort Order') }}"  value="{{ old('sort_order', $rowData->sort_order) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status">{{ _i('Status') }}</label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <option value="0" {{ ( old("status", $rowData->status) == "0" ? "selected":"") }}>{{ _i('Enabled') }}</option>
                                        <option value="1" {{ ( old("status", $rowData->status) == "1" ? "selected":"") }}>{{ _i('Disabled') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</form>
@endsection
@push('js')
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
@endpush
