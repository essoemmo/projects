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
                            <form method="post" id="addForm" enctype="multipart/form-data" data-parsley-validate>
                                {{csrf_field()}}
                                {{method_field('post')}}

                                <div class="form-group">
                                    <label>{{_i('member ship')}}</label>
                                    <select name="memberShip" class="form-control selectpicker">
                                        @foreach($memberships as  $membership)
                                            <option value="{{$membership->id}}">{{$membership->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{_i('type')}}</label>
                                    <select name="type" class="form-control selectpicker">
                                        <option value="">{{_i('choose...')}}</option>
                                        @foreach($types as  $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{_i('permissions')}}</label>
                                    <select name="permission[]" class="form-control selectpicker" multiple>
                                        <option value="">{{_i('choose...')}}</option>
                                        @foreach($permissions as  $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('price')}}</label>
                                    <input type="number" name="price" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('expire date')}}</label>
                                    <input type="date" name="end_date" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('image')}}</label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>

                                <div class="form-group" id="url_container">
                                    <img src="{{asset('uploads/default-image.png')}}" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('descrption')}}</label>
                                    <textarea name="descrption" class="form-control ckeditor"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-info pull-left" id="newOption">{{_i('new option')}}</button>

                                </div>

                            <div class="optionmember">
                                <div class="row options">

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="options[]" class="form-control">
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


        $('body').on('submit','#addForm',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('memberships-details.store')}}',
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
                        $('#addForm')[0].reset();
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
                    <div class="row options">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="options[]" class="form-control">
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