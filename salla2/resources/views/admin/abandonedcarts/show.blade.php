{{--@extends('admin.layout.productLayout')--}}
@extends('admin.AdminLayout.index')
@section('title')
    {{_i('abandoned carts')}}
@endsection

@section('page_header_name')
    {{_i('abandoned carts')}}
@endsection
@section('content')


    <div class="row customers-row">
        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">
                        <i class="sicon-shopping"></i>&nbsp;
                        {{ _i('abandoned-carts') }} &nbsp;
                        <span class="text-muted text-size-small">
                            ({{ count($user_items) }} {{ _i('items') }})
                        </span>
                    </h6>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title title-thin">{{ _i('client') }}</h6>

                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">

                                <img
                                    src="{{ $user_items[0]->image != null ? asset('uploads/users/'. $user_items[0]->id .'/'.$user_items[0]->image) : asset('default_images/avatar_male.png') }}"
                                    width="50px;" class="img-circle img-lg" alt="">

                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">{{ $user_items[0]->name }}</h6>
                                <a href="tel:+20##########"
                                   style="direction: ltr; display: inline-block; text-align: right;">{{ $user_items[0]->phone }}
                                    <span
                                        style="direction: rtl; display: inline-block; background: #5CD5C4; margin-left: 5px; color: #fff; padding: 2px 9px; border-radius: 99px; font-size: 12px;">
        <i class="sicon-phone" style="vertical-align: text-bottom; font-size: 13px;"></i> {{ _i('call') }}
        </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="panel panel-white mt-3">
                <div class="panel-heading d-flex justify-content-between">
                    <h6 class="panel-title"><i class="sicon-t-shirt"></i>&nbsp; {{ _i('products') }}
                        <span class="text-muted text-size-small">{{ (count($user_items)._i('product')) }}</span>
                    </h6>

                    <button type="button"
                            class="btn btn-primary class"
                            onclick="changePrice()">{{ _i('Activate a temporary discount') }}</button>
                </div>
                <div class="no-more-tables">
                    <table class="table">
                        <thead>
                        <tr class="active hidden-xs">
                            <th>{{ _i('the-product') }} </th>
                            <th class="text-right"> {{ _i('qty') }} </th>
                            <th class="text-right"> {{ _i('price') }}</th>
                            <th class="text-right"> {{ _i('total') }}</th>
                        </tr>
                        </thead>
                        <tbody style="border-top: none !important;">
                        @foreach ($user_items as $item)

                            <tr class="table-row">
                                <td class="customer-td">
                                    <div class="media-left">
                                        <img src="{{ asset($item->photo) ?? asset('/images/placeholder.png') }}"
                                             style="width:50px;" class="img-circle img-lg" alt="">
                                    </div>
                                    <div class="media-left">
                                        <h6>
                                            <a href="{{ asset($item->photo) ?? asset('/images/placeholder.png') }}"
                                               class="text-semibold"> {{ $item->title }}</a>
                                        </h6>
                                        <div class="text-muted text-size-small">
                                        </div>
                                        <div class="text-muted text-size-small">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right td-cod">
                                    <span
                                        id="quantity_container_xo2eKgr6OXELMDobBeyWPVNRdjmYpZ47"> {{ $item->qty }} </span>
                                </td>

                                <td class="text-right td-cod">
                                    <a class="product_price" data-type="text" data-title="{{ _i('Enter New Price') }}"
                                       id="total_price" data-pk="{{ $item->id }}"
                                       data-url="{{ route('update_price') }}">
                                        {{ $item->total_price }}
                                    </a>
                                    <span class="old_price_{{ $item->id }}"
                                          style="display: none; text-decoration: line-through; color: #333">
                                        {{ $item->total_price }}
                                    </span>
                                </td>
                                <td class="text-right td-cod">
                                    <h6 class="text-semibold">
        <span class="total_price_qty_{{ $item->id }} total_price_qty">
        {{ $item->total_price_qty }}
        </span>
                                        {{ App\Bll\Constants::defaultCurrency}}
                                    </h6>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="active table-row">
                            <td class="hidden-xs"> {{ _i('total-cart') }}</td>
                            <td colspan="3" class="text-right td-cod" data-title="{{ _i('total-cart') }}">
                                <h6 class="text-semibold">
        <span id="cart_total_container">
        {{ $user_items->total }}
        </span>
                                    {{ App\Bll\Constants::defaultCurrency}}
                                </h6>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection


@push('js')



    <script>
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=token]").attr("content");
            return params;
        };

        function changePrice() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            var currency = '{{ App\Bll\Constants::defaultCurrency}}';
            $('.product_price').editable({
                success: function (response, newValue) {
                    $('.old_price_' + response.cart.id).css('display', 'inline-block');
                    $('.total_price_qty_' + response.cart.id).text(parseInt(response.cart.total_price) * parseInt(response.cart.qty));
                    var sum = 0;
                    $('.total_price_qty').each(function () {
                        sum += Number($(this).text());
                    });
                    $('#cart_total_container').text(sum);
                }
            })
            ;
        }
    </script>

@endpush
