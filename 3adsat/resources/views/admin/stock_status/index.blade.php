
@extends('admin.layout.index',[
'title' => _i('All Stock Status'),
'subtitle' => _i('All Stock Status'),
'activePageName' => _i('All Stock Status'),
] )


@section('content')

    <div class="row">
        <div class="col-sm-12 mbl">
            <button class="btn btn-primary"  type="button"  data-toggle="modal" data-target="#modal-default">
                <span><i class="fa fa-plus"></i> {{_i('create new stock')}} </span>
            </button>
        </div>
    </div>

    <div class="card box-info">
        <div class="card-header">
            <h5 class="card-title">{{ _i('bank transfer') }}</h5>
        </div>

    @include('admin.layout.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

    <!-- =============================== Create Model ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Add Stock Status')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/admin/panel/stockStatus/store')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="card-body">

                        <!-- ================================== Title =================================== -->
                            @foreach($languages as $lang)
                            <div class="form-group row">

                                <label for="name" class="col-sm-3 col-form-label" > {{_i('Name')}} {{_i($lang->name)}}</label>

                                <div class="col-sm-8">
                                    <input id="name" type="text" class="form-control" name="{{$lang->code}}_name"  placeholder="{{_i($lang->name)}} {{ _i('Stock Status Name')}}"
                                           data-parsley-length="[3, 191]" required="" value="{{old($lang->code."_title")}}" >

                                    @if ($errors->has('name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach


                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =============================== Edit Model ============================================== -->
    <div class="modal fade edit_modal" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Edit Stock Status')}}</h4>
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" action="{{url('/admin/panel/stockStatus/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
                        @csrf
                        <div class="card-body">


                            <input type="hidden"  name="id" id="edit_id">
                            <!-- ================================== Title =================================== -->
                            @foreach($languages as $lang)
                                <div class="form-group row">

                                    <label for="name" class="col-sm-3 col-form-label" > {{_i('Name')}} {{_i($lang->name)}}</label>

                                    <div class="col-sm-8">
                                        <input id="name" type="text" class="form-control {{$lang->code}}_title" name="{{$lang->code}}_name"  placeholder="{{_i($lang->name)}} {{ _i('Stock Status Name')}}"
                                               data-parsley-length="[3, 191]" required="" value="{{old($lang->code."_title")}}" >

                                        @if ($errors->has('name'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script  type="text/javascript">


        $(function () {
            'use strict';
            var id = '';
            $(".edit").unbind('click');
            $('body').on('click','.edit',function (e) {
                id = $(this).data('id');
                $('#edit_id').val(id);
                var code = $(this).data('code');
                $('.edit_country_code').val(code);

                @foreach($languages as $lang)
                $('.{{$lang->code}}_title').empty();
                var {{$lang->code}}_title = $(this).data('title-{{$lang->code}}');

                $('.{{$lang->code}}_title').val({{$lang->code}}_title);
                @endforeach
                $("#edit_form").parsley().reset();
            });
        });


    </script>

@endpush
