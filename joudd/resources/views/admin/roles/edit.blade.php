


@extends('admin.layout.layout')

@section('title')

    {{_i('Edit Role')}}
    {{$role->name}}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Roles')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/allRoles')}}">{{_i('All Roles')}}</a></li>
            <li class="active"><a href="{{url('/admin/roles/'.$role->id.'/edit')}}">{{_i('Edit Role')}}</a></li>
        </ol>
    </section>

@endsection


@section('content')

    <div class="box box-info">
        <div class="box-header">
            {{--<h3 class="box-title">Edit Role {{$role->name}}</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="post" action="{{url('/admin/role/'.$role->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-xs-2">{{ _i('Role Name :') }}</label>

                    <div class="col-xs-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}" required="">

                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row " >
                    <label class="control-label col-xs-2">
                        {{_i('Permissions :')}} </label>
                </div>
                <div class="form-group row" {{-- style="margin-left: 3%;"--}}>

                    @foreach($permissions as $permission)
                        <div class="col-xs-3">

                            <div class="checkbox checkbox-custom">

                                <label for="{{$permission->id}}">
                                    <input class="control-label" id="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}  data-parsley-multiple="groups" required="">
                                    {{$permission->desc}}</label>
                            </div>
                        </div>
                    @endforeach

                </div>


                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> {{_i('Save ')}}</button>
                </div>
                <!-- /.box-footer -->

            </form>



        </div>

    </div>



@endsection






@section('footer')





@endsection