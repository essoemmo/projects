@extends('web.layout.master')
@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Zawage Article')}}</li>
            </ol>
        </div>
    </nav>


    <section class="article-page  common-wrapper ">
        <div class="container">

            <div class=row>

            @foreach($article as $artic)



                       <div class="col-md-6">
                           <?php
                            $cat = \Illuminate\Support\Facades\DB::table('artcl_categories')
                               ->where('id',$artic->category_id)->where('lang_id',session('language'))
                               ->first();
                           ?>
                        @if($cat == null)
                                   <?php
                                   $cat = \Illuminate\Support\Facades\DB::table('artcl_categories')
                                       ->where('source_id',$artic->category_id)->where('lang_id',session('language'))
                                       ->first();
                                   ?>
                                   <h2 style="text-align: center">{{$cat->title}}</h2>
                                     @else
                                   <h2 style="text-align: center">{{$cat->title}}</h2>

                               @endif
                           <div class="image">
                               <img src="{{asset('uploads/articles/'.$artic->img_url)}}" width=500px;>
                           </div>


                        <div class="col-md-6">

                                <div class="content">
                                    {!!$artic->title!!}
                                    <div class="descrption">
                                        {!!$artic->content!!}
                                    </div>
                                    <span >{{date('d/m/Y', strtotime($artic->created))}}</span>
                                </div>

                        </div>




            @endforeach

            </div>
            {{$article->appends(request()->query())->links()}}
            </div>



    </section>
    <br>
    <br>


@endsection
