
@extends('admin.layout.layout')
@section('title')
        {{_i('Edit bill')}}
@endsection


@section('page_header_name')
        {{_i('Edit bill')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Edit bill')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/bills/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/bills/'.$bill->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-- ================================== user =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="user_id">
                            {{_i('user')}} </label>
                        <div class="col-xs-6">
                            <select id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$bill->user_id == $user->id ? 'selected' : '' }}> {{$user->first_name}} {{$user->last_name}} </option>
                                @endforeach

                                @if ($errors->has('user_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- ================================== amount =================================== -->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="amount">
                            {{_i('amount')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="amount" value="{{ $bill->total }}" id="amount" required="" class="form-control">
                            @if ($errors->has('amount'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- ================================== currency =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="currency_id">
                            {{_i('currency')}} </label>
                        <div class="col-xs-6">
                            <select id="currency_id" class="form-control{{ $errors->has('currency_id') ? ' is-invalid' : '' }}" name="currency_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}" {{$bill->currency_id == $currency->id ? 'selected' : '' }}> {{$currency->title}} </option>
                                @endforeach

                                @if ($errors->has('currency_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currency_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- ================================== title =================================== -->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" id="txtUser" value="{{ $bill->title }}" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <!----==========================  link ==========================--->

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="description">
                            {{_i('description')}} </label>
                        <div class="col-xs-6">
                            <textarea name="description" id="description" required="" class="form-control">
                                {{ $bill->description }}
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>




@endsection
