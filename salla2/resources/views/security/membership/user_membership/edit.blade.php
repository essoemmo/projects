
@extends('admin.AdminLayout.index')

@section('title')

    {{_i('Edit User Membership')}}

@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Edit User Membership')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/membership/user_membership/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/membership/user_membership/create')}}">{{_i('Add')}}</a></li>
@endsection



@section('content')


    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Edit User Membership')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Edit User Membership')}}</a>
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

        <form method="POST" action="{{ url('/adminpanel/membership/user_membership/'.$user_memberships->id.'/update') }}" class="form-horizontal"  data-parsley-validate="">
            @csrf

            <div class="box-body">

                <!----------------------------------  user_id   --------------------------------------------->
                <div class="form-group row {{ $errors->has('user_id') ? ' has-error' : '' }}">
                    <label for="user_id" class="col-xs-4 control-label">{{ _i('User') }}</label>
                    <div class="col-xs-6">
                        <select id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" required="">
                            <option disabled selected> {{_i('Choose')}} </option>
                            @foreach($users as  $user)
                                <option value="{{$user->id}}" {{$user_memberships->user_id == $user->id ? 'selected' : ''}} > {{$user->name}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_id')}}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <!----------------------------------  membership_id  --------------------------------------------->
                <div class="form-group row {{ $errors->has('membership_id') ? ' has-error' : '' }}">
                    <label for="membership_1" class="col-xs-4 control-label">{{ _i('Membership') }}</label>
                    <div class="col-xs-6">
                        <select id="membership_1" class="form-control{{ $errors->has('membership_id') ? ' is-invalid' : '' }}" name="membership_id" required="">
                            <option disabled selected> {{_i('Choose')}} </option>
                            @foreach($memberships as  $membership)
                                <option value="{{$membership->id}}" {{$user_memberships->membership_id == $membership->id ? 'selected' : ''}} > {{$membership->title}} </option>
                            @endforeach
                            @if ($errors->has('membership_id'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('membership_id')}}</strong>
                                </span>
                            @endif
                        </select>
                    </div>
                </div>
                <!----------------------------------  price   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-4 control-label">{{_i('Price')}} :</label>
                    <div class="col-xs-6">
                        <label id='price_1' name="price" class="col-xs-4 control-label text-green" >0</label>
                        @if($errors->has('price'))
                            <strong>{{$errors->first('price')}}</strong>
                        @endif
                    </div>
                </div>
                <!----------------------------------  duration ---------------------------------- -->
                <div class="form-group row">
                    <label for="cost" class="col-xs-4 control-label">{{_i('Duration')}} :</label>
                    <div class="col-xs-6">
                        <label id='duration_1' name="duration" class="col-xs-4 control-label text-green" >0</label>
                        @if($errors->has('price'))
                            <strong>{{$errors->first('duration')}}</strong>
                        @endif
                    </div>
                </div>
                <!----------------------------------  created ---------------------------------- -->
                <div class="form-group row {{ $errors->has('created') ? ' has-error' : '' }}">
                    <label for="created" class="col-xs-4 control-label">{{_i('Start Date')}}</label>
                    <div class="col-xs-6">
                        <input  id="created"  type="date" name="created"  class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'"
                                data-mask="" value="{{$user_memberships->created}}" required="">
                        @if($errors->has('created'))
                            <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('created') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info "> {{ _i('Save') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>
    </div>


@endsection

@section('footer')
    <script>
        $(document).ready(()=> {

            $('#membership_1').change(function () {
                $.getJSON(`{{route("get_membership")}}?id=${$('#membership_1').val()}`).done(function (data) {
                    $('#price_1').text(data.price);
                    $('#duration_1').text(data.duration);
                }).fail(function () {
                    $('#price_1').text('Error');
                    $('#duration_1').text('Error');
                });
            });
        });
    </script>
@endsection
