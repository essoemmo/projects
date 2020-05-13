

<?php
$best = \App\Models\User_status::where('type','active')->where('user_id',$id)->first();
?>
@if(!$best)

    <form action="{{route('Activemember.store')}}" method="post">
        {{method_field('post')}}
        {{csrf_field()}}
        <input type="hidden" name="User_id" value="{{$id}}">

        <button type="submit" class="btn btn-success ">{{_i('set active list')}}</button>
    </form>


@else

    <form action="{{route('Activemember.update',$id)}}" method="post">
        {{method_field('put')}}
        {{csrf_field()}}
{{--        <input type="hidden" name="User_id" value="{{$id}}">--}}

        <button type="submit" class="btn btn-warning">{{_i('Remove from active list')}}</button>
    </form>


@endif
