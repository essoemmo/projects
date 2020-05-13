
@extends('admin.AdminLayout.index',[
'title' => _i('Add Role'),
'subtitle' => _i('Add Role'),
'activePageName' => _i('Add Role'),
'additionalPageUrl' => url('/adminpanel/role/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
            <form  action="{{url('/adminpanel/role/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf
                <div class="box-body">
                <div class="form-group row">
                </div>


                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label"  >
                            {{_i('Language')}} </label>
                        <div class="col-sm-6">
                            <select class="form-control" name="lang_id" id="selected_lang">
                                <option selected disabled><?= _i('CHOOSE')?></option>
                                @foreach($langs as $lang)
                                    <option value="{{$lang->id}}}">{{_i($lang->title)}}</option>
                                @endforeach
                            </select>
                            <small  class="form-text text-muted">{{_i('Please select language to change Permissions name according to language selected ')}}</small>
                        </div>
                    </div>

                <div class="form-group row" >

                    <label class="col-sm-2 col-form-label" for="txtUser">
                        {{_i('Role Name')}} </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="txtUser" required="" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger ">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


{{--                <!-- ========================= guard name ============================= -->--}}
{{--                    <input type="hidden" name="guard_name" value="{{$guard_name}}">--}}
                    <!--- ===================== permissions ==========================--->
                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">
                        {{_i('Permissions')}} </label>
                </div>
                <div class="form-group row"  id="permissions" >
                    @foreach($permissionNames as $permission)

                        @php
                            $permission_data = \Spatie\Permission\Models\Permission::
                            leftJoin('permission_data','permission_data.permission_id','permissions.id')
                            ->where('permission_data.permission_id', $permission->id)
                            ->where('permission_data.lang_id', \App\Bll\Utility::storeLang())
                            ->first();
                        @endphp
                    
                        <div class="col-sm-3">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input id="{{$permission->id}}" type="checkbox" name="groups[]" value="{{$permission->id}}" data-parsley-multiple="groups" required="">
                                    <span class="cr">
                                   <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
{{--                                    {{$permission['name']}}--}}
                                    {{$permission_data['title']}}
                                </label>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="form-group row " {{-- style="margin-right: 60%; margin-top: 5%;"--}}>
                    <div class="col-sm-offset-2 col-sm-2">
                        {{--<input type="submit" class="btn btn-default" value="Save">--}}
                        <button type="submit" class="btn btn-primary pull-leftt"> {{_i('Add Role')}}</button>
                    </div>
                </div>
                </div>
            </form>

        </div>
        </div>
    </div>

@endsection

@push('js')
    <script  type="text/javascript">

        $('#selected_lang').on('change', function(){
            $("#permissions").empty();
            var langId = $('#selected_lang').val();
            $.ajax({

                url: "{{url('/adminpanel/permission/')}}/"+langId,
                type: "get",
                success: function (result) {
                    var data = result;
                    console.log(data.length);
                    var html = "";
                    for (var i = 0; i < data.length; i++)
                    {
                        html += '<div class="col-sm-3"> <div class="checkbox-fade fade-in-primary"><label>' +
                            '<input  id="check'+i+'" type="checkbox" name="groups[]" value="'+data[i].id+'" data-parsley-multiple="groups"  required=""> ' +
                            '<span class="cr"> <i class="cr-icon icofont icofont-ui-check txt-primary"></i> </span> '+data[i].title +
                            '</label> </div> </div>';

                    }
                    $("#permissions").html(html);

                }
            });
        });

    </script>
@endpush