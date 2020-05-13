

@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Edit Slider')}}
@endsection

@section('header')

@endsection



@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/settings')}}">{{_i('Settings')}}</a></li>
    <li class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')

    <h2 class="page-header">{{_i('Edit Counter')}}</h2>

    <div class="box box-default">

        <div class="box-body">
            <form  action="{{url('/adminpanel/settings/counter/'.$counter->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                @csrf
                <div class="box-body">
                    <!-- ================================== Title =================================== -->
                    <div class="form-group row " style="width: 100% ">
                        <label for="name" class="col-sm-3 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span></label>
                        <div class="col-sm-9">
                            <input  type="text" class="form-control" name="title" placeholder="{{_i('Slider Title')}}"
                                    value="{{$counter->title}}" data-parsley-length="[3, 191]" required="">

                            <span class="text-danger invalid-feedback">
                                                                <strong>{{$errors->first('title')}}</strong>
                                                            </span>
                        </div>
                    </div>
                    <!-- ================================== url =================================== -->
                    <div class="form-group row" style="width: 100%">

                        <label for="name" class="col-sm-3 col-form-label"> {{_i('Counter')}} <span style="color: #F00;">*</span></label>

                        <div class="col-sm-9">
                            <input class="form-control" name="counter" placeholder="{{_i('Counter')}}"
                                   value="{{$counter->counter}}" type="number" data-parsley-type="counter" required="">

                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('counter')}}</strong>
                            </span>

                        </div>
                    </div>



                <!-- ================================== logo =================================== -->
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label" for="icon">{{_i('icon')}} <span style="color: #F00;">*</span> </label>

                        @if(is_file(public_path('uploads/settings/counter/'.$counter->id.'/'.$counter->logo)))

                            <div class="col-sm-6">
                                <input type="file" name="logo" id="filex" onchange="showLogo(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                            </div>

                            <div class="bs-example bs-example-images">
                                <img src="{{ asset('uploads/settings/counter/'.$counter->id.'/'.$counter->logo) }}" id="old_icon"  style=" width: 300px; height: 250px;" class="img-thumbnail">
                            </div>
                        @else
                            <div class="col-sm-6">
                                <input type="file" name="icon" id="filex" onchange="apperLogo(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('icon')}}</strong>
                            </span>
                            </div>

                            <img class="img-responsive pad" id="counter_icon" hidden style=" width: 300px; height: 250px;">
                        @endif

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

@push('js')
    <script>
        function showLogo(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_icon").attr('src', e.target.result).width(300).height(250);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function apperLogo(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#counter_icon').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

    </script>

@endpush
