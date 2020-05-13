@extends('admin.layout.index',[
'title' => _i('Edit Slider'),
'subtitle' => _i('Edit Slider'),
'activePageName' => _i('Edit Slider'),
'additionalPageUrl' => url('/admin/panel/slider') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url("admin/panel/slider") }}" class="btn btn-default"> <i class="ti-list"></i>{{ _i('slider List') }}</a></li>

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
                            <h5 class="card-title">{{ _i('Edit Slider') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->
                                    <div class="">

                                        <div class="card-body">

                                            <form action="{{route('slider-update',$slider->id)}}" method="post" id="form" enctype="multipart/form-data" data-parsley-validate="">
                                                {{csrf_field()}}
                                                {{method_field('put')}}

                                                <div class="form-group">
                                                    <label>{{_i('language')}}</label>
                                                    <select name="language" class="form-control" required="">

                                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                                            <option value="{{$key}}" {{ $key == $slider->lang_id ? 'selected':''}}>{{_i($lang)}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                                <div class="from-group">
                                                    <label>{{_i('title')}}</label>
                                                    <input type="text" name="title" class="form-control" value="{{$slider->title}}" required="">
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('country')}}</label>
                                                    <select name="country[]" class="js-example-basic-multiple col-sm-12" multiple="multiple" required="">
                                                        <?php
                                                        $cout = \Illuminate\Support\Facades\DB::table('country_slider')
                                                            ->where('slider_id',$slider->id)
                                                            ->pluck('country_id')->toArray();

    ?>
                                                    @foreach($country as $count)
{{--                                                            {{dd($count->id)}}--}}
                                                            @if(is_array($cout))
                                                                    <option value="{{$count->country_id}}"  {{in_array($count->country_id,$cout) ? 'selected': ''}}>{{$count->name}}</option>
                                                                @else
                                                                    <option value="{{$count->country_id}}"  {{$count->country_id == $cout ? 'selected': ''}}>{{$count->name}}</option>
                                                                @endif
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="from-group">
                                                    <label>{{_i('status')}}</label>
                                                    <select name="status" class="form-control selectpicker">
                                                        <option value="0" {{$slider->status == 0 ? 'selected' :''}}>{{_i('unactive')}}</option>
                                                        <option value="1" {{$slider->status == 1 ? 'selected' :''}}>{{_i('active')}}</option>

                                                    </select>
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('Image')}}</label>
                                                    <input type="file" name="image" class="form-control image">
                                                </div>
                                                <div class="from-group">
                                                    <img src="{{asset('/uploads/setting/slider/'.$slider->image)}}" class="image-preview" style="width: 300px">
                                                </div>

                                                <div class="from-group">
                                                    <label>{{_i('Sort order')}}</label>
                                                    <input type="number" name="sort_order" class="form-control" value="{{$slider->sort_order}}" data-parsley-type="number" data-parsley-range="[1, 20]">
                                                </div>

                                                <div class="from-group ">
                                                    <label>{{_i('url')}}</label>
                                                    <input type="url" data-parsley-type="url" name="link" class="form-control" value="{{$slider->link}}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ _i('save') }}
                                                </button>
                                            </form>

                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


@endsection