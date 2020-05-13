
@extends('admin.AdminLayout.index')

@section('title')

    {{_i('Edit Membership permissions')}}

@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Edit Membership permissions')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/membership/membership_perms/all')}}">{{_i('All')}}</a></li>
    <li ><a href="{{url('/adminpanel/membership/membership_perms/create')}}">{{_i('Add')}}</a></li>
    <li ><a href="#">{{_i('Edit')}}</a></li>
@endsection



@section('content')


    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Edit Membership permissions')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Edit Membership permissions')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
            <form  action="{{url('/adminpanel/membership/membership_perms/'.$membership->id.'/update')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf
                        <!----------------------------------  title  --------------------------------------------->
                <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-form-label " for="title">
                        {{_i('Title')}}
                    </label>
                    <div class="col-sm-6">
                        <input id="title" type="text" name="title" value="{{$membership->title}}" required="" class="form-control">
                        @if ($errors->has('title'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title')}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <!----------------------------------  price  --------------------------------------------->
                <div class="form-group row {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-form-label " for="price" >
                        {{_i('Price')}}
                    </label>
                    <div class="col-sm-6">
                        <input id="price" type="number" name="price" value="{{$membership->price}}" required="" class="form-control"
                               min="100" data-parsley-min="100"  max="99999999" data-parsley-max="99999999">
                        @if ($errors->has('price'))
                            <span class="text-danger invalid-feedback">
                            <strong>{{ $errors->first('price')}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <!----------------------------------  duration --------------------------------------------->
                <div class="form-group row {{ $errors->has('duration') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-form-label " for="duration">
                        {{_i('Duration')}}
                    </label>
                    <div class="col-sm-6">
                        <input id="duration" type="number" name="duration" value="{{$membership->duration}}" required="" class="form-control"
                               min="1" data-parsley-min="1"  max="6" data-parsley-max="6" >

                        @if ($errors->has('duration'))
                            <span class="text-danger invalid-feedback">
                            <strong>{{ $errors->first('duration') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-1">
                        {{_i('Month')}}
                    </div>
                </div>
                <!----------------------------------  is_active  --------------------------------------------->
                <div class="form-group row">
                    <label for="is_active_1" class="col-sm-2 col-form-label ">{{_i('Status')}}</label>
                    <div class="col-sm-8">
                        <input class="form-check-input control-form"  type="radio"  name="is_active" id="optionsRadios1" value="0"{{$membership->is_active==0? 'checked':''}} >
                        <label  class="form-check-label control-label" for="optionsRadios1"  > {{_i("Not Active")}} </label>
                        <input class="form-check-input"  type="radio"  name="is_active" id="optionsRadios2" value="1"{{$membership->is_active==1? 'checked':''}}>
                        <label  class="form-check-label control-label" for="optionsRadios2">{{_i("Active")}} </label>
                    </div>
                    @if ($errors->has('is_active'))
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('is_active') }}</strong>
                       </span>
                    @endif
                </div>
                <!----------------------------------  permissions --------------------------------------------->
                <div class="form-group row {{ $errors->has('perm_id') ? ' has-error' : '' }}">
                    <label class="col-sm-2">
                        {{_i('Permissions')}} </label>
                    <div class="col-sm-6">

                        @foreach($permissionNames as $permission)
                            <div class="col-sm-3">

                                <div class="checkbox checkbox-custom">

                                    <label for="{{$permission->id}}">
                                        <input class="control-label" id="{{$permission->id}}" type="checkbox" name="groups[]" value="{{$permission->id}}"
                                               {{in_array($permission->id ,$permission_group)  ? 'checked' : ''}} data-parsley-multiple="groups" required="">
                                        {{$permission->title}}
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">{{_i('Save')}}</button>
                </div>
            </form>
        </div>
    </div>


@endsection

