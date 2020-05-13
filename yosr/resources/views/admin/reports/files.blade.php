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



                                            var iframe = document.createElement('iframe');


                                            // iframe.id = 'pdfIframe'

                                        var url = "{{ asset('uploads/files/2/5.docx') }}" ;

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

                                })



                            </script>



    @endpush

