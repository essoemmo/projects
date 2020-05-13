
@extends('admin.layout.index',[
'title' => _i('homepage setting'),
'subtitle' => _i('homepage setting'),
'activePageName' => _i('homepage setting'),
'additionalPageUrl' => url('/admin/panel/settings/homepage') ,
'additionalPageName' => _i('All'),
] )


{{--@section('page_header_name')--}}
{{--    {{_i('homepage setting')}}--}}
{{--@endsection--}}


@section('content')
{{--@include('admin.layout.message')--}}
@push('js')
<script>
   $(function () {
       'use strict'
       $('body').on('click','#edit',function (e) {
           e.preventDefault();
            var category = $(this).data('category');

            var sort = $(this).data('sort');
            var template = $(this).data('template');
            var id = $(this).data('id');
            var html = `<div class="form-group">
                    {{Form::label('category_id',_i('category'),['class'=>'control-label'])}}
                <select class="form-control" name="category_id" id="categoryId">
                        @php
                $categoriess = \App\Models\Category::where('deleted_at','=',null)->get();
            @endphp
                    @foreach($categoriess as $cat)
                    @php $categories = \Illuminate\Support\Facades\DB::table('category_descriptions')
                                    ->where('category_id',$cat->id)
                                    ->where('language_id',checknotsessionlang())
                                    ->get();
                    @endphp
                    @foreach($categories as $c)
                <option value="{{$c->category_id}}">{{$c->name}}</option>
                                @endforeach
                    @endforeach
                </select>                    @if ($errors->has('category_id'))
                <span class="text-danger invalid-feedback" role="alert">
              <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                            @endif
                </div>
                <div class="form-group">
{{Form::label('sort',_i('sort'),['class'=>'control-label'])}}
                    {{Form::selectRange('sort',1,10,null,['id'=>'sortId','class'=>'form-control','placeholder'=>_i('select ...')])}}
                    @if ($errors->has('sort'))
                <span class="text-danger invalid-feedback" role="alert">
              <strong>{{ $errors->first('sort') }}</strong>
                            </span>
                            @endif
                </div>
                    <div class="form-group">
                        {{Form::label('template',_i('template'),['class'=>'control-label'])}}
                    {{Form::select('template',[0=>0,1=>1],null,['id'=>'templateId','class'=>'form-control','placeholder'=>_i('select ...')])}}
                    @if ($errors->has('template'))
                <span class="text-danger invalid-feedback" role="alert">
                  <strong>{{ $errors->first('template') }}</strong>
                            </span>
                        @endif
                </div>
{!! Form::submit('save',['class'=>'btn btn-primary']) !!}`;
           $('#modal-form').empty();
           $('#modal-form').append(html);
           $('#categoryId').val(category)
           $('#sortId').val(sort)
           $('#templateId').val(template)
           $('.edit-record-model').attr('action','{{ url('/admin/panel/settings/homepage/') }}/' + id + "/update");
           console.log($('.edit-record-model').attr('action'))
           //  console.log(true);
       })
   })
</script>
@endpush
{{--        "yajra/laravel-datatables-buttons": "^4.6",--}}
{{--        "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header start -->

    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="card">

        <!-- Blog-card start -->
        <div  id="blog">
            <div class="card-block">
{{--                @include('admin.layout.message')--}}
                {!! $dataTable->table([
                    'class'=> 'table table-bordered table-striped table-responsive'
                ],true) !!}
            </div>
        </div>
    </div>

{{--        ===========================create modal =============================--}}
    <div class="modal fade" id="create" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Create New homepage')}}</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=>'homepage.store','class'=>'form-group']) !!}
                    <div class="form-group">

                        {{Form::label('category_id',_i('category'),['class'=>'control-label'])}}
{{--                        {{Form::select('category_id',$categories,null,['class'=>'form-control','placeholder'=>_i('select ...')])}}--}}
                        <select class="form-control" name="category_id" id="lang_ax">
                            @php
                            $categoriess = \App\Models\Category::where('deleted_at','=',null)->get();
                                @endphp
                            @foreach($categoriess as $cat)
                               @php $categories = \Illuminate\Support\Facades\DB::table('category_descriptions')
                                    ->where('category_id',$cat->id)
                                    ->where('language_id',checknotsessionlang())
                                    ->get();
                                @endphp
                            @foreach($categories as $c)
                                    <option value="{{$c->category_id}}">{{$c->name}}</option>
                                @endforeach
                            @endforeach
                        </select>

                        @if ($errors->has('category_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('sort',_i('sort'),['class'=>'control-label'])}}
                        {{Form::selectRange('sort',1,10,null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                        @if ($errors->has('sort'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('sort') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('template',_i('template'),['class'=>'control-label'])}}
                        {{Form::select('template',[0=>0,1=>1],null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                        @if ($errors->has('template'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('template') }}</strong>
                            </span>
                        @endif
                    </div>
                    {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


{{--        ============================edit modal=========================--}}
{!! Form::open(['method'=>'put','data-parsley-validate'=>'','class'=>'edit-record-model']) !!}
        <div class="modal fade" id="modal-edit" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{_i('Edit homepage')}}</h4>
                    </div>
                    <div class="modal-body" id="modal-form">

                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}


    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(function () {
                'use strict'
                $('.create').attr('data-toggle', 'modal').attr('data-target','#create');
            });
        </script>
    @endpush
    <style>
        .table{
            display: table !important;
        }
    </style>
@endsection
