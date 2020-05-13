@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">الاقسام الفرعية</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="table-responsive">
                    <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                        <div class="row">
                            <div class="col-md-12">

                                <button type="button" style="float: left" class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_category">
                                    <i class="fa fa-plus"></i>
                                    اضافة جديد
                                </button>

                                <div>
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <table id="master_table" class="table table-bordered table-hover text-center">
                                        </table>
                                    </div>
                                </div><!-- .widget-body -->
                            </div><!-- .widget -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        <!-- Modal -->
                        <div class="modal fade" id="create_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">اضافة قسم جديد</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="addform" method="post" data-parsley-validate>
                                        @csrf
                                        @method('post')
                                        <div class="modal-body">


                                            <div class="form-group">
                                                <lable for="name">الاقسام الرئيسية</lable>
                                                <select class="form-control" name="catId">
                                                    <option value=" ">اختيار قسم فرعي</option>
                                                @foreach($category as $cate)
                                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                            @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <lable for="name">الاسم</lable>
                                                <input type="text" name="name" required="" class="form-control">
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">اضافة قسم جديد</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="editform" method="post" data-parsley-validate>
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">


                                            <div class="form-group">
                                                <input type="hidden" name="catId" id="Cat_id" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <lable for="name">الاقسام الرئيسية</lable>
                                                <select class="form-control" name="cat_id" id="Cat_id_select">
                                                    <option value=" ">اختيار قسم فرعي</option>
                                                    @foreach($category as $cate)
                                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <lable for="name">الاسم</lable>
                                                <input type="text" name="name" id="name" required="" class="form-control">
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @endsection

                        @push('js')
                            <script>

                                // samer
                                $(function () {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    var table = $('#master_table').DataTable({
                                        responsive: true,
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            url: "{{ route('subcategories.index') }}",
                                            type: 'GET',
                                        },
                                        // select: true,
                                        columns: [
                                            {data: 'id', name: 'id' ,title:'id'},
                                            {data: 'name', name: 'name',title:'name'},
                                            {data: 'action', name: 'action',title:'action' ,searchable: 'false'},
                                            // {data: 'add_lang', name: 'add_lang',title:'add_lang' ,searchable: 'false'}
                                        ]
                                    });

                                    $('body').on('submit','#addform',function (e) {
                                        e.preventDefault();
                                        // alert('asdasd');
                                        $.ajax({
                                            url: '{{ route('subcategories.store') }}',
                                            method: "post",
                                            data: new FormData(this),
                                            dataType: 'json',

                                            cache       : false,
                                            contentType : false,
                                            processData : false,

                                            success: function (response) {
                                                if(response.status == 'success'){
                                                    new Noty({
                                                        type: 'success',
                                                        layout: 'topRight',
                                                        text: "تمت الاضافة بنجاح",
                                                        timeout: 2000,
                                                        killer: true
                                                    }).show();
                                                }

                                                table.ajax.reload();
                                                $modal = $('#create_category');
                                                $modal.find('form')[0].reset();
                                                // window.location.reload();
                                            },

                                        });
                                    });

                                    $('body').on('click','.edit',function (e) {
                                        e.preventDefault();

                                        var id = $(this).data('catid');
                                        var name = $(this).data('name');
                                        var mainCat = $(this).data('maincat');

                                        $('#Cat_id').val(id);
                                        $('#name').val(name);
                                        $('#Cat_id_select').val(mainCat);

                                    })

                                    $('body').on('submit','#editform',function (e) {
                                        e.preventDefault();
                                        let id = $('#Cat_id').val();
                                        var url = '{{ route("subcategories.update", ":id") }}';
                                        url = url.replace(':id', id);

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
                                                    $.each(response.errors, function( index, value ) {

                                                        // console.log(value);

                                                        new Noty({
                                                            type: 'success',
                                                            layout: 'topRight',
                                                            text: value,
                                                            timeout: 2000,
                                                            killer: true
                                                        }).show();
                                                    });
                                                }
                                                if(response.status == 'success'){
                                                    new Noty({
                                                        type: 'success',
                                                        layout: 'topRight',
                                                        text: "تمت التعديل بنجاح",
                                                        timeout: 2000,
                                                        killer: true
                                                    }).show();
                                                }

                                                table.ajax.reload();
                                                // $modal = $('#edit_category');
                                                // $modal.find('form')[0].reset();
                                                // table.ajax.reload();
                                                // window.location.reload();
                                            }

                                        });
                                    })

                                    $('body').on('submit','#delform',function (e) {
                                        e.preventDefault();
                                        var url = $(this).attr('action');
                                        // alert(url);

                                        $.ajax({
                                            url: url,
                                            method: "delete",
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                            },
                                            success: function (response) {

                                                if (response.status == 'success'){
                                                    new Noty({
                                                        type: 'success',
                                                        layout: 'topRight',
                                                        text: "تم الحذف بنجاح",
                                                        timeout: 2000,
                                                        killer: true
                                                    }).show();
                                                    table.ajax.reload();
                                                }
                                                // console.log(response);
                                                // window.location.reload();
                                            }
                                        });
                                    })


                                })



                            </script>

    @endpush

