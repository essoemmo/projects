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

    @push('css')
        <style>
            .number-input input[type="number"] {
                -webkit-appearance: textfield;
                -moz-appearance: textfield;
                appearance: textfield;
            }

            .number-input input[type=number]::-webkit-inner-spin-button,
            .number-input input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
            }

            .number-input button {
                -webkit-appearance: none;
                background-color: transparent;
                border: none;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                margin: 0;
                position: relative;
            }

            .number-input button:before,
            .number-input button:after {
                display: inline-block;
                position: absolute;
                content: '';
                height: 2px;
                transform: translate(-50%, -50%);
            }

            .number-input button.plus:after {
                transform: translate(-50%, -50%) rotate(90deg);
            }

            .number-input input[type=number] {
                text-align: center;
            }

            .number-input.number-input {
                border: 1px solid #ced4da;
                width: 10rem;
                border-radius: .25rem;
            }

            .number-input.number-input button {
                width: 2.6rem;
                height: .7rem;
            }

            .number-input.number-input button.minus {
                padding-left: 22px;
            }

            .number-input.number-input button.plus {
                padding-left: 28px;
            }

            .number-input.number-input button:before,
            .number-input.number-input button:after {
                width: .7rem;
                background-color: #495057;
            }

            .number-input.number-input input[type=number] {
                max-width: 4rem;
                padding: .5rem;
                border: 1px solid #ced4da;
                border-width: 0 1px;
                font-size: 1rem;
                height: 2rem;
                color: #495057;
            }

            @media not all and (min-resolution: .001dpcm) {
                @supports (-webkit-appearance: none) and (stroke-color:transparent) {

                    .number-input.def-number-input.safari_only button:before,
                    .number-input.def-number-input.safari_only button:after {
                        margin-top: -.3rem;
                    }
                }
            }

        </style>
    @endpush


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home', app()->getLocale()) }}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Cart')}} </li>
            </ol>
        </div>
    </nav>


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
                                        @else <img src="{{$item->options->image}}" alt="..." class="img-fluid"/> @endif
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
                                                                <option selected data-price="0"> -- {{ _i('Choose') }}
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
                        <td><a href="{{ route('store.home',app()->getLocale()) }}" class="btn btn-warning"><i class="fa fa-angle-right"></i>
                                {{_i('Continue shopping')}}</a></td>
                        <td colspan="2" class="d-none d-sm-table-cell"></td>
                        <td class="d-none d-sm-block text-center"><strong id="total">{{_i('Total')}}
                                {{ Cart::total() }} {{ $currency }}</strong></td>
                        @if(auth()->check())
                            <td><a href="{{ route('store.checkout' , app()->getLocale()) }}"
                                   class="btn btn-success btn-block">{{_i('End the process')}} <i
                                        class="fa fa-angle-left"></i></a></td>
                        @else
                            <td><a data-toggle="modal" data-target="#loginModel"
                                   class="btn btn-success btn-block">{{_i('End the process')}} <i
                                        class="fa fa-angle-left"></i></a></td>
                        @endif
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