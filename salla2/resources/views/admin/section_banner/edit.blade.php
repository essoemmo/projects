@extends('admin.AdminLayout.index')

@section('title')
{{_i('Edit Home Page Section Banner')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
{{ _i('Edit Home Page Section Banner') }}
@endsection

@section('content')
<!-- /.box-header -->
<!-- =====Filter Section===== -->
<div class="box-body">
    <form role="form" action="{{route('section_banners.update',$content->id)}}" method="post" id="fileupload"
        enctype="multipart/form-data" data-parsley-validate="">
        {{csrf_field()}}
        {{method_field('put')}}

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('section_banners.index')}}"
                                    class="btn btn-default"> <i class="ti-list"></i>
                                    {{ _i('All Home Page Section Banner') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{route('section_banners.update',$content->id)}}">
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
                        <h5>{{ _i('Edit Home Page Section Banners') }}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>

                    </div>
                    <div class="card-body card-block">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="lang_id">
                                {{ _i('Languages') }} :</label>
                            <div class="col-sm-10">
                                @foreach ($langs as $item)
                                
                                @if ($content_data!=null )
                                @if($content_data->lang_id == $item->id)
                                <label class="col-xs-2 col-form-label" for="lang_id">
                                    {{ $item->title }}
                                </label>
                                @endif
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="title">{{ _i('Title') }} :</label>
                            <div class="col-sm-10">
                                <label class="col-xs-2 col-form-label">
                                    @if (!empty($content_data->title))
                                      {{$content_data->title}}   
                                    @endif
                                   
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="order">
                                {{ _i(' Order ') }} :</label>
                            <div class="col-sm-10">

                                <label class="col-sm-2 col-form-label">
                                    {{$content['order']}}
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ _i('Banners') }} :</label>
                        </div>

                        <div class="form-group row" >
                            @foreach($banners as $key => $item)
                                <div class="col-sm-4">
                                    <div class="checkbox-fade fade-in-primary  ">
                                        <label for="{{$key}}"  >
                                            <input id="{{$key}}" type="checkbox" name="banners_ids[]" value="{{$key}}"   data-parsley-multiple="groups" required=""
                                            @foreach ($section_banner as $row) @if($row->banner_id == $key) checked @endif @endforeach>
                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                            {{ $item }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


    </form>
</div>

@endsection

