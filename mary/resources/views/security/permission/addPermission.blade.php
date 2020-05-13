
@extends('admin.index')

@section('title', 'Add Permission')

@section('page_header_name' , 'Add Permission')

@section('page_url')
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/admin/permission/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/admin/permission/add')}}">{{_i('Add')}}</a></li>
@endsection

@section('content')

        <div class="box box-info" >

           <div class="box-body">
               <!-- form start -->
               <form  action="{{url('/admin/permission/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                   @csrf
                   <div class="form-group row">

                   </div>
                   <div class="box-body">
                       <div class="form-group row">
                           <label for="" class="col-md-12 col-form-label"> {{_i('Permission Name')}} </label>

                           <div class="col-md-12">
                               <input type="text"  placeholder="Permission Name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required="" >
                               @if ($errors->has('name'))
                                   <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                               @endif
                           </div>
                       </div>

                       <!------ guard name ---------------->
{{--                       <div class="form-group row">--}}
{{--                           <label for="" class="col-xs-3 col-form-label"> {{_i('Guard Name')}} </label>--}}

{{--                           <div class="col-xs-6">--}}
{{--                               <select id="user_id" class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}" name="guard_name" required="">--}}
{{--                                   <option disabled selected> {{_i('Choose')}} </option>--}}
{{--                                   <option value="{{$guard_admin}}" {{old('guard_name') == $guard_admin ? 'selected' : ''}} > {{_i('Admin')}} </option>--}}
{{--                                   <option value="{{$guard_web}}" {{old('guard_name') == $guard_web ? 'selected' : ''}} > {{_i('Web')}} </option>--}}
{{--                                   <option value="{{$guard_store}}" {{old('guard_name') == $guard_store ? 'selected' : ''}} > {{_i('Store')}} </option>--}}
{{--                               </select>--}}
{{--                           </div>--}}
{{--                       </div>--}}


                   </div>
                   <!-- /.box-body -->
                   <div class="box-footer">

                       <button type="submit" class="btn btn-info" >
                           {{_i('Add')}}
                       </button>
                   </div>
                   <!-- /.box-footer -->
               </form>

           </div>
        </div>

@endsection