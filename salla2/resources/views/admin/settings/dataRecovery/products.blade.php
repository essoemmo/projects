@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Products Data Recovery')}}
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>

        .product-desc .dropdown-menu {
            position: static !important;
        }

        .dropdown-menu.open {
            left: 70px;
            overflow: visible;
        }

        input {
            padding-right: 30px !important;
        }

        .btn.btn-tiffany {
            cursor: pointer;
        }


        .dropdown-menu.open {
            left: -70px;
            overflow: visible;
            /*left: 0;*/
        }


        .product-desc .dropdown-item {
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

        .type .dropdown-item {
            text-align: right;
        }

        .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
            margin-left: 34px;
        }

        .dropdown-menu {
            z-index: 9999;
        }
    </style>

    <!--<link rel="stylesheet" href="{{asset('css/custom.css')}}">-->
    <link rel="stylesheet" href="{{asset('admin/dropzone.css')}}">

    <style>
        .product-desc .dropdown-item {
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

        .type .dropdown-item {
            text-align: right;
        }

        .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
            margin-left: 34px;
        }

        .dropdown-menu {
            z-index: 9999;
        }
    </style>

@endpush

@section('content')

    <div class="products-lists">

        <div class="content">

            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-md-4 col-sm-3">
                            <div class="product-box">
                                <div class="frm_product">
                                    <div class="product-img-details">
                                        <img src="{{ asset($product->mainPhoto()) }}" alt="#" class="product-img">
                                    </div>
                                    <div class="inputs-product-body">
                                        <div class="form-group type">
                                            <span class="addon-tag"><i class="fa fa-tag"></i></span>

                                            {!! Form::select('types', $product_type,$product->Type() , ['class' => 'input selectpicker' ,"placeholder" =>_i("Product Type"),'disabled' => 'disabled']) !!}
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group">
                                            <span class="addon-tag"><i class="ti-shopping-cart-full"></i></span>
                                            <input type="text" class="form-control product_name input"
                                                   value="{{ ($product->title != null) ? $product->title : "" }}"
                                                   name="product_name" placeholder="{{_i("Product Name")}}" disabled
                                            >
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <span class="addon-tag"><i class="ti-money"></i></span>
                                                <input type="number" min="1" max="1000000"
                                                       class="form-control price"
                                                       value="{{ $product->price }}" name="price"
                                                       placeholder="{{_i("Price")}}" disabled>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col">
                                                <span class="addon-tag"><i class="ti-tag"></i></span>
                                                <input type="number" min="1" max="1000000"
                                                       class="form-control product_count"
                                                       value="{{ $product->max_count }}" name="count"
                                                       placeholder="{{_i("Count")}}"
                                                       disabled>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="product_id" class="product_id"
                                                   value="{{$product->id}}">

                                            <button class="btn btn-block btn-tiffany resotre-product"
                                                    type="button">{{_i("Restore")}}</button>
                                        </div>


                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="col-12" id='no-items'>
                        <div class="alert alert-danger text-center">
                            <p class="lead">{{ _i('No Products') }}</p>
                        </div>
                    </div>

                @endif

            </div>


        </div>

    </div>

@endsection


@push('js')

    <script>
        $('.resotre-product').on('click', function () {
            var that = $(this);
            var id = that.closest('.frm_product').find('.product_id').val();
            var token = '{{ csrf_token() }}';
            if (id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('dataRecovery.restoreProduct') }}',
                    type: "POST",
                    data: {id: id, token: token},
                    dataType: 'json',

                    success: function (response) {
                        if (response.status == 'success') {
                            that.closest('.col-md-4').remove();
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: "{{_i('Restored Successfully')}}",
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    },
                });
            }
        })
    </script>

@endpush

