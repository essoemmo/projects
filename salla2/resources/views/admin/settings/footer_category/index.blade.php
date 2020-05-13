@extends('admin.AdminLayout.index')

<!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
    <form  class="form-horizontal" action="{{url('/adminpanel/settings/footer_category/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title_1" class="col-sm-2 control-label" > {{_i('Title')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="text" class="form-control" name="title" required="" placeholder="{{ _i('Footer Title')}}" data-parsley-length="[3, 191]">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>



        </div>
        <!-- ================================Submit==================================== -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>
        </div>
    </form>
@endsection



<!-- ==============================Add Form=============================================-->
@section('job_type_form')

    <form class="form-horizontal"  id="form_1" method="post" action="{{url('adminpanel/settings/footer_category/store')}}"  data-parsley-validate="">
        @csrf

        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group row">

                <label for="title" class="col-sm-2 control-label" >{{_i('Title')}} <span style="color: #db1b4c"> * </span></label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" maxlength="191" data-parsley-maxlength="191" required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <!-- ================================Submit==================================== -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
            </div>

        </div>
    </form>
@endsection
<!-- ==============================Edit Model=============================================-->
@section('jobtype_edit_model')
    <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Edit Footer Category')}}</h4>
                </div>
                <div class="modal-body">
                    @yield('jobtype_edit_form')
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ==============================Add Model=============================================-->
@section('jobtype_add_edit_model')
    <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Add Footer Category')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    @yield('job_type_form')
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- ==============================Table Show=============================================-->
@section('jobtype_show_model')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.AdminLayout.message')

            <div  id="dataTableBuilder_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="dt-buttons" style="padding-right: 330px;">
                    <button class="dt-button btn btn-default"  @if(\App\Models\Settings\FooterCategory::count() >= 3) style="display: none" @endif type="button"  data-toggle="modal" data-target="#modal-default">
                        <span><i class="ti-plus"></i> {{_i('create new footer category ')}} </span>
                    </button>
{{--                    <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">--}}
{{--                        <span><i class="fa fa-print"></i></span>--}}
{{--                    </button>--}}
                </div>




                <table class="table table-hover text-center table table-bordered table-striped table-responsive dataTable" id="jobtypes_table">
                    <thead><tr>
                        <th class="sorting" >{{ _i('ID')}}</th>
                        <th class="sorting" >{{ _i('Title')}}</th>
                        <th class="sorting" >{{ _i('Created At')}}</th>
                        <th class="sorting" >{{ _i('Action')}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
    </div>
@endsection


<!-- ==============================Head=============================================-->
@section('title')

    {{_i('Footers Category')}}

@endsection


@section('page_header_name')
    {{_i('Footers Category')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="ti-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/settings/footer_category/all')}}">{{_i('Footers Category')}}</a></li>
@endsection



<!-- ==============================Main=============================================-->
@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>


    @yield('jobtype_edit_model')
    @yield('jobtype_add_edit_model')
    @yield('jobtype_show_model')

@endsection

<!-- ==============================footer=============================================-->

@push('js')
    <script  type="text/javascript">

        /* Data table display*/
        $(document).ready(
            $("#jobtypes_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/settings/footer_category/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title){
            $('#id_1').val(id);
            $('#title_1').val(title);
        }

    </script>


@endpush
<style>
    .table{
        display: table !important;
    }
    .row,#jobtypes_table_wrapper{
        width: 100% !important;
    }
</style>




{{--<div class="flash-message">--}}
{{--    @foreach (['danger', 'warning', 'success', 'info'] as $msg)--}}
{{--        @if(Session::has($msg))--}}
{{--            <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--</div>--}}

{{--    add currency--}}
{{--<div class="modal fade" id="exampleModalCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCatLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span></button>--}}
{{--                <h4 class="modal-title"> {{_i('Add Footer Category')}} </h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}

{{--                <form method="post" action="{{url('adminpanel/settings/footer_category/store')}}" id="form">--}}
{{--                    {{csrf_field()}}--}}
{{--                    {{method_field('post')}}--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{_i('Title')}}</label>--}}
{{--                        <input type="text" name="title" class="form-control">--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>--}}
{{--                <button type="button" class="btn btn-info" id="save">{{_i('Add')}}</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--edited currency--}}
{{--<div class="modal fade" id="exampleModalCatedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCatLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span></button>--}}
{{--                <h4 class="modal-title"> {{_i('Edit Footer Category')}} </h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body" id="editmodel">--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>--}}
{{--                <button type="submit" class="btn btn-info" id="saveeditCat">{{_i('Save')}}</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



{{--    <div class="dt-buttons" style="padding-right: 330px;">--}}

{{--        <button class="dt-button btn btn-default" @if(\App\Models\Settings\FooterCategory::count() >= 3) style="display: none" @endif  type="button"  data-toggle="modal" data-target="#exampleModalCat">--}}
{{--            <span><i class="fa fa-plus"></i> {{_i('create new footer category ')}} </span>--}}
{{--        </button>--}}



{{--    </div>--}}

{{--    @if(\App\Models\Settings\FooterCategory::count() > 0)--}}
{{--        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>{{_i('Title')}}</th>--}}
{{--                <th>{{_i('Created At')}}</th>--}}
{{--                <th>{{_i('Control')}}</th>--}}

{{--            </tr>--}}
{{--            </thead>--}}

{{--            @foreach(\App\Models\Settings\FooterCategory::get() as $category)--}}
{{--            <tbody>--}}

{{--                <tr>--}}
{{--                    <td>{{$category->title}}</td>--}}
{{--                    <td>{{$category->created_at}}</td>--}}
{{--                    <td>--}}


{{--                        <button class="btn btn-icon waves-effect waves-light btn-primary" title="{{_i('Edit')}}" data-id="{{$category->id}}" data-title="{{$category->title}}" data-toggle="modal" data-target="#exampleModalCatedit" id="edit">--}}
{{--                            <i class="fa fa-edit"></i>--}}
{{--                        </button>--}}



{{--                        <form action="{{route('footer_category.destroy',$category->id  )}}" method="post" style="display: inline-block">--}}
{{--                            {{csrf_field()}}--}}
{{--                            {{method_field('delete')}}--}}
{{--                            <button class="btn btn-icon waves-effect waves-light btn btn-danger" title="{{_i('Delete')}}" type="submit">--}}
{{--                               <i class="fa fa-trash"></i>--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    @else--}}
{{--        <h2>{{_i('Sorry no footer category avaliable')}}</h2>--}}
{{--    @endif--}}

{{--@push('js')--}}

{{--   <script type="javascript">--}}

{{--       $(document).ready(function () {--}}
{{--           $('body').on('click','#saveeditCat',function (e) {--}}
{{--               e.preventDefault();--}}

{{--               $('#formeditCat').submit();--}}
{{--           });--}}

{{--           $('body').on('click','#save',function (e) {--}}
{{--               e.preventDefault();--}}

{{--               $('#form').submit();--}}
{{--           });--}}

{{--           $('body').on('click','#edit',function (e) {--}}
{{--               e.preventDefault();--}}

{{--               var id = $(this).data('id');--}}
{{--               var title = $(this).data('title');--}}

{{--               var html = `<form action="{{route('edit_footer_category')}}"  method="post" id="formeditCat">--}}
{{--        @csrf--}}
{{--                       {{method_field('put')}}--}}
{{--                   <input type="hidden" name="id" value=${id} class="form-control">--}}

{{--        <div class="form-group">--}}
{{--            <label>title</label>--}}
{{--            <input type="text" name="title" value=${title} class="form-control">--}}
{{--        </div>--}}
{{--    </form>`;--}}
{{--               $('#editmodel').empty();--}}
{{--               $('#editmodel').append(html);--}}

{{--           });--}}

{{--           --}}{{--$('body').on('click','#active',function (e) {--}}
{{--           --}}{{--    e.preventDefault();--}}
{{--           --}}{{--    var id = $(this).data('id');--}}

{{--           --}}{{--    $.ajax({--}}
{{--           --}}{{--        url: '{{ route('update-active') }}',--}}
{{--           --}}{{--        method: "patch",--}}
{{--           --}}{{--        data: {_token: '{{ csrf_token() }}', id: id },--}}
{{--           --}}{{--        success: function (response) {--}}

{{--           --}}{{--            window.location.reload();--}}
{{--           --}}{{--        }--}}
{{--           --}}{{--    });--}}
{{--           --}}{{--});--}}

{{--       });--}}

{{--   </script>--}}
{{-- @endpush--}}