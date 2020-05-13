@extends('admin.layout.index',[
'title' => _i('Edit product'),
'activePageName' => _i('Edit product'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit Product') }}</h5>
        </div>
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-expanded="true">{{ _i('General') }}</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#codes" role="tab" aria-expanded="false">{{ _i('Codes') }}</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#images" role="tab" aria-expanded="false">{{ _i('Images') }}</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#requirements" role="tab" aria-expanded="false">{{ _i('System Requirements') }}</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#other" role="tab" aria-expanded="false">{{ _i('Other Data') }}</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="card-block">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="general" role="tabpanel" aria-expanded="true">
                                @include('admin.products.edit.general')
                            </div>
                            <div class="tab-pane" id="codes" role="tabpanel" aria-expanded="true">
                                @include('admin.products.edit.code')
                            </div>
                            <div class="tab-pane" id="images" role="tabpanel" aria-expanded="true">
                                @include('admin.products.edit.image')
                            </div>
                            <div class="tab-pane" id="requirements" role="tabpanel" aria-expanded="true">
                                @include('admin.products.edit.requirements')
                            </div>
                            <div class="tab-pane" id="other" role="tabpanel" aria-expanded="true">
                                @include('admin.products.edit.other')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        };

        $('.card .nav-item a').on('click', function(e) {
            var currentAttrValue = $(this).attr('href');
            $('.card ' + currentAttrValue).show().siblings().hide();
            $(this).addClass('active').parent('li').children().removeClass('active');
            e.preventDefault();
        });

        //edit user description
        $('#edit-cancel-btn').on('click', function() {

            var c = $('#edit-info-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-info').show();
            $('.edit-info').hide();

        });

        $('.edit-info').hide();


        $('#edit-info-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-info').hide();
                $('.edit-info').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-info').show();
                $('.edit-info').hide();
            }
        });

        $('#edit-cancel-btn-image').on('click', function() {

            var c = $('#edit-image-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-image').show();
            $('.edit-image').hide();

        });

        $('.edit-image').hide();


        $('#edit-image-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-image').hide();
                $('.edit-image').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-image').show();
                $('.edit-image').hide();
            }
        });

        $('#edit-cancel-btn-video').on('click', function() {

            var c = $('#edit-video-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-video').show();
            $('.edit-video').hide();

        });

        $('.edit-video').hide();


        $('#edit-video-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-video').hide();
                $('.edit-video').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-video').show();
                $('.edit-video').hide();
            }
        });

        $('#edit-cancel-btn-requirements').on('click', function() {

            var c = $('#edit-requirements-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-requirements').show();
            $('.edit-requirements').hide();

        });

        $('.edit-requirements').hide();


        $('#edit-requirements-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-requirements').hide();
                $('.edit-requirements').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-requirements').show();
                $('.edit-requirements').hide();
            }
        });

        $('#edit-cancel-btn-languages').on('click', function() {

            var c = $('#edit-languages-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-languages').show();
            $('.edit-languages').hide();

        });

        $('.edit-languages').hide();


        $('#edit-languages-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-languages').hide();
                $('.edit-languages').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-languages').show();
                $('.edit-languages').hide();
            }
        });

        $('#edit-cancel-btn-details').on('click', function() {

            var c = $('#edit-details-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-details').show();
            $('.edit-details').hide();

        });

        $('.edit-details').hide();


        $('#edit-details-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-details').hide();
                $('.edit-details').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-details').show();
                $('.edit-details').hide();
            }
        });

        $('#edit-cancel-btn-genre').on('click', function() {

            var c = $('#edit-genre-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-genre').show();
            $('.edit-genre').hide();

        });

        $('.edit-genre').hide();


        $('#edit-genre-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-genre').hide();
                $('.edit-genre').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-genre').show();
                $('.edit-genre').hide();
            }
        });

        $('#edit-cancel-btn-codes').on('click', function() {

            var c = $('#edit-codes-btn').find("i");
            c.removeClass('icofont-close');
            c.addClass('icofont-edit');
            $('.view-codes').show();
            $('.edit-codes').hide();

        });

        $('.edit-codes').hide();


        $('#edit-codes-btn').on('click', function() {
            var b = $(this).find("i");
            var edit_class = b.attr('class');
            if (edit_class == 'icofont icofont-edit') {
                b.removeClass('icofont-edit');
                b.addClass('icofont-close');
                $('.view-codes').hide();
                $('.edit-codes').show();
            } else {
                b.removeClass('icofont-close');
                b.addClass('icofont-edit');
                $('.view-codes').show();
                $('.edit-codes').hide();
            }
        });

        Dropzone.autoDiscover = false;
        var drop;
        $(document).ready(function () {
            'use strict';
            drop = $('#dropzonefield').dropzone({
                url: "{{aUrl('products/upload/image/'.$product->id)}}",
                paramName:'file' ,
                uploadMultiple:true ,
                maxFiles:10,
                maxFilesize:5,
                dictDefaultMessage:"{{_i('Click here to upload files or drag and drop files here')}}",
                dictRemoveFile:"{{ _i('Delete') }}",
                acceptedFiles:'image/*',
                autoProcessQueue: true,
                parallelUploads:1,
                removeType: "server",
                params:{
                    _token: '{{csrf_token()}}' ,
                },
                addRemoveLinks:true,
                removedfile: function (file) {
                    if(drop[0].dropzone.options.removeType == "server") {
                        $.ajax({
                            dataType:'json',
                            type:'POST',
                            url:'{{aUrl('products/delete/image/'.$product->id)}}',
                            data:{file:file.name,_token:'{{csrf_token()}}'},
                        });
                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                    }else{
                        file.previewElement.remove();
                    }
                },
                success:function (file,response) {
                    file.id = response.id;
                }
            });
            @foreach($product->files->where('main',0) as $photo)
                var file = { id: '{{$photo->id}}', name: '{{$photo->tag}}', type: "image/*" };
                var url = '{{ asset($photo->image) }}';
                drop[0].dropzone.emit("addedfile", file);
                drop[0].dropzone.emit("thumbnail", file, url);
                drop[0].dropzone.emit("complete", file);
            @endforeach
        });

        function uploadFiles(){
            drop[0].dropzone.processQueue();
        }

        $(function () {
            'use strict';

            $( "#form-info" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = new FormData(this);
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.update', $product->id)}}',
                    data:form,
                    method: 'post',
                    // type:'put',
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res == true) {
                            $('#errors').css("display","none");
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        } else if(res[0] == false) {
                            $('#errors').css("display","block").html(res[1].video);
                        }
                    }
                })
            })
        });

        $(function () {
            'use strict';

            $( "#form-requirements" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = $(this).serialize();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.requirements', $product->id)}}',
                    data:form,
                    type:'post',
                    dataType: 'json',
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        $('#system_requirements').empty();
                        if(res[0] == true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                        $('#system_requirements').html(res[1]);
                    }
                })
            })
        });

        $(function () {
            'use strict';

            $( "#form-languages" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = $(this).serialize();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.languages', $product->id)}}',
                    data:form,
                    type:'post',
                    dataType: 'json',
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res == true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    }
                })
            })
        });

        $(function () {
            'use strict';

            $( "#form-details" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = $(this).serialize();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.details', $product->id)}}',
                    data:form,
                    type:'post',
                    dataType: 'json',
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res == true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    }
                })
            })
        });

        $(function () {
            'use strict';

            $( "#form-genre" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = $(this).serialize();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.genre', $product->id)}}',
                    data:form,
                    type:'post',
                    dataType: 'json',
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res == true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    }
                })
            })
        });

        $(function () {
            'use strict';

            $( "#form-codes" ).on( "submit", function( event ) {
                event.preventDefault();
                var form = $(this).serialize();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:'{{ route('products.codes', $product->id)}}',
                    data:form,
                    type:'post',
                    dataType: 'json',
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res == true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Updated Successfully !') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }  else if(res[0] == false) {
                            $('#errors').css("display","block").html(res[1].email);
                        }
                    }
                })
            })
        });
    </script>

@endpush
