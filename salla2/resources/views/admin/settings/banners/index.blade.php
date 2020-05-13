<div class="modal fade" id="modal-banner">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"> {{_i('Add Banner')}} </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="{{url('adminpanel/settings/banner/store')}}" method="POST" id="form_1" data-parsley-validate=""
                      id="fileupload"  enctype="multipart/form-data" >

                    @csrf
                    <div class="box-body">
                        <!-- ================================== Title =================================== -->
                        <div class="form-group row">

                            <label for="name" class="col-xs-2 col-form-label"> {{_i('Name')}} </label>

                            <div class="col-xs-10">
                                <input type="text" class="form-control" name="name" placeholder="{{_i('Banner Name')}}"
                                        value="{{old('name')}}" data-parsley-length="[3, 191]">

                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>

                            </div>
                        </div>


                        <div class="form-group row ">

                            <label for="name" class="col-xs-2 col-form-label"> {{_i('link')}} </label>

                            <div class="col-xs-10">
                                <input  type="text" class="form-control" name="link" placeholder="{{_i('Banner link')}}"
                                        value="{{old('link')}}" data-parsley-length="[3, 191]" required="">

                                <span class="text-danger invalid-feedback">
                                                                <strong>{{$errors->first('link')}}</strong>
                                                            </span>

                            </div>
                        </div>

                        <!----==========================  published ==========================--->

                        <!-- checkbox -->
                        <div class="form-group row" >

                            <label class="col-xs-2 col-form-label" for="checkbox">
                                {{_i('Publish')}}
                            </label>
                            <div class="col-xs-10">
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{old('published') == 1 ? 'checked' : ''}} >
                            </div>

                        </div>

                        <div class="form-group row ">

                            <label for="name" class="col-xs-2 col-form-label"> {{_i('Sort Order')}} </label>

                            <div class="col-xs-10">
                                <input id="sort_order" type="number" class="form-control" name="sort_order" placeholder="{{_i('Banner Sort Order')}}"
                                       min="1" max="5" data-parsley-type="number" data-parsley-min="1" data-parsley-max="5" value="{{old('sort_order')}}"  required="">

                                <span class="text-danger invalid-feedback">
                                                                <strong>{{$errors->first('sort_order')}}</strong>
                                                            </span>

                            </div>
                        </div>

                        <div class="form-group row" id="category" style="display: none">

                            <label for="category_id" class=" col-xs-2 col-form-label"> {{_i('Category')}}
                            </label>

                            <div class="col-xs-10">
                                <select class="form-control" name="category_id">
                                    @foreach($categories as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>



                        <!-- ================================== description =================================== -->
                        <div class="form-group row">

                            <label for="description" class="col-xs-2 col-form-label"> {{_i('Description')}} </label>

                            <div class="col-xs-10">
                                <textarea id="description" class="form-control" name="description" placeholder="{{_i('Banner description')}}&hellip;"
                                minlength="20" data-parsley-minlength="20" required="" >{{old('description')}}</textarea>
                            </div>

                        </div>


                        <!-- ================================== image =================================== -->
                        <div class="form-group">
                            <label class="col-xs-2 col-form-label" for="logo">{{_i('Image')}}</label>
                            <div class="col-xs-10">
                                <input type="file" name="image" id="logo" onchange="showBannerImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                       value="{{old('image')}}" required="">
                                <span class="text-danger invalid-feedback">
                                                                <strong>{{$errors->first('image')}}</strong>
                                                            </span>
                            </div>
                            <!-- Photo -->
                            <img class="img-responsive pad" id="banner_img" hidden style="margin-top: -130px;  margin-right:370px;">
                        </div>

                    </div>
                    <!-- ================================Submit==================================== -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> {{_i('Close')}} </button>
                        <button class="btn btn-info" type="submit" id="s_form_1"> {{_i('Save')}} </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!---------------- /.modal end ----------------->


<!-------------------------------- destreoy model ------------------------------->
<form action="" method="POST" class="remove-edit-model">
    @method('DELETE')
    @csrf
    <div id="delete-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modal Label">{{_i('delete')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('are you sure to delete this one ?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('cancel')}}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('delete')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-------------------------------- end destroy model ---------------------------->


<div class="card blog-page" id="blog">
    <div class="card-header">
        <h1>
            {{_i('Banners')}}
        </h1>
    </div>
<div class="card-block">

    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
        {{--        @dd(count($banners))--}}
        <div class="dt-buttons" style="padding-right: 330px;">
            <button class="dt-button btn btn-default" @if(count($banners) >= 5) style="display: none" @endif type="button"  data-toggle="modal" data-target="#modal-banner">
                <span><i class="ti-plus"></i> {{_i('create new banner ')}} </span>
            </button>
            {{--                                            <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">--}}
            {{--                                                <span><i class="fa fa-print"></i></span>--}}
            {{--                                            </button>--}}
        </div>



        <table class="table table-hover text-center table table-bordered table-striped table-responsive dataTable" id="jobtypes_table">
            <thead>
            <tr>
                <td class="text-left"> {{_i('name')}} </td>
                <td class="text-left"> {{_i('Sort Order')}} </td>
                <td class="text-left"> {{_i('Image')}} </td>
                <td class="text-right"> {{_i('Created At')}} </td>
                <td class="text-right"> {{_i('Action')}} </td>
            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
{{--                @dd($banner)--}}
                <tr>
                    <td class="text-center" > {{$banner->name}} </td>
                    <td class="text-center" > {{$banner->sort_order}} </td>

                    <td class="text-center" >
                        <img src="{{asset('uploads/settings/banners/'.$banner->id.'/'.$banner->image)}}" border="0" class="img-responsive img-rounded"
                             width="100" height="100" align="center" />
                    </td>
                    <td class="text-center" > {{$banner->created_at}} </td>
                    <td class="text-center" >
                        <div class="text-center">
                            <a href="settings/banner/{{$banner->id}}/edit" target="_blank" class="btn btn-icon waves-effect waves-light btn-primary" title="{{_i('Edit')}}">
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </a>&nbsp;


{{--                            <a class="btn btn-icon waves-effect waves-light btn btn-danger remove-edit" data-toggle="modal" title="{{_i('Delete')}}"--}}
{{--                               data-url="{{ \Illuminate\Support\Facades\URL::route('banner.destroy', $banner->id) }}" data-id="{{$banner->id}}" data-target="#delete-edit-modal">--}}
{{--                                <i class="fa fa-trash"></i>--}}
{{--                                --}}{{--                                                                <input type="hidden" name="_method" value="delete" />--}}
{{--                                --}}{{--                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                            </a>--}}


                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    </div>
</div>

<script>

</script>
