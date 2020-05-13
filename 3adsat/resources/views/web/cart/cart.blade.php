@extends('web.layout.master')

@section('content')
{{--    @dd(\Cart::getContent())--}}
    @if (\Session::has('success'))
        <div class="text-center alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    @if (\Session::has('failure'))
        <div class="text-center alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
        </div><br />
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

            @media not all and (min-resolution:.001dpcm) {
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
                <li class="breadcrumb-item"><a href="#"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Cart')}} </li>
            </ol>
        </div>
    </nav>


    <div class="shopping-cart-wrapper common-wrapper">
        <div class="container">
            @if(count(\Cart::getContent()) > 0)
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
                    @foreach($carts as $item)
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 d-none d-sm-flex align-items-center">@if($item->attributes->image == null)<img src="http://placehold.it/100x100" alt="..." class="img-fluid"/>@else <img src="{{ asset('images/products/' .$item->attributes->image) }}" alt="..." class="img-fluid"/> @endif</div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin">{{ $item->name }}</h4>
                                        <p>{{ $item->description }} </p>
                                        @if($item->attributes->type == 'glasses')
                                            <div class="row form-group">
                                                @if($item->attributes->left_size != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_size != null)
                                                            <p>{{ _i('right size') }}  : {{ $item->attributes->right_size }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_size != null)
                                                            <p>{{ _i('left size') }} : {{ $item->attributes->left_size }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_size != null)
                                                            <p>{{ _i('size') }}  : {{ $item->attributes->right_size }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($item->attributes->left_cylinder != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_cylinder != null)
                                                            <p>{{ _i('right cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_cylinder != null)
                                                            <p>{{ _i('left cylinder') }} : {{ $item->attributes->left_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_cylinder != null)
                                                            <p>{{ _i('cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($item->attributes->left_axis != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_axis)
                                                            <p>{{ _i('right axis') }} : {{ $item->attributes->right_axis }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_axis)
                                                            <p>{{ _i('left axis') }} : {{ $item->attributes->left_axis }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_axis)
                                                            <p>{{ _i('axis') }} : {{ $item->attributes->right_axis }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    @if($item->attributes->lense_type)
                                                        <p>{{ _i('Lense Type') }} : {{ $item->attributes->lense_type }} </p>
                                                    @endif
                                                </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->pd)
                                                            <p>{{ _i('PD Value') }} : {{ $item->attributes->pd }} </p>
                                                        @endif
                                                    </div>
                                            </div>
                                        @endif
                                        @if($item->attributes->type == 'lenses')
                                            <div class="row form-group">
                                                @if($item->attributes->left_size != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_size != null)
                                                            <p>{{ _i('right size') }}  : {{ $item->attributes->right_size }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_size != null)
                                                            <p>{{ _i('left size') }} : {{ $item->attributes->left_size }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_size != null)
                                                            <p>{{ _i('size') }}  : {{ $item->attributes->right_size }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($item->attributes->left_cylinder != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_cylinder != null)
                                                            <p>{{ _i('right cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_cylinder != null)
                                                            <p>{{ _i('left cylinder') }} : {{ $item->attributes->left_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_cylinder != null)
                                                            <p>{{ _i('cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($item->attributes->left_axis != null)
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_axis)
                                                            <p>{{ _i('right axis') }} : {{ $item->attributes->right_axis }} </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($item->attributes->left_axis)
                                                            <p>{{ _i('left axis') }} : {{ $item->attributes->left_axis }} </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        @if($item->attributes->right_axis)
                                                            <p>{{ _i('axis') }} : {{ $item->attributes->right_axis }} </p>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    @if($item->attributes->color)
                                                        <p style="display: inline-block">{{ _i('color') }} : {{ $item->attributes->color_name }}</p>
                                                        <i class="fa fa-1x fa-circle" style="color: {{ $item->attributes->color->color }};display: inline-block"></i>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if($item->attributes->auto_reorder)
                                                        <p>{{ _i('auto reorder') }} : {{ $item->attributes->auto_reorder }} </p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if($item->attributes->package)
                                                        <p>{{ _i('Pack of') }} : {{ $item->attributes->package }} </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
<!--                            --><?php //$currency = \App\Models\Settings\Currency::where('lang_id','=',getLang(session('lang')))->where('show','=',1)->value('title'); ?>
{{--                            @dd($item->quantity)--}}
                            <td data-th="Price" id="price">{{ $item->price }} {{ $item->attributes->currency }}</td>
                            <td data-th="Quantity" id="quantity_{{ $item->id }}">
                                <a class="updatecart"  href="javascript:void(0)">
                                    <input type="number" min="1" max="{{ $item->attributes->max_count }}" id="{{ $item->id }}" class="form-control text-center qty" value="{{ $item->quantity }}">
                                    <input type="hidden" id="{{ $item->attributes->max_count }}" class="form-control text-center max_count" value="{{ $item->attributes->max_count }}">
                                </a>
                            </td>
                            <td data-th="Subtotal"  class="subtotal text-center">{{ $item->getPriceSum() }} {{ $item->attributes->currency }}</td>
                            <td class="actions" data-th="">
                                <form class="form-inline" method="POST" action="{{ url('remove-form-cart/' . $item->id ) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}"/>
                                    <button type="submit" class="btn btn-danger btn-sm" data-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div style="display: none"> {{ $count++ }}</div>
                    @endforeach


                    </tbody>
                    <tfoot>
                    <tr class="d-block d-sm-none">
                        <td class="text-center"><strong>{{ \Cart::getTotal() }} {{ $item->attributes->currency }}</strong></td>
                    </tr>
                    <tr>
                        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-right"></i> {{_i('Continue shopping')}}</a></td>
                        <td colspan="2" class="d-none d-sm-table-cell"></td>
                        <td class="d-none d-sm-block text-center"><strong id="total">{{_i('Total')}} {{ \Cart::getTotal() }} {{ $item->attributes->currency }}</strong></td>
                        <td><a href="{{ url('checkout') }}" class="btn btn-success btn-block">{{_i('End the process')}} <i class="fa fa-angle-left"></i></a></td>
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

@endsection
