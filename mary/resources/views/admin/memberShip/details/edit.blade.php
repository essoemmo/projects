@extends('admin.index')

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
                            <form action="{{route('memberships-details.update',$membershipss->id)}}" method="post" id="editForm" enctype="multipart/form-data" data-parsley-validate>
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>{{_i('member ship')}}</label>
                                    <select name="memberShip" class="form-control selectpicker">
                                        @foreach($memberships as  $membership)
                                            <option value="{{$membership->id}}" {{$membershipss->id == $membership->id ?'selected':''}}>{{$membership->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{_i('type')}}</label>
                                    <select name="type" class="form-control selectpicker">
                                        <option value="">{{_i('choose...')}}</option>
                                        @foreach($types as  $type)
                                            <option value="{{$type}}" {{$membership->type === $type ?'selected':''}}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{_i('permissions')}}</label>
                                    <select name="permission[]" class="form-control selectpicker" multiple>
                                        <option value="">{{_i('choose...')}}</option>
                                        @foreach($permissions as  $permission)
                                            <option value="{{$permission->id}}" {{in_array($permission->id,$permisiionId) ? 'selected' : ''}}>{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('price')}}</label>
                                    <input type="number" name="price" value="{{$membershipss->price}}" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('expire date')}}</label>
                                    <input type="date" name="end_date" class="form-control" value="{{$membershipss->expire_date}}" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('image')}}</label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>

                                <div class="form-group" id="url_container">
                                    <img src="{{asset('uploads/membership/'.$membershipss->image)}}" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>


                                <div class="col-md-12">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                @foreach($langs as $index => $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link {{$index == 0 ? 'active' : ''}}" data-toggle="pill" href="#{{$lang->code}}" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">{{$lang->name}}</a>
                                                </li>
                                                    @endforeach

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                @foreach($langs as $index => $lang)

                                                <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$lang->code}}" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                                    <div class="form-group">
                                                        <label>{{_i('descrption')}}</label>

                                                        @if(in_array($lang->id,$membershipsss))

                                                                   @foreach($membershipssss as $ship)

                                                                       @if($ship->lang_id ==$lang->id )
                                                                    <textarea name="{{$lang->code}}_descrption" class="form-control ckeditor">

                                                            {!! $ship->description  !!}

                                                        </textarea>
                                                                @endif
                                                                       @endforeach

                                                            @else

                                                        @endif
                                                        <input type="hidden" name="lang_id[]" value="{{$lang->id}}">
                                                    </div>


                                                </div>

                                                    @endforeach

                                            </div>

                                            <div class="col-md-6">
                                                <button class="btn btn-info pull-left" id="newOption">{{_i('new option')}}</button>

                                            </div>

                                            <div class="optionmember">
                                                @if(!empty($options))
                                                    @foreach($options as $option)
                                                        @foreach($langs as $index => $langg)
                                                            @if($langg->id == $option->lang_id)
                                                        <div class="row options">

                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <label>{{_i('name').$langg->name}}</label>
                                                                    <input type="text" name="options[{{$langg->id}}][]" class="form-control" value="{{$option->name}}">
                                                                </div>
                                                                <br>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <button class="btn btn-danger del">{{_i('delete')}}</button>
                                                                </div>
                                                                <br>
                                                            </div>

                                                        </div>
                                                            @endif
                                                            @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>

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
    <script type="text/javascript">


        $('body').on('submit','#editForm',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
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
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Added is Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                        $('#masages_model').hide();
                        // $('#addForm')[0].reset();
                        // $modal = $('#addForm');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });

        $('#newOption').on('click',function (e) {
            e.preventDefault();
            $('.optionmember').append(`
             @foreach($langs as $index => $lang)
                    <div class="row options">
                                    <div class="col-md-6">
                                        <div class="">
                                           <label>{{_i('name ').$lang->name}}</label>
                                           <input type="text" name="options[{{$lang->id}}][]" class="form-control">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <button class="btn btn-danger del">{{_i('delete')}}</button>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                                @endforeach

               `);

        });


        $('body').on('click','.del',function (e) {
            e.preventDefault();
            $(this).closest('.row').remove();
        })

        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('.image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>
@endpush