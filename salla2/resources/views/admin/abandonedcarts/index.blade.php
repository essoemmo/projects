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
    <i class="sicon-shopping"></i>&nbsp; {{_i('Abandoned baskets')}} &nbsp;<span class="text-muted text-size-small">({{ count($items) }}  {{_i('Client')}})</span>
    </h6>
    </div>
    <div class="no-more-tables">
    <table class="table text-nowrap">
    <tbody>
        @foreach ($items as $index => $item)
        <tr class="table-row">
            <td class="customer-td">
                <div class="media-left media-middle">
                    @php
                        $user = \App\User::where('id' ,$item["user_id"])->first();
                      
                        
                        
                    @endphp
                    @if($user!=null)
                <a href="{{ route('aban-cart', $item["user_id"]) }}">
                    <img src="{{ $user->image != null ? asset('uploads/users/'. $user->id .'/'.$user->image) : asset('default_images/avatar_male.png')}}" class="img-circle" width="50" height="50" alt="">
                </a>
                    @endif
                </div>
                <div class="media-left media-body-middle">
                <div>
                <a href="{{ route('aban-cart', $item["user_id"]) }}">
                {{ $user->name }}
                </a>
                </div>
                </div>
            </td>
            <td class="td-cod text-right" data-title="{{_i('The date the basket was created')}}">
                <span class="text-muted">{{ $item['created_at'] }}</span>
            </td>
            <td class="td-cod text-right" data-title="{{_i('Number of products')}}">
                <span class="text-muted">
                </span>
            </td>
            <td class="td-cod text-right" data-title=" {{_i('Total basket')}} ">
                <span class="text-price">{{ $item['total'] }} {{_i('SR')}}</span>
            </td>
            <td class="td-cod text-right" data-title="{{_i('Status')}}">
                <span class="text-muted">
            </span>
            </td>
        </tr>
        @endforeach

    </tbody>
    </table>
    </div>

    </div>
    </div>
</div>

@endsection
