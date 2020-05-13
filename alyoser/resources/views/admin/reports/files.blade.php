@extends('admin.layout.master')
@section('content')

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">التقارير</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="table-responsive">
                    <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <div class="col-md-12">
                                        <!-- Table -->
                                        <table id="master_table" class="table table-bordered table-hover text-center">
                                        </table>
                                    </div>
                                </div><!-- .widget-body -->
                            </div><!-- .widget -->
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <form method="post" id="send_mail" data-parsley-validate>
                                            @csrf
                                            @method('post')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="hidden" name="file"  id="file" value="">
                                                        <input type="hidden" name="idFile" id="idFile" value="">

                                                        <div class="form-group">
                                                            <label>اارسل الايميل </label>
                                                            <input type="email" name="email" class="form-control"style="width: 147%" required="">
                                                        </div>
                                                    </div>
                                                </div>
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

                                    var table = $('#master_table').DataTable({
                                        responsive: true,
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            url: "{{ route('reports.show',$id) }}",
                                            type: 'GET',
                                        },
                                        // select: true,
                                        columns: [
                                            {data: 'id', name: 'id' ,title:'id'},
                                            {data: 'tag', name: 'tag',title:'الاسم'},
                                            {data: 'action', name: 'action',title:'التحميل' ,searchable: 'false'},
                                            // {data: 'add_lang', name: 'add_lang',title:'add_lang' ,searchable: 'false'}
                                        ]
                                    });



                                    $('body').on('click','.print',function (e) {

                                                e.preventDefault();


                                        var path = $(this).data('file');

                                            var iframe = document.createElement('iframe');


                                            // iframe.id = 'pdfIframe'

                                        var url = path ;

                                            iframe.className='pdfIframe'
                                            document.body.appendChild(iframe);
                                            iframe.style.display = 'none';
                                            iframe.onload = function () {
                                                setTimeout(function () {
                                                    iframe.focus();
                                                    iframe.contentWindow.print();
                                                    URL.revokeObjectURL(url)
                                                    document.body.removeChild(iframe)
                                                }, 1);
                                            };
                                            iframe.src = url;
                                            // URL.revokeObjectURL(url)


                                    });

                                    $('body').on('click','.sendEmail',function (e) {
                                                e.preventDefault();

                                                var path = $(this).data('file');
                                                var id = $(this).data('id');

                                                 $('#file').val(path);
                                                 $('#idFile').val(id);

                                    });

                                    $('body').on('submit','#send_mail',function(e){
                                        e.preventDefault();


                                        $.ajax({
                                            url: '{{route('send-email')}}',
                                            method: "post",
                                            data: new FormData(this),
                                            dataType: 'json',
                                            cache       : false,
                                            contentType : false,
                                            processData : false,

                                            success: function (response) {
                                                if(response == 'success'){
                                                    new Noty({
                                                        type: 'success',
                                                        layout: 'topRight',
                                                        text: "تم ارسال الملف بنجاح",
                                                        timeout: 2000,
                                                        killer: true
                                                    }).show();

                                                    $modal = $('#exampleModal');
                                                    $modal.find('form')[0].reset();
                                                }
                                            },

                                        });

                                    })

                                });



                            </script>



    @endpush

