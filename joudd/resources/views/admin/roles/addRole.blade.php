
@extends('admin.layout.layout')


@section('title' )
    {{_i('Add Role')}}
@endsection
@section('box-title' )
    {{_i('New Group')}}
@endsection



@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Roles')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/allRoles')}}">{{_i('All Roles')}}</a></li>
            <li class="active"><a href="{{url('/admin/group/add')}}">{{_i('Add Role')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')


    <div class="box box-info">

        <div class="box-header with-border">
            <h3 class="box-title">{{_i('Add Role')}}</h3>
        </div>

        <div class="box-body">
            <form  action="{{url('/admin/group/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf

                <div class="form-group row">
                </div>

                <div class="form-group row" {{-- style="margin-right: 42%;"--}}>

                    <label class="col-xs-3 col-form-label text-md-right" for="txtUser">
                        {{_i('Role Name :')}} </label>
                    <div class="col-xs-6">
                        <input type="text" name="name" id="txtUser" required="" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row " {{-- style="margin-right: 37%;"--}}>
                    <label class="col-xs-2">
                        {{_i('Permissions :')}} </label>
                </div>
                <div class="form-group row" {{-- style="margin-left: 3%;"--}}>

                    @foreach($permissionNames as $permission)
                        <div class="col-xs-3">

                            <div class="checkbox checkbox-custom">

                                <label for="{{$permission->id}}"> 
                                    <input class="control-label" id="{{$permission->id}}" type="checkbox" name="groups[]" value="{{$permission->id}}" data-parsley-multiple="groups" required="">
                                    {{$permission->desc}}
                                </label>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="form-group row " {{-- style="margin-right: 60%; margin-top: 5%;"--}}>
                    <div class="col-xs-offset-2 col-xs-2">
                        {{--<input type="submit" class="btn btn-default" value="Save">--}}
                        <button type="submit" class="btn btn-info pull-leftt"> {{_i('Add Role')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>




@endsection