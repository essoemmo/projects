@extends('front.layout.master')
@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(LaravelGettext::getLocale(),'')}}">{{_i('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{_i('prices') }}</li>
        </ol>
    </div>
</nav>
<section class="contact-page common-wrapper">
    <div class="prices-page common-wrapper">
        <div class="container">
            <div class="p-table-wrap">

                <div class="p-table-main">
                    <div class="p-table p-table-b">
                        <div class="p-cell p-bold">{{ _i('Monthly packages') }}</div>
                        @foreach ($memberships as $item)
                        <div class="p-cell p-package basic">

                            <span>{{$item->title}}</span>
                            <span class="small">{{$item->description}}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-table bg-color">
                        <div class="p-cell"> {{ _i('Monthly Subscription') }} </div>
                        @foreach ($memberships as $item)
                        <div class="p-cell p-price p-package team">{{($item->price) }} {{($item->currency_code) }}
                            <b>/ {{_i("Month")}}</b></div>
                        @endforeach
                    </div>
                </div>

                <?php 
                $i=-1;
                ?>
                @foreach ($categorydata as $category)

                <div class="p-header">{{  _i($category->title) }}</div>
                @foreach ($optiondata as $option)

                <?php $i++; ?>
                <div class="p-table <?=($i%2==0)? 'bg-color' : ''?>">
                    @if($category->category_id == $option->category_id)
                    <div class="p-cell">{{ ($option->title) }}</div>
                    @foreach ($memberships as $membership)
                    <?php
                    $m = $membership->id;
                   $o = $option->option_id;
                    $filter = $membership_options->filter(function ($item, $k) use ($m, $o) {
                        
                      
                        if ($item->membership_id == $m && $item->option_id == $o)
                            return true;
                        return false;
                    });
                    ?>
                    @if(count($filter)>0)

                    <div class="p-cell"><i class="fa fa-check-circle"></i></div>
                    @else
                    <div class="p-cell"><i class="fa fa-times-circle"></i></div>
                    @endif

                    @endforeach
                </div>
                @endif

                @endforeach
                @endforeach


                <div class="p-table  <?=(($i+1)%2==0)? 'bg-color' : ''?>">
                    <div class="p-cell"></div>

                    @foreach ($memberships as $item)     
                    <div class="p-cell">
                        <form action="{{route('addmem',LaravelGettext::getLocale())}}" method="POST" style="display:inline-block">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <input type="hidden" name="member_id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-pink shadow">{{_i('Join us')}}</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
