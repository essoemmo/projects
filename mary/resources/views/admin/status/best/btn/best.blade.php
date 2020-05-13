

<?php
$best = \App\Models\User_status::where('type','best')->where('user_id',$id)->first();
?>
@if(!$best)

    <form action="{{route('Bestmember.store')}}" method="post">
        {{method_field('post')}}
        {{csrf_field()}}
        <input type="hidden" name="User_id" value="{{$id}}">

        <button type="submit" class="btn btn-success ">{{_i('set best list')}}</button>
    </form>


@else

    <form action="{{route('Bestmember.update',$id)}}" method="post">
        {{method_field('put')}}
        {{csrf_field()}}
{{--        <input type="hidden" name="User_id" value="{{$id}}">--}}

        <button type="submit" class="btn btn-warning">{{_i('Remove from best list')}}</button>
    </form>


@endif
