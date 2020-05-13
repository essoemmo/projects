<div class="table-responsive">
    <table class="table table-bordered table-striped dataTable text-center" id="massegs_table">
        <thead class=" text-center">
        <tr>

            <th scope="col">{{_i('from')}}</th>
            <th scope="col">{{_i('message')}}</th>
            <th scope="col">{{_i('created_at')}}</th>
             <th>{{_i('Controll')}}</th>
        </tr>
        </thead>
<!--        <tbody>
        @foreach($messages as $massege)
        <tr>
            <td>{{$massege->user->username}}</td>
            <td>{{$massege->message}}</td>
            <td>{{$massege->created_at->diffForHumans()}}</td>
            <td>
<?php

                $action = \Illuminate\Support\Facades\DB::table('user_action')
//                    ->where('to_id',$massege->user->id)
                    ->Where('from_id',\Illuminate\Support\Facades\Auth::id())
                    ->first();

                $fav = \Illuminate\Support\Facades\DB::table('user_action')
//                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                    ->Where('to_id',$massege->user->id)
                    ->orWhere('status','pending')
                    ->first();

                ?>


                @if(!empty($fav) && $fav->action == 'like')

                    <a href="javascript:void(0)" class="add-to-fav add-{{$fav->id}}" data-id="{{$fav->id}}" data-to="{{$massege->user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart"></i></a>
                        @else
                    <a href="javascript:void(0)" class="add-to-fav add-{{$fav->id}}" data-id="{{$fav->id}}" data-to="{{$massege->user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a>
                         @endif

                    <a href="javascript:void(0)" class="btn-sm block-{{$fav->id}}" id="block" data-id="{{$fav->id}}" data-to="{{$massege->user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-times"></i></a>
                    <a href="javascript:void(0)" class="btn-sm" id="delete" data-id="{{$massege->id}}" data-favid="{{$fav->id}}"><i class="fa fa-ban"></i></a>

            </td>
        </tr>
            @endforeach
        </tbody>-->
    </table>
</div>

{{--<a href="" class="btn btn-grad ">حذف المحدد</a>--}}
{{--<nav aria-label="Page navigation example">--}}
{{--    <ul class="pagination justify-content-center">--}}
{{--        <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
{{--    </ul>--}}
{{--</nav>--}}

