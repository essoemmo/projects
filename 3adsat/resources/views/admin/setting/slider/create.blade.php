@extends('admin.layout.index',[
'title' => _i('Add Slider'),
'subtitle' => _i('Add Slider'),
'activePageName' => _i('Add Slider'),
'additionalPageUrl' => url('/admin/panel/slider') ,
'additionalPageName' => _i('All'),
] )
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url("admin/panel/slider") }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('slider List') }}</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ _i('Add Slider') }}</h5>
                                        </div>
                                       <!-- /.card-header -->
                                        <form action="{{route('slider-store')}}" method="post" id="form" enctype="multipart/form-data" data-parsley-validate="">

                                        <div class="card-body">

                                                {{csrf_field()}}
                                                {{method_field('post')}}

                                                <div class="form-group">
                                                    <label>{{_i('language')}}</label>
                                                    <select name="language" class="form-control" required="">

                                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                                            <option value="{{$key}}">{{_i($lang)}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('title')}}</label>
                                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" required="">
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('country')}}</label>
                                                    <select name="country[]" class="js-example-basic-multiple col-sm-12" multiple="multiple" required="">
                                                        @foreach($country as $count)
                                                            <option value="{{$count->country_id}}">{{$count->name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('status')}}</label>
                                                    <select name="status" class="form-control selectpicker">
                                                        <option value="0">{{_i('unactive')}}</option>
                                                        <option value="1">{{_i('active')}}</option>

                                                    </select>
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('Image')}}</label>
                                                    <input type="file" name="image" class="form-control image" required="">
                                                </div>
                                                <div class="from-group">
                                                    <img src="" class="image-preview" style="width: 300px">
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('Sort order')}}</label>
                                                    <input type="number" name="sort_order" class="form-control" value="{{old('order') ? old('order') : 1}}" data-parsley-type="number" required="" data-parsley-range="[1, 20]">
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('url')}}</label>
                                                    <input type="url" data-parsley-type="url" name="link" class="form-control" value="{{old('order')}}">
                                                </div>


                                        </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ _i('save') }}
                                                </button>
                                            </div>

                                        </form>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->


    @endsection