{{--@extends('admin.layout.productLayout')--}}

@extends('admin.AdminLayout.index')
@section('title')
{{--    {{_i('edit ').$products[0]->title}}--}}
@endsection

@section('page_header_name')
{{--    {{_i('edit ').$products[0]->title}}--}}
@endsection


@section('content')
    @push('app')

        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
    @push('css')
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('admin/dropzone.css')}}">

        <style>
            .product-desc .dropdown-item{
                display: block;
                width: 100%;
                padding: .25rem 0 .25rem 1.5rem;
                clear: both;
                font-weight: 400;
                color: #212529;
                text-align: right;
                white-space: nowrap;
                background: 0 0;
                border: 0;
            }
            .type .dropdown-item{
                text-align: right;
            }

            .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text{
                margin-left: 34px;
            }
            .dropdown-menu{
                z-index: 9999;
            }
            .input-group .form-control{
                width: 100%;
            }
        </style>

    @endpush


    <products-lists-edit :store="{{$store}}" :features="{{$features}}" :products="{{$products}}" :product_type="{{$product_type}}" :categories="{{$categories}}"></products-lists-edit>

    <div class="pace-demo d-none">
        <div class="theme_tail_circle">
            <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
            <div class="pace_activity"></div>
        </div>
        <p>{{_i('save now')}}</p>
    </div>

    @include('admin.products.products.partial.modal')


@endsection
@push('js')
    <script src="{{ asset('admin/dropzone.js')}}"></script>

    <script>
        $(function () {
            $('.product-desc .selectpicker').on('change',function(e){
                $(this).next().next().addClass('show');
            })
            $('body').click(function () {
                $('.product-desc .selectpicker').next().next().removeClass('show');
            })

        })


        Dropzone.autoDiscover = false;
        var drop;
        $(document).ready(function () {
            'use strict';
            drop = $('#dropzonefield').dropzone({
                {{--                url: "{{url('admin/banner/upload/image/'.request()->id)}}",--}}
                url: "{{url('/adminpanel/product/imagespost')}}",
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
                    product_id: '{{request()->id}}' ,
                },
                addRemoveLinks:true,
                removedfile: function (file) {
                    if(drop[0].dropzone.options.removeType == "server") {
                        $.ajax({
                            dataType:'json',
                            type:'POST',
                            {{--url:'{{url('admin/banner/delete/image/'.request()->id)}}',--}}
                            url:'{{url('/adminpanel/imagesdel/')}}',
                            data:{file:file.name,
                                _token:'{{csrf_token()}}',
                                id:file.id,
                            },
                        });
                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                    }else{
                        file.previewElement.remove();
                    }
                },

                success:function (file,response) {
                    file.id = response.id;
                },


            });
                    @foreach($product->product_photos->where('main',0) as $photo)
            var file = { id: '{{$photo->id}}', name: '{{$photo->tag}}', type: "image/*" };
            var url = '{{ asset($photo->photo) }}';
            drop[0].dropzone.emit("addedfile", file);
            drop[0].dropzone.emit("thumbnail", file, url);
            drop[0].dropzone.emit("complete", file);
            @endforeach
        });

        function uploadFiles(){
            drop[0].dropzone.processQueue();
        }

        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('.image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        {{--$('body').on('click','.optional-category',function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--        $.ajax({--}}
        {{--            url: '{{ route('get-product-data') }}',--}}
        {{--            method: "get",--}}
        {{--            data: {_token: '{{ csrf_token() }}',--}}
        {{--                id: $(this).data('id'),--}}
        {{--            },--}}
        {{--            success: function (response) {--}}

        {{--                // window.location.reload();--}}
        {{--            }--}}
        {{--        });--}}


        {{--});--}}
        $('body').on('submit','#form-details',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{url('/adminpanel/saveProductDetails')}}',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    console.log(response);
                    // if (response.errors){
                    //     $('#masages_model1').empty();
                    //     $.each(response.errors, function( index, value ) {
                    //         $('#masages_model1').show();
                    //         $('#masages_model1').append(value + "<br>");
                    //     });
                    // }
                    if (response == 'success'){

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        // table.ajax.reload();
                        // $('#masages_model1').hide();
                        // $modal = $('#create');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        })



    </script>
@endpush
