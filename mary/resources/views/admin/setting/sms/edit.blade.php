@extends('admin.index')
@section('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="alert alert-danger" id="masages_model" style="display: none">

                            </div>
                            <form action="{{route('sms.update',$datasms->id)}}" method="post" id="addForm" enctype="multipart/form-data" data-parsley-validate>
                                {{csrf_field()}}
                                {{method_field('put')}}


                                <div class="form-group">
                                    <label>{{_i('users')}}</label>
                                    <select class="form-control" name="user">
                                        <option value=" " selected disabled>{{_i('choose user')}}</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$datasms->user_id == $user->id ? 'selected' : ''}}>{{$user->username}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('created')}}</label>
                                    <input type="text" id="datepicker"  name="created" class="form-control" required="" value="{{$datasms->created}}">
                                </div>

                                <div class="col-md-12">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                @foreach($langs as $index => $lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$index == 0 ? 'active' : ''}}" id="lang-{{$lang->id}}" data-toggle="pill" href="#{{$lang->code}}" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">{{$lang->name}}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                @foreach($langs as $index => $lang)
                                                    <input type="hidden" name="lang_id[]" value="{{$lang->id}}">

                                                        @if(in_array($lang->id,$langs_id))
                                                            @foreach($data as $da)
                                                                @if($lang->id == $da->lang_id)
                                                                <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$lang->code}}" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                                                    <div class="form-group">
                                                                        <label>{{_i('message')}}</label>
                                                                        <textarea name="{{$lang->code}}_message" class="form-control ckeditor">{{$da->message}}</textarea>
                                                                    </div>
                                                                </div>

                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>


                                <input type="hidden"  name="status" class="form-control" value="pending">

                                <input type="submit" class="btn btn-info btn-sm" value="{{_i('save')}}">

                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('body').on('submit','#addForm',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            alert(url);
            $.ajax({
                url: url,
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    console.log(response);
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response['0'] == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Added is Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                        $('#masages_model').hide();
                        $('#addForm')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });






    </script>
@endpush