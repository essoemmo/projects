<div class="fields-wrapper bg-light-pink  py-4">

    <div class="container">

        <form action="{{route('favourite-post')}}" method="post" id="favform">
            {{csrf_field()}}
            {{method_field('post')}}
        @php

            $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
        @endphp
        {{--                                {{dd(session('language'))}}--}}
        @foreach($group as $gro)

            <label for="" class="col-sm-2 col-form-label" style="    margin-bottom: 23px;
    font-size: 20px;
    background: #e0d5d5;">{{_i($gro->title)}}</label>
            <br>
            @if($gro->source_id == null)
                @foreach(\App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get() as $option)
                    {{--                                            @foreach($new as $option)--}}

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">{{_i($option->title)}}</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)
                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                @endforeach

            @else

                @foreach(\App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get() as $option)

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">{{_i($option->title)}}</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                @if($option->source_id == null)

                                    @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)
                                        <option value="{{$val->id}}">{{$val->title}}</option>
                                    @endforeach

                                @else

                                    @foreach(\App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get() as $val)
                                        <option value="{{$val->id}}">{{$val->title}}</option>
                                    @endforeach

                                @endif
                            </select>
                        </div>
                    </div>
                @endforeach


            @endif
        @endforeach
            <button type="submit" class="btn btn-warning" style="" id="saveform">{{_i('save')}}</button>

        </form>
    </div>


{{--    <div class="container">--}}

{{--        <form action="{{route('favourite-post')}}" method="post" id="favform">--}}
{{--            {{csrf_field()}}--}}
{{--            {{method_field('post')}}--}}

{{--        @php--}}

{{--            $group = \App\Models\Option_group::where('lang_id',session('language'))->get();--}}
{{--        @endphp--}}
{{--        --}}{{--                                {{dd(session('language'))}}--}}
{{--        @foreach($group as $gro)--}}

{{--            <div class="account_setting">--}}
{{--                <p>{{_i($gro->title)}}</p>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                @if($gro->source_id == null)--}}
{{--                    @foreach(\App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get() as $option)--}}
{{--                        --}}{{--                                            @foreach($new as $option)--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label>{{_i($option->title)}}</label>--}}
{{--                            <select class="form-control select2" style="width: 100%;" name="option_value[]">--}}
{{--                                @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                    <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                @else--}}

{{--                    @foreach(\App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get() as $option)--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label>{{_i($option->title)}}</label>--}}
{{--                            <select class="form-control select2" style="width: 100%;" name="option_value[]">--}}
{{--                                @if($option->source_id == null)--}}

{{--                                    @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                        <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                    @endforeach--}}

{{--                                @else--}}

{{--                                    @foreach(\App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                        <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                    @endforeach--}}

{{--                                @endif--}}

{{--                            </select>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}


{{--                @endif--}}

{{--            </div>--}}

{{--        @endforeach--}}
{{--            <br>--}}
{{--    <button type="submit" class="btn btn-warning" style="" id="saveform">{{_i('save')}}</button>--}}
{{--        </form>--}}
{{--    </div>--}}
</div>
