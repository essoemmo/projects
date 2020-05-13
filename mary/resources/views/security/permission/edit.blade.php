@extends('admin.index')

@section('title', 'Edit Permission')

@section('page_header_name' , 'Edit Permission')


@section('page_url')
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/admin/permission/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/admin/permission/add')}}">{{_i('Add')}}</a></li>
    <li class="active"><a href="{{url('/admin/permission/edit')}}">{{_i('Edit')}}</a></li>
@endsection


@section('content')


    <div class="box box-info" style="padding-top:2%">

        <!-- form start -->
        <form  action="{{url('/admin/permission/'.$permission ->id.'/edit')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

            @csrf
            <div class="box-body">
                <div class="form-group row">
                    <label for="" class="col-md-12 col-form-label text-md-right "> {{_i('Permission Name')}} </label>

                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$permission->name }}"  placeholder="Permission Name" required="" >
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

                <button type="submit" class="btn btn-info " >
                    {{_i('Save')}}
                </button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>

@endsection
