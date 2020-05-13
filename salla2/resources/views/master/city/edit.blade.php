@extends('master.layout.index',[
'title' => _i('City'),
'subtitle' => _i('City'),
'activePageName' => _i('City'),
'additionalPageUrl' => url('/master/cities/all') ,
'additionalPageName' => _i('Cities'),
] )
@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/master/cities/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                <input type="hidden"  name="id" value="{{$city->id}}">
                @csrf
                <div class="box-body">

{{--                            <div class="form-group row">--}}
{{--                                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>--}}
{{--                                <div class="col-sm-6">--}}
{{--                                    <select class="form-control" name="lang_id" id="language_addform" required="">--}}
{{--                                        <option selected disabled="">{{_i('CHOOSE')}}</option>--}}
{{--                                        @foreach($languages as $lang)--}}
{{--                                            <option value="{{$lang->id}}" {{$city_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        <!-- ================================== Attachments =================================== -->

                        {{-- <div class="form-group row">
                            <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="lang_id" id="language_addform" required="">
                                    <option selected disabled="">{{_i('CHOOSE')}}</option>
                                    @foreach($languages as $lang)
                                        <option value="{{$lang->id}}" {{$sample_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                                    @endforeach
                                </select>
                                <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                            </div>
                        </div> --}}

                 <!-- ================================== Attachments =================================== -->

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label" >{{ _i('Country') }} <span style="color: #F00;">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="country_id" required="">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                @foreach($countries as $coun)
                                    <option value="<?=$coun['id']?>"
                                    <?=$city->country_id == $coun['id'] ? 'selected' : ''?>><?=_i($coun['title'])?>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="{{$city_data->title}}" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <button type="submit" class="btn btn-info text-center col-sm-4" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>

@endsection

@section('footer')
 <script>
        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(300).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#new_img').attr('src', e.target.result).width(300).height(250);
            };
            filereader.readAsDataURL(input.files[0]);
        }

    </script>

@endsection
