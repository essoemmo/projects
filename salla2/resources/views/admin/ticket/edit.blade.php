@extends('admin.AdminLayout.index')

@section('title')
    edit {{$ticket->subject}}
@endsection

@section('page_header_name')
    edit {{$ticket->subject}}
@endsection


@section('content')
    @push('js')
        <script>
            $(document).ready(function() {
                $(".e2").select2({
                    placeholder: "choose one",
                    allowClear: true,
                });
            });
        </script>
    @endpush

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{$ticket->subject}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{$ticket->subject}}</a>
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
            @include('admin.AdminLayout.message')
            {!! Form::model($ticket,['method'=>'PUT','route'=>['ticket.update',$ticket->id],'class'=>'form-group']) !!}
            <div class="form-group">
                {{Form::label('subject',null,['class'=>'control-label'])}}
                {{Form::text('subject',$ticket->subject,['class'=>'form-control'])}}
                @if ($errors->has('subject'))
                    <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('contents',null,['class'=>'control-label'])}}
                {{Form::textarea('contents',$ticket->contents,['class'=>'form-control'])}}
                @if ($errors->has('contents'))
                    <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('contents') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{Form::label('users',null,['class'=>'control-label'])}}
                    {{Form::select('users',$users,$ticket->user_id,['class'=>'form-control e2','placeholder'=>'choose one'])}}
                    @if ($errors->has('users'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('users') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3">
                    {{Form::label('category',null,['class'=>'control-label'])}}
                    {{Form::select('category',$category,$ticket->category_id,['class'=>'form-control','placeholder'=>'choose one'])}}
                    @if ($errors->has('category'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3">
                    {{Form::label('status',null,['class'=>'control-label'])}}
                    {{Form::select('status',\App\Enums\StatusType::toSelectArray(),$ticket->status_id,['class'=>'form-control','placeholder'=>'choose one'])}}
                    @if ($errors->has('status'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3">
                    {{Form::label('priorities',null,['class'=>'control-label'])}}
                    {{Form::select('priorities',$priorities,$ticket->priority_id,['class'=>'form-control','placeholder'=>'choose one'])}}
                    @if ($errors->has('priorities'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('priorities') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            {{Form::submit('save',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    </div>


@endsection