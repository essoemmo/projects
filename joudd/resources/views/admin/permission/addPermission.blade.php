
@extends('admin.layout.layout')


@section('title', 'add Permission')


@section('page_header')

    <section class="content-header">
        <h1>
            Permissions
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li ><a href="{{url('/admin/allRoles')}}">All Permisssions </a></li>
            <li class="active"><a href="{{url('/admin/group/add')}}">Add Permission</a></li>
        </ol>
    </section>


@endsection


@section('content')

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Permission</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  action="{{url('/admin/permission/create')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-xs-2 control-label">Permission Name : </label>

                        <div class="col-xs-6">
                            <input type="text"  placeholder="Permission Name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required="" >
                            @if ($errors->has('name'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt" style="margin-left: 100px; margin-bottom: 30px;">
                        Add Permission
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>




@endsection