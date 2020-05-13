@extends('admin.AdminLayout.index')
@section('title')
    {{_i('Products Inventory')}}
@endsection

@section('page_header_name')
    {{_i('Products Inventory')}}
@endsection

@push('js')

    <script src="{{ asset('masterAdmin/assets/pages/foo-table/js/footable.min.js') }}"></script>
    <script src="{{ asset('masterAdmin/assets/pages/foo-table/js/foo-table-custom.js') }}"></script>

@endpush

@section('content')

    <div class="products-lists">

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{_i('Products Inventory')}}</h5>
                            <span>{{ count($products) }}</span>
                        </div>
                        <div class="card-block">
                            <table id="demo-foo-filtering"
                                   class="table table-striped footable footable-1 footable-paging footable-paging-center breakpoint-lg"
                                   style="">
                                <thead>
                                <tr class="footable-header">


                                    <th class="footable-sortable footable-first-visible" style="display: table-cell;">
                                        {{ _i('Product Name') }}<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable" style="display: table-cell;">
                                        {{ _i('SKU') }}<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable"
                                        style="display: table-cell;">{{ _i('Total Quantity') }}<span
                                            class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable"
                                        style="display: table-cell;">{{ _i('Purchased Quantity') }}<span
                                            class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable"
                                        style="display: table-cell;">{{ _i('Remaining Quantity') }}<span
                                            class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable"
                                        style="display: table-cell;">{{ _i('Price') }}<span
                                            class="fooicon fooicon-sort"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($products) > 0)
                                    @foreach($products as $product)

                                        <tr>


                                            <td class="footable-first-visible d-flex" style="display: table-cell;">
                                                <div class="media-left media-middle d-flex">
                                                    <a href="{{ route('allProducts') }}">
                                                        @if($product->mainPhoto() != null)
                                                            <img class="media-object img-circle comment-img"
                                                                 style="width: 55px;height: 55px"
                                                                 src="{{ asset($product->mainPhoto()) }}"
                                                                 alt="{{ ($product->product_details()->first() != null) ? $product->product_details()->first()->title : "" }}">
                                                        @else
                                                            <img class="media-object img-circle comment-img"
                                                                 style="width: 55px;height: 55px"
                                                                 src="{{ asset('images/articles/personal_NoImage.jpg') }}"
                                                                 alt="{{ ($product->product_details()->first() != null) ? $product->product_details()->first()->title : "" }}">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-left media-body-middle">
                                                    <div class="align-self-center">
                                                        <a href="{{ route('allProducts') }}">
                                                            {{ ($product->product_details()->first() != null) ? $product->product_details()->first()->title : "" }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">{{ ($product->sku != null) ? $product->sku : "" }}</td>
                                            <td style="display: table-cell;">{{ (((\App\Bll\Utility::purchased_quantity($product->id,$product->store_id) != null) ? \App\Bll\Utility::purchased_quantity($product->id,$product->store_id) : 0) + $product->max_count) }}</td>
                                            <td style="display: table-cell;">{{ (\App\Bll\Utility::purchased_quantity($product->id,$product->store_id) != null) ? \App\Bll\Utility::purchased_quantity($product->id,$product->store_id) : 0 }}</td>
                                            <td style="display: table-cell;">{{ $product->max_count }}</td>
                                            <td class="footable-last-visible" style="display: table-cell;"><span
                                                    class="tag tag-danger"> {{ $product->price }}</span>
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection

