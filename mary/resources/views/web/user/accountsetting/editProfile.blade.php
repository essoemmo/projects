<?php

$membership = \Illuminate\Support\Facades\DB::table('user_membership')
    ->where('user_id',$user->id)
    ->value('membership_id');

$department = \Illuminate\Support\Facades\DB::table('user_category')
    ->where('user_id',$user->id)
    ->value('category_id');

$optionValue = \Illuminate\Support\Facades\DB::table('user_options')
    ->where('user_id',$user->id)
    ->pluck('option_value_id')->toArray();

?>
<form method="post" action="{{route('users-update',$user->id)}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('put')}}
        <div class="fields-wrapper  py-4">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 ">

                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">{{_i('member ship')}}</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" name="memberShip">
                                    <option value="">{{_i('All member ship')}}</option>
                                    @foreach(\App\Models\Membership::get() as $member)
                                        <option value="{{$member->id}}" {{$membership == $member->id ? 'selected' :'' }}>{{$member->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">{{_i('user name')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="username" value="{{$user->username }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">{{_i('password')}}</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control " id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">{{_i('password_confirmation')}}</label>
                            <div class="col-sm-9">
                                <input type="password"  name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">{{_i('email')}}</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control " name="email" id="email" value="{{$user->email}}">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 align-content-md-stretch d-flex ">
                        <div class="notice-box ">
                            <p>{{_i('date register')}}
                                {{$user->created_at->diffForHumans()}}</p>
                            <div class="notice-title"><a href="#" id="editPassword" data-id="{{$user->id}}">{{_i('edit password')}}</a></div>
                            <div class="notice-title"><a href="#" id="editemail" data-id="{{$user->id}}">{{_i('edit email')}}</a></div>
                            <div class="notice-title"><a href="" id="deleteMember" data-id="{{$user->id}}">{{_i('delete member')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fields-wrapper bg-light-pink  py-4">
            <div class="container">

                <div class="form-group row">
                    <label for="country" class="col-sm-2 col-form-label">{{_i('country')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control country" name="country" style="width: 100%;">
                            @php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); @endphp
                            @foreach ($nationName as $namenat)
                                <option value="{{$namenat->id}}" {{$user->resident_country_id == $namenat->id ? 'selected' : ''}}>{{$namenat->county_name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">{{_i('city')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control city" id="city" name="city" data-id="{{$user->city_id}}" style="width: 100%;">
{{--                            <option value="0">0</option>--}}

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Address" class="col-sm-2 col-form-label">{{_i('Address')}}</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="address" class="form-control">
                            {!! $user->address !!}
                        </textarea>
                    </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="fields-wrapper  py-4">
            <div class="container">


                <div class="form-group row">
                    <label for="nationality" class="col-sm-2 col-form-label">{{_i('nationalty')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                            @php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); @endphp
                            @foreach ($nationName as $namenat)
                                <option value="{{$namenat->nationalty_id}}" {{$user->nationalty_id == $namenat->nationalty_id ? 'selected':''}}>{{$namenat->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">{{_i('material_status')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control status" style="width: 100%;" name="material_status_id">

                            @if($user->gender == 'male')
                                @foreach(\App\Models\Material_status::where('gender','male')->get() as $matiral)
                                    <option value="{{$matiral->id}}" {{$user->material_status_id == $matiral->id ? 'selected': ''}} >{{$matiral->name}}</option>
                                @endforeach

                            @else
                                @foreach(\App\Models\Material_status::where('gender','female')->get() as $matiral)
                                    <option value="{{$matiral->id}}" {{$user->material_status_id == $matiral->id ? 'selected': ''}} >{{$matiral->name}}</option>
                                @endforeach
                            @endif

                        </select>                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">{{_i('age')}}</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control " id="" name="age" value="{{$user->age}}">
                    </div>
                </div>

            </div>
        </div>

    <div class="fields-wrapper  py-4">

        <div class="container">
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
                                        <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
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
                                            <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
                                        @endforeach

                                    @else

                                        @foreach(\App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get() as $val)
                                            <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
                                        @endforeach

                                    @endif
                                </select>
                            </div>
                        </div>
                    @endforeach


                @endif





            @endforeach


        </div>
{{--        <div class="container">--}}
{{--            @php--}}

{{--                $group = \App\Models\Option_group::where('lang_id',session('language'))->get();--}}
{{--            @endphp--}}
{{--            --}}{{--                                {{dd(session('language'))}}--}}
{{--            @foreach($group as $gro)--}}

{{--                <div class="account_setting">--}}
{{--                    <p>{{_i($gro->title)}}</p>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    @if($gro->source_id == null)--}}
{{--                        @foreach(\App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get() as $option)--}}
{{--                            --}}{{--                                            @foreach($new as $option)--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label>{{_i($option->title)}}</label>--}}
{{--                                <select class="form-control select2" style="width: 100%;" name="option_value[]">--}}
{{--                                    @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                        <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                    @else--}}

{{--                        @foreach(\App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get() as $option)--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label>{{_i($option->title)}}</label>--}}
{{--                                <select class="form-control select2" style="width: 100%;" name="option_value[]">--}}
{{--                                    @if($option->source_id == null)--}}

{{--                                        @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                            <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                        @endforeach--}}

{{--                                    @else--}}

{{--                                        @foreach(\App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get() as $val)--}}
{{--                                            <option value="{{$val->id}}">{{$val->title}}</option>--}}
{{--                                        @endforeach--}}

{{--                                    @endif--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}


{{--                    @endif--}}

{{--                </div>--}}



{{--            @endforeach--}}


{{--        </div>--}}
    </div>



        <div class="fields-wrapper bg-light-pink  py-4">
            <div class="container">
             <p>{{_i('About the partener')}}</p>
                <textarea type="text" rows="10" name="partener" class="form-control">{!! $user->partener_info !!}</textarea>
                <p class="text-muted text-left my-2 small">{{_i('(Please write in a serious manner and it is forbidden to write email or mobile number in this place)')}}</p>
            </div>
        </div>

        <div class="fields-wrapper   py-4">
            <div class="container">

                <p>{{_i('about_me')}}</p>
                <textarea type="text" name="about_me" class="form-control" rows="10">{!! $user->about_me !!}</textarea>
                <p class="text-muted text-left my-2 small">{{_i('(Please write in a serious manner and it is forbidden to write email or mobile number in this place)')}}</p>
            </div>
        </div>

        <div class="fields-wrapper  py-4">
            <div class="container">

                <div class="pink-box text-center">
                    <h4>{{_i('Very confidential information')}}</h4>
                    <p>{{_i('Full name and mobile number: Management information that will never appear to anyone')}} .</p>
                    <p>{{_i('Writing this information correctly is a confirmation of your seriousness in marriage')}}.</p>
                    <p>{{_i('By entering your mobile number, you will be able to use the Jawwal Jawal under construction service that allows you to receive and send mobile messages')}} </p>

                    <div class="row">
                        <div class="col-md-4 offset-md-2">
                            <input type="text" class="form-control" name="fullname" placeholder="{{_i('fullname')}}" value="{{$user->fullname}}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="mobile" placeholder="{{_i('mobile')}}" value="{{$user->mobile}}">
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    <input type="submit" value="{{_i('Edit Details')}}" class="btn btn-pink mt-4 ">
                </div>
            </div>
        </div>


    </form>

</section>


<br><br><br>