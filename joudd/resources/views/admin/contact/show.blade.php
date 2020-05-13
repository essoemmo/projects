@extends('admin.layout.layout')

@section('title')
    {{_i('Show Contact')}}
@endsection

@section('box-title' , 'Show Contact')

@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Show Contact')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/contact/all')}}">{{_i('All Contacts')}}</a></li>
            <li class="active"><a href="#">{{_i('Show Contact')}}</a></li>
        </ol>
    </section>

@endsection


@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="" class="form-horizontal" data-parsley-validate="">

                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-----===================================== name ========================---->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Name')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="name" id="txtUser" required="" class="form-control" value="{{$contact->name}}">
                            @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-----===================================== email ========================---->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="email">
                            {{_i('E-Mail')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="email" id="email" required="" class="form-control" value="{{$contact->email}}">
                            @if ($errors->has('email'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-----===================================== title ========================---->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="title">
                            {{_i('Message Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" id="title" required="" class="form-control" value="{{$contact->title}}">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!----==========================  message==========================--->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="message">
                            {{_i('Message')}} </label>
                        <div class="col-xs-6">
                            <textarea id="message"  class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" required="" >{{$contact->message}}</textarea>
                            @if($errors->has('message'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url('/admin/contact/all')}}">
                        <button type="button" class="btn btn-default " >
                            {{_i('Back')}}
                        </button>
                    </a>

                    <a href="{{url('/admin/contact/'.$contact->id.'/delete')}}">
                        <button type="button" class="btn btn-danger " > <i class="fa fa-trash"></i>
                            {{_i('Delete')}}
                        </button>
                    </a>

                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>




    @endsection

