@extends('admin.layout.index',[
'title' => _i('Edit Lens'),
'subtitle' => _i('Edit Lens'),
'activePageName' => _i('Edit Lens'),
'additionalPageUrl' => url('/admin/panel/lens') ,
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
{{-- {{ Form::open(['route' => 'boilerplate.pages.store', 'autocomplete' => 'off', 'class' =>
    'form-horizontal']) }} --}}
<form class="form-horizontal" action="{{route('lens.update',$lens->id)}}" method="post" enctype="multipart/form-data" id="addForm" role="form" data-toggle="validator">
    @csrf
    @method('PUT')
    <input type="hidden" class="form-control"  name="id" value="{{$lens->id}}">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('lens.index') }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('lens List') }}</a></li>
                        <li class="breadcrumb-item active"><button type="submit" class="btn btn-primary">
                                <i class="ti-save"></i> {{ _i('save') }}
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
                    <div class="card ">
                        <div class="card-header">
                            <h5 class="card-title">{{ _i('Edit Lens') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-general">
                                                <div class="form-group">
                                                    <label for="name">{{_i('Name')}}</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ _i('name') }}" value="{{$lens->name}}" required data-minlength="2">
                                                    <div class="col-sm-10">
                                                        {!! $errors->first('name','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_name">{{_i('Sub Name')}}</label>
                                                    <input type="text" class="form-control" id="sub_name" name="sub_name" placeholder="{{ _i('Sub Name') }}" value="{{$lens->sub_name}}" required data-minlength="2">
                                                    <div class="col-sm-10">
                                                        {!! $errors->first('sub_name','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">{{_i('Desctiprion')}}</label>
                                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="{{ _i('Description') }}" value="{{$lens->description}}" required data-minlength="2">{{$lens->description}}</textarea>
                                                    <div class="col-sm-10">
                                                        {!! $errors->first('description','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">{{_i('Price')}}</label>
                                                    <input type="text" class="form-control" name="price" id="price" value="{{$lens->price}}">
                                                    <div class="col-sm-10">
                                                        {!! $errors->first('price','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">{{_i('Image')}}</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    <div class="col-sm-10">
                                                        {!! $errors->first('image','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                    <img src="{{ Illuminate\Support\Facades\Storage::disk('public_uploads')->url($lens->image)}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="{{_i('No Image')}}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">{{_i('Submit')}}</button>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
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

</form>
@endsection
@push('js')

<script>

</script>

@endpush
