


@extends('admin.layout.layout')

@section('title')

    Edit Permission
    {{$permission->name}}

@endsection

@section('header')



@endsection

@section('page_header')

    <section class="content-header">
        <h1>
            Permission
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li ><a href="{{url('/admin/permissions')}}">All Permissions</a></li>
            <li class="active"><a href="{{url('/admin/permission/create')}}">Add Permission</a></li>
            <li class="active"><a href="{{url('/admin/permission/'.$permission->id.'/edit')}}">Edit Permission</a></li>
        </ol>
    </section>

@endsection


@section('content')

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Edit Permission {{$permission ->name}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="post" action="{{url('/admin/permission/'.$permission ->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-xs-2 control-label">{{ __('Name :') }}</label>

                    <div class="col-xs-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $permission ->name }}" required="">

                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback" >
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> Save </button>
                </div>
                <!-- /.box-footer -->

            </form>
        </div>
    </div>

@endsection






@section('footer')





@endsection