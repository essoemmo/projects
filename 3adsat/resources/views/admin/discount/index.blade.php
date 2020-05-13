
@extends('admin.layout.index',[
'title' => _i('All Discount Codes'),
'subtitle' => _i('All Discount Codes'),
'activePageName' => _i('Add Discount Codes'),
'additionalPageUrl' => url('/admin/panel/discount') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Discount Codes') }}</h5>
        </div>



    @include('admin.layout.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
        {{--    ===========================create modal =============================--}}
        <div class="modal fade" id="create" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{_i('Create New discountCode')}}</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'discount.store','class'=>'form-group','data-parsley-validate="" ']) !!}
                        <div class="form-group">
                            {{Form::label(_i('title'),null,['class'=>'control-label'])}}
                            {{Form::text('title',old('title'),['class'=>'form-control','required=""'])}}
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label(_i('code'),null,['class'=>'control-label'])}}
                            {{Form::text('code',old('code'),['class'=>'form-control','required=""'])}}
                            @if ($errors->has('code'))
                                <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label(_i('discount'),null,['class'=>'control-label'])}}
                            {{Form::text('discount',old('discount'),['class'=>'form-control','required=""'])}}
                            @if ($errors->has('discount'))
                                <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label(_i('type'),_i('count'),['class'=>'control-label'])}}
                            {{Form::text('type',old('type'),['class'=>'form-control','required=""'])}}
                            @if ($errors->has('type'))
                                <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                        {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        {{--    ============================edit modal=========================--}}
        <form action="" method="POST" class="edit-record-model" data-parsley-validate="">
            <div class="modal fade" id="modal-edit" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{_i('Edit Discount code')}}</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(function () {
                $('.create').attr('data-toggle', 'modal').attr('data-target','#create');
            })
        </script>
    @endpush

@endsection
