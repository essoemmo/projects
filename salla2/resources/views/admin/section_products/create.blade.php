@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Add Home Page Section')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{ _i('Add Home Page Section') }}
@endsection

@section('content')
    <!-- /.box-header -->
    <!-- =====Filter Section===== -->
    <div class="box-body">
        <form role="form" action="{{route('section_products.store')}}"  method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
            {{csrf_field()}}
            {{method_field('post')}}

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('section_products.index')}}"
                                                               class="btn btn-default"> <i class="ti-list"></i> {{ _i('All Home Page Section') }}</a></li>
                                <li class="breadcrumb-item active">
                                    <a href="{{route('section_products.store')}}">
                                        <button type="submit" class="btn btn-primary"> <i class="ti-save"></i>
                                            {{ _i('Save') }}
                                        </button>
                                    </a>
                                </li>
                            </ol>

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <div class="row">
                <!-- left column -->
                <div class="col-sm-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5>{{ _i('Add Home Page Section') }}</h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                                <i class="icofont icofont-refresh"></i>
                                <i class="icofont icofont-close-circled"></i>
                            </div>

                        </div>
                        <div class="card-body card-block">

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

                            <div class="form-group">
                                <label class="col-xs-2 exampleInputEmail1" for="title">{{ _i('Title') }} </label>
                                <input type="text" name="title" id="title" value="" class="form-control" required data-validate="true">
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ _i('Products') }}</label>
                                        <div class="col-sm-12">
                                            <select class="selectpicker col-sm-12" multiple="multiple" name="product_id[]" data-tags="true" data-placeholder="{{ _i('Select a Product') }}"  multiple="multiple" required="">
                                                @foreach($products as $key =>  $item)
                                                    <option value="{{ $key }}"  {{ ( old("product_id") == $key ? "selected":"") }} >{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
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

                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>

@endsection

@push('css')
    <!-- Select 2 css -->
<link rel="stylesheet" href="{{asset('AdminFlatAble/bower_components/select2/css/select2.min.css')}}" />
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminFlatAble/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('AdminFlatAble/bower_components/multiselect/css/multi-select.css')}}" />
@endpush
@push('js')
    <!-- Select 2 js -->
    <script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/select2/js/select2.full.min.js')}}"></script>
    <!-- Multiselect js -->
    <script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
    <script>
        $('.selectpicker').selectpicker();
    </script>
@endpush
