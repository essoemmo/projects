<?php $user = \App\Models\User::FindOrFail($id); ?>

@if(auth()->user()->can('active-member'))
    @if($user->userlog == 1)
        <form action="{{route('active-user')}}" method="post">
            {{csrf_field()}}
            {{method_field('put')}}
            <input type="hidden" name="userid" value="{{$id}}">
            <input type="hidden" name="userlog" value="0">
            <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-lock-open"></i></button>
        </form>

    @else

        <form action="{{route('active-user')}}" method="post">
            {{csrf_field()}}
            {{method_field('put')}}
            <input type="hidden" name="userid" value="{{$id}}">
            <input type="hidden" name="userlog" value="1">
            <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-lock"></i></button>
        </form>


    @endif
    @else
    <button type="submit" class="btn btn-default btn-sm disabled"><i class="fas fa-lock"></i></button>

@endif
