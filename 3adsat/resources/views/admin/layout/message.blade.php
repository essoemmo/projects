@if ($errors->all())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>

{{--                @if ($errors->has('link'))--}}
{{--                    <li>{{$errors->first('link')}}</li>--}}
{{--                @endif--}}
            @endforeach
        </ul>
    </div>
@endif