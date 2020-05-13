@extends('store.layout.master')

@section('content')

    @if (\Session::has('success'))
        <div class="text-center alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    @if (\Session::has('failure'))
        <div class="text-center alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
        </div><br/>
    @endif


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' , app()->getLocale()) }}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Cart')}} </li>
            </ol>
        </div>
    </nav>

    @if(\App\Bll\Utility::getTemplateCode() == "purple")
        <div class="products-wrapper ">
            <div class="container">

                <div class="row">

                    @if(count(Cart::content()) > 0)
                        <div class="col-lg-9 order-lg-0 order-1">
                            <div class="top-product-helper mb-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-self-center my-1">
                                        <div class="page-title">{{ _i('Cart') }}
                                            <span>( {{ count(Cart::content()) }}
                                                @if(count(Cart::content()) == 1)
                                                    {{ _i('Product') }}
                                                @else
                                                    {{ _i('Products') }}
                                                @endif
                                                    )</span>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-self-center my-1">
                                        <div class="ship-to">{{ _i('Delivered To') }}
                                            <select name="" id="" class="form-control d-inline-block w-auto">
                                                <option disabled selected>{{ _i('Select') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach($cart as $item)

                                @php

                                    if($item->options->currency == null) {
                                        $currency = \App\Bll\Constants::defaultCurrency;
                                    } else {
                                        $currency = $item->options->currency;
                                    }

                                @endphp

                                <div class="single-full-product wide-product mb-4 p-3 item">

                                    <div class="media">
                                        <div class="product-thumbnail">
                                            @if($item->options->image == null)
                                                <img src="http://placehold.it/100x100" alt="..." class="img-fluid"/>
                                            @else <img src="{{$item->options->image}}" alt="..."
                                                       class="img-fluid"/> @endif
                                        </div>

                                        <div class="media-body">
                                            <div class="d-md-flex justify-content-between align-items-center mb-2">
                                                <h2 class="title"><a
                                                        href="{{ route('product_url', [app()->getLocale() ,$item->id]) }}">{{ $item->name }}</a>
                                                </h2>
                                                <div class="price" id="price_{{ $item->rowId }}">{{ _i('Price') }}
                                                    : {{ $item->price }} {{ $currency }}</div>
                                                <div class="quantity" id="quantity_{{ $item->rowId }}">
                                                    <label>{{ _i('Quantity') }}</label>
                                                    <a class="updatecart" href="javascript:void(0)">
                                                        <input type="number" id="{{ $item->rowId }}"
                                                               max="{{ $item->options->max_count }}"
                                                               class="form-control d-inline-block w-auto qty"
                                                               min="1"
                                                               value="{{ $item->qty }}">
                                                    </a>
                                                </div>

                                            </div>
                                            <p>
                                                @if($item->description == null)
                                                    {{ _i('No Description') }}
                                                @else
                                                    {{ $item->description }}
                                                @endif
                                            </p>
                                            <div class="cart-product-options">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><a href=""><i
                                                                class="fa fa-heart-o"></i>
                                                            {{ _i('add to favourites') }}</a></li>
                                                    <li class="list-inline-item">
                                                        <form class="form-inline" method="POST"
                                                              action="{{ url(app()->getLocale().'/store/remove-form-cart/' . $item->rowId ) }}">
                                                            @csrf
                                                            <input type="hidden" name="id" class="delete_id"
                                                                   value="{{$item->rowId}}"/>
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-sm delete_button"
                                                                    data-id="{{ $item->rowId }}"><i
                                                                    class="fa fa-trash-o"></i> {{ _i('Delete') }}
                                                            </button>

                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <div class="col-lg-3 order-lg-1 order-0 mb-3">
                            <div class="cost-box single-full-product p-3 ">
                                <input type="text" name="discount_code" class="form-control discount_code"
                                       placeholder="{{ _i('Discount Code') }}">
                                <div class="single-cost-line d-flex justify-content-between align-items-center ">
                                    <p>{{ _i('Subtotal') }}</p>
                                    <div
                                        class="price"
                                        id="total">{{ Gloudemans\Shoppingcart\Facades\Cart::total() }} {{ $currency }}
                                    </div>
                                </div>
                                <div class="single-cost-line d-flex justify-content-between align-items-center ">
                                    <p>{{ _i('Shipping') }}</p>
                                    <div class="price">{{ _i('Free') }}</div>
                                </div>

                                <div class="total single-cost-line d-flex justify-content-between align-items-center ">
                                    <p>{{ _i('Overall Total') }}</p>
                                    <div
                                        class="price">{{ Gloudemans\Shoppingcart\Facades\Cart::total() }} {{ $currency }}
                                    </div>
                                </div>
                                <a href="" class="btn btn-mainColor rounded btn-block">{{_i('Complete the purchase')}}</a>
                            </div>
                            <a href="{{ route('store.home' , app()->getLocale()) }}"
                               class="btn btn-mainColor rounded btn-block">{{_i('Continue shopping')}}</a>

                        </div>


                    @else
                        <div class="col-lg-12">
                            <div class="alert alert-danger text-center" role="alert">
                                {{_i('No Products In Cart')}}
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    @else
        <div class="shopping-cart-wrapper common-wrapper">
            <div class="container">
                @if(count(Cart::content()) > 0)
                    <table id="cart-table" class="table table-hover table-striped table-light">
                        <thead>
                        <tr>
                            <th style="width:50%">{{_i('Product')}}</th>
                            <th style="width:10%">{{_i('Price')}}</th>
                            <th style="width:8%">{{_i('Quantity')}}</th>
                            <th style="width:22%" class="text-center">{{_i('Total')}}</th>
                            <th style="width:10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $item)
                            @php

                                if($item->options->currency == null) {
                                    $currency = \App\Bll\Constants::defaultCurrency;
                                } else {
                                    $currency = $item->options->currency;
                                }

                            @endphp
                            <tr class="item">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-2 d-none d-sm-flex align-items-center">
                                            @if($item->options->image == null)
                                                <img src="http://placehold.it/100x100" alt="..." class="img-fluid"/>
                                            @else <img src="{{$item->options->image}}" alt="..."
                                                       class="img-fluid"/> @endif
                                        </div>
                                        <div class="col-sm-10">
                                            <h4 class="nomargin">{{ $item->name }}</h4>
                                            <p>{{ $item->description }} </p>
                                            <?php

                                            $features = App\Models\product\features::where('product_id', $item->id)->get();

                                            ?>

                                            @if(count($features) > 0)
                                                <div class="feature">
                                                    @foreach($features as $feature)
                                                        <div class="row form-group">
                                                            <label class="col-sm-4"
                                                                   for="feature_option">{{ $feature->data->title }}</label>
                                                            <div class="col-sm-8 parent">
                                                                <select class="float-none feature_option"
                                                                        name="{{ $item->rowId }}[]">
                                                                    <option selected data-price="0">
                                                                        -- {{ _i('Choose') }}
                                                                        --
                                                                    </option>
                                                                    @foreach($feature->options as $option)
                                                                        <option value="{{ $option->id }}"
                                                                                @if(collect($item->options->features)->count() > 0)
                                                                                @foreach($item->options->features as $index => $item_feature_option)
                                                                                @if($index == $feature->id)
                                                                                @if($item_feature_option == $option->id)
                                                                                selected
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                                @endif
                                                                                id="{{ $feature->id }}"
                                                                                data-price="{{ $option->price }}">
                                                                            {{ $option->data->title }}
                                                                            ({{ $option->price }} {{ $currency }}
                                                                            )
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" class="product_price"
                                                                       value="{{ checkDiscountPrice($item->id) }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price" class="price"
                                    id="price_{{ $item->rowId }}">{{ $item->price }} {{ $currency }}
                                </td>
                                <td data-th="Quantity" class="quantity" id="quantity_{{ $item->rowId }}">
                                    <a class="updatecart" href="javascript:void(0)">
                                        <input type="number" id="{{ $item->rowId }}" min="1"
                                               max="{{ $item->options->max_count }}"
                                               class="form-control text-center qty" value="{{ $item->qty }}">
                                    </a>
                                </td>
                                <td data-th="Subtotal"
                                    class="subtotal text-center">{{ $item->subtotal }} {{ $currency }}</td>
                                <td class="actions" data-th="">
                                    <form class="form-inline" method="POST"
                                          action="{{ url(app()->getLocale().'/store/remove-form-cart/' . $item->rowId ) }}">
                                        @csrf
                                        <input type="hidden" name="id" class="delete_id" value="{{$item->rowId}}"/>
                                        <button type="submit" class="btn btn-danger btn-sm delete_button"
                                                data-id="{{ $item->rowId }}"><i class="fa fa-trash-o"></i></button>

                                    </form>
                                </td>
                            </tr>
                            <div style="display: none"> {{ $count++ }}</div>
                        @endforeach


                        </tbody>
                        <tfoot>
                        <tr class="d-block d-sm-none">
                            <td class="text-center">
                                <strong>{{ Gloudemans\Shoppingcart\Facades\Cart::total() }} {{ $currency }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('store.home' , app()->getLocale()) }}" class="btn btn-warning"><i
                                        class="fa fa-angle-right"></i>
                                    {{_i('Continue shopping')}}</a></td>
                            <td colspan="2" class="d-none d-sm-table-cell"></td>
                            <td class="d-none d-sm-block text-center"><strong id="total">{{_i('Total')}}
                                    {{ Cart::total() }} {{ $currency }}</strong></td>
                            <td><a href="{{ route('store.checkout' , app()->getLocale()) }}"
                                   class="btn btn-success btn-block">{{_i('End the process')}} <i
                                        class="fa fa-angle-left"></i></a></td>
                        </tr>
                        </tfoot>
                    </table>
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-danger text-center" role="alert">
                            {{_i('No Products In Cart')}}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    @endif

    @php

        $currency = \App\Bll\Constants::defaultCurrency;

    @endphp

@endsection

@push('js')
    <script>
        $(".qty").on('change', function () {
            var qty = $(this).val();
            var rowId = $(this).attr('id');
            if (this) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url(app()->getLocale().'/store/update-cart')}}',
                    type: 'post',
                    data: {
                        qty: qty,
                        rowId: rowId
                    },
                    success: function (res) {
                        var subtotal = res[0].price * parseInt(res[0].qty);
                        $('#quantity_' + rowId).next().text(subtotal + ' ' + '{{ $currency }}');
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "{{ _i('Updated Successfully') }}",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#total').text('Total ' + res[1] + ' ' + '{{ $currency }}');
                    }
                });
            }
        });

        $(function () {
            var fields = $('.feature :input').change(calculate);

            function calculate() {
                var option_check = $(this).children("option:selected").val();
                var feature_check = $(this).children("option:selected").attr('id');
                var $this = $(this);
                var result = 0;
                var product_price = parseInt($(this).parent().find('.product_price').val());
                var rowId = $(this).closest('.item').find('.qty').attr('id');
                var qty = $(this).closest('.item').find('.qty').val();
                var price = 0;
                var formData = {};
                $('select[name="' + rowId + '[]"]').each(function () {
                    var feature_id = $(this).children("option:selected").attr('id');
                    price += +$(this).children('option:selected').data('price');
                    if (feature_id != undefined) {
                        var option_id = $(this).children("option:selected").val();
                        formData[feature_id] = option_id;
                    } else {
                        formData[null] = null;
                    }

                });
                $.ajax({
                    url: '{{ route('checkFeaturesOption' , app()->getLocale()) }}',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        option_id: option_check,
                        feature_id: feature_check
                    },
                    success: function (res) {
                        if (res == false) {
                            Swal.fire({
                                position: 'top-end',
                                type: 'error',
                                title: "{{ _i('Out Of Stock For This Option') }}",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            result = price + product_price;
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '{{url(app()->getLocale().'/store/update-cart-features')}}',
                                type: 'post',
                                data: {
                                    qty: qty,
                                    rowId: rowId,
                                    result: result,
                                    formData: formData
                                },
                                success: function (res) {
                                    $this.closest('.item').find('#' + rowId).attr('id', res[0].rowId);
                                    $this.closest('.item').find('.feature_option').attr('name', res[0].rowId + '[]');
                                    $this.closest('.item').find('.form-inline').attr(
                                        'action', '{{ url(app()->getLocale().'/store/remove-form-cart/') }}/' + res[0].rowId);
                                    $this.closest('.item').find('.delete_id').val(res[0]
                                        .rowId);
                                    $this.closest('.item').find('.delete_button').attr(
                                        'data-id', res[0].rowId);
                                    $this.closest('.item').find('.price').attr('id',
                                        'price_' + res[0].rowId);
                                    $this.closest('.item').find('.quantity').attr('id',
                                        'quantity_' + res[0].rowId);
                                    var subtotal = res[0].price * parseInt(res[0].qty);
                                    $('#quantity_' + res[0].rowId).next().text(subtotal + ' ' + '{{ $currency }}');
                                    $('#price_' + res[0].rowId).text(result + ' ' + '{{ $currency }}');
                                    Swal.fire({
                                        position: 'top-end',
                                        type: 'success',
                                        title: "{{ _i('Updated Successfully') }}",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    $('#total').text('Total ' + res[1] + ' ' + '{{ $currency }}');
                                }
                            });

                        }
                    }
                });
            }
        });
        $(function () {
            var fields = $('.feature :input').change(calculate);

            function calculate() {
                var price = 0;
                var result = 0;
                var result_discount = 0;
                var product_price = parseInt($('#product_price').val());
                var product_price_discount = Number($('#product_price_discount').val());
                fields.each(function () {
                    price += +$(this).children('option:selected').data('price');
                });
                result = price + product_price;
                result_discount = price + product_price_discount;
                $('#price').text(result);
                $('#price_discount').text(result_discount);
                $('#new_price').val(result);
            }
        });

    </script>
@endpush
