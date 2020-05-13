@extends('admin.AdminLayout.index')

@section('title')
{{_i('Edit Home Page Section')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
{{ _i('Edit Home Page Section') }}
@endsection

@section('content')
<!-- /.box-header -->
<!-- =====Filter Section===== -->
<div class="box-body">
    <form role="form" action="{{route('section_products.update',$content->id)}}" method="post" id="fileupload"
        enctype="multipart/form-data" data-parsley-validate="">
        {{csrf_field()}}
        {{method_field('put')}}

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('section_products.index')}}"
                                    class="btn btn-default"> <i class="ti-list"></i>
                                    {{ _i('All Home Page Section') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{route('section_products.update',$content->id)}}">
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
                        <h5>{{ _i('Edit Home Page Section') }}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>

                    </div>
                    <div class="card-body card-block">

                        <div class="form-group row">
                            <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                                {{ _i('Languages') }} :</label>
                            <div class="col-sm-10">
                                @foreach ($langs as $item)
                                @if ($content_data->lang_id == $item->id)
                                <label class="col-xs-2 exampleInputEmail1" for="lang_id">
                                    {{ $item->title }}
                                </label>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xs-2 exampleInputEmail1" for="title">{{ _i('Title') }} :</label>
                            <div class="col-sm-10">
                                <label class="col-xs-2 exampleInputEmail1">
                                    @if (!empty($content_data->title))
                                      {{$content_data->title}}   
                                    @endif
                                   
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ _i('Products') }} :</label>
                            <div class="col-sm-10">
                                <select class="selectpicker form-control" name="product_id[]" data-tags="true"
                                    data-placeholder="{{ _i('Select a Product') }}" multiple="multiple" required="">
                                    @foreach ($products as $key => $item)
                                    <option value="{{ $key }}" @foreach($section_product as $product) @if($product->
                                        product_id == $key)
                                        selected
                                        @endif
                                        @endforeach
                                        >{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xs-2 exampleInputEmail1" for="order">
                                {{ _i(' Order ') }} :</label>
                            <div class="col-sm-10">

                                <label class="col-xs-2 exampleInputEmail1">
                                    @if (!empty($content->order))
                                    {{$content->order}}      
                                    @endif
                                 
                                    </label>
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
<link rel="stylesheet" type="text/css"
    href="{{asset('AdminFlatAble/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css"
    href="{{asset('AdminFlatAble/bower_components/multiselect/css/multi-select.css')}}" />
@endpush
@push('js')
<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/select2/js/select2.full.min.js')}}">
</script>
<!-- Multiselect js -->
<script type="text/javascript"
    src="{{asset('AdminFlatAble/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}">
</script>
<script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/multiselect/js/jquery.multi-select.js')}}">
</script>
<script>
    $('.selectpicker').selectpicker();

</script>
@endpush
