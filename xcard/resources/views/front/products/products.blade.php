@extends('front.layout.index')

@section('content')

    @push('css')

        <style>
            .pagination a {
                margin: 0 !important;
                border: none !important;
                color: #ffffff;
                background: #F4941C;
            }
            .pagination li.active span {
                background: #282828 !important;
                border-color: #282828 !important;
            }
        </style>

    @endpush

    <section class="items-section-wrapper">
        <div class="container">
            <div class="section-title">
                {{_i('Categories')}}
            </div>

            <div class="row">
                <div class="col-md-9 order-1 order-md-0">
                    <div class="showing-results-and-sorting d-md-flex justify-content-md-between text-center mb-3">
                        <div class="sorting">
                            {{ _i('Sort By') }}
                            <select name="sort_by" class="form-control rounded-0 sortBy">
                                <option disabled selected>{{ _i('Select') }}</option>
                                <option value="DESC">{{ _i('Newest') }}</option>
                                <option value="ASC">{{ _i('Oldest') }}</option>
                                <option value="price_desc">{{ _i('Lowest Price') }}</option>
                            </select>
                        </div>
                        <div class="showing-results">
                            {{ _i('Number Of Results Found') }} :
                            <span> {{ count($products) }} {{ _i('Results') }}</span>
                        </div>
                    </div>

                    <div id="products">
                        @include('front.products.ajax.product_ajax')
                    </div>

                    <div class="justify-content-center d-md-flex">
                        <ul class="pagination" >
                            <li class="page-item quantity "  >
                                {{$products->links()}}
                            </li>
                        </ul>
                    </div>


                </div>
                <div class="col-md-3 order-0 order-md-1">
                    <div class="sidebar">
                        <div class="sidebar-box advances-search">
                            <div class="title">{{ _i('Advanced Search') }}</div>
                            <div class="box-wrapper">
                                @include('front.layout.advSearch')
                            </div>
                        </div>

                        <div class="sidebar-box">
                            <div class="title">{{_i('Coming Games')}}</div>

                            @include('front.layout.ComingProducts')

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('js')

    <script>
        $(function () {
            'use strict';
            $(".sortBy").on('change', function () {
                var sort = $(this).val();
                $.ajax({
                    url:'{{ url('products_sort') }}',
                    method:'GET',
                    DataType:'json',
                    data: {sort: sort},
                    success:function (res) {
                        $('#products').html(res);
                    }
                })
            })
        });
    </script>

@endpush
