@extends('web.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Register')}}</li>
            </ol>
        </div>
    </nav>

    <section class="register-form common-wrapper ">
                    @if ($errors->all())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--        @include('admin.layouts.message')--}}
        <form  action="{{ route('store-member') }}" method="post" data-parsley-validate="" enctype="multipart/form-data">
            @csrf
            <div class="container">

            <div class="row" id="first">
                <section class="register-form common-wrapper ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="sign-up-note center">
                                    <div>

                                        {!!settings()->register_msg!!}
                                    </div>
{{--                                    <form action="">--}}

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"> {{_i('I have taken the oath, and I will stick to it')}}</label>
                                        </div>

                                        <div class="img-radio-btns">
                                            <label>{{_i('Department')}}</label>
                                            <select class="form-control select2" style="width: 100%;" name="category">
                                                @foreach(\App\Models\Category::get() as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>


                                            <input id="female" type="radio" class="gender" name="gendar" value="female" />
                                            <label for="female" class="female-icon-img">{{_i('female')}}</label>

                                            <input id="male" type="radio" class="gender" name="gendar" value="male" />
                                            <label for="male" class="male-icon-img">{{_i('male')}}</label>

                                            <div class="text-center my-4">
                                                <button type="submit"  class="btn btn-pink" id="clicknext">{{_i('Register now')}}</button>
                                            </div>
                                        </div>
{{--                                    </form>--}}
                                </div>

                            </div>
                        </div>
                    </div>
                </section>


                <br><br><br>
{{--                <div class="firstpage" style="width: 100%;">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{_i('Department')}}</label>--}}
{{--                        <select class="form-control select2" style="width: 100%;" name="category">--}}
{{--                            @foreach(\App\Models\Category::get() as $category)--}}
{{--                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <div class="male">--}}
{{--                            <input type="radio" class="gender" name="gendar" value="male"><label>{{_i('male')}}</label>--}}
{{--                        </div>--}}

{{--                        <div class="female" >--}}
{{--                            <input type="radio"  class="gender" name="gendar" value="female"><label>{{_i('female')}}</label>--}}
{{--                        </div>--}}

{{--                        <button id="clicknext">{{_i('next')}}</button>--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>
            </div>



            <div id="finish" style="display: none">
            <div class="fields-wrapper  py-4">
                <div class="container">
                    <p class="font-weight-bold text-center mb-5">{{_i('In the name of God I trusted in God God bless me good wife')}} </p>

                    <div class="row">
                        <div class="col-md-8 ">

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">{{_i('memberShip')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="memberShip">
                                        <option value="">{{_i(' All member ship')}}</option>
                                        @foreach(\App\Models\Membership::get() as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">{{_i('username')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" value="{{old('username')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">{{_i('password')}}</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repassword" class="col-sm-3 col-form-label">{{_i('password_confirmation')}}</label>
                                <div class="col-sm-9">
                         <input type="password" id="password_con" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">{{_i('email')}}</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 align-content-md-stretch d-flex ">
                            <div class="notice-box ">
                                <div class="notice-title">{{_i('username')}}</div>
                                <p>
                                   {{_i('The nickname that appears to all members must be decent and respectable must not exceed 15 characters')}}</p>
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
                                    <option value="{{$namenat->id}}">{{$namenat->county_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">{{_i('city')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control city" name="city" style="width: 100%;">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label">{{_i('Address')}}</label>
                        <div class="col-sm-10">

                            <textarea type="text" name="address" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fields-wrapper  py-4">
                <div class="container">


                    <div class="form-group row">
                        <label for="marriage-type" class="col-sm-2 col-form-label">{{_i('nationalty')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                                @php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); @endphp
                                @foreach ($nationName as $namenat)
                                    <option value="{{$namenat->nationalty_id}}">{{$namenat->name}}</option>
                                @endforeach

                            </select>                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{_i('material_status')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control status" style="width: 100%;" name="material_status_id">
                                @foreach(\App\Models\Material_status::get() as $matiral)
                                    <option value="{{$matiral->id}}">{{$matiral->name}}</option>
                                @endforeach
                            </select>                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label for="" class="col-sm-2 col-form-label">عدد الاطفال</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="email" class="form-control " id="">--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{_i('age')}}</label>
                        <div class="col-sm-10">
                   <input type="text" name="age" class="form-control" data-parsley-type="number" data-parsley-maxlength="10">
                        </div>
                    </div>

                </div>
            </div>


            <div class="fields-wrapper bg-light-pink  py-4">
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


                </div>
            </div>

            <div class="fields-wrapper py-4">
                <div class="container">

                    <p> {{_i('about the partener')}}</p>
                 <textarea type="text" name="partener" class="form-control" rows="10"></textarea>
                    <p class="text-muted text-left my-2 small">{{_i('(Please write in a serious manner and it is forbidden to write email or mobile number in this place)')}}</p>
                </div>
            </div>

            <div class="fields-wrapper bg-light-pink py-4">
                <div class="container">

                    <p>{{_i('about_me')}}</p>
                 <textarea type="text" name="about_me" class="form-control" rows="10"></textarea>
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
                            <input type="text" name="fullname" class="form-control" placeholder="{{_i('fullname')}}">

                            </div>
                            <div class="col-md-4">
                                <input type="text" name="mobile" class="form-control" placeholder="{{_i('mobile')}}">

                            </div>
                        </div>
                    </div>

{{--                    <div class="custom-control custom-checkbox">--}}
{{--                        <input type="checkbox" class="custom-control-input" id="customCheck1" required="">--}}
{{--                        <label class="custom-control-label" for="customCheck1">--}}
{{--                            {{_i('I acknowledge and agree to the Privacy Policy and the Terms of Use Agreement.')}}--}}
{{--                        </label>--}}
{{--                    </div>--}}

                    <div class="custom-control custom-checkbox">

                        <label class="" for="customCheck1"><input type="checkbox" class="custom-control" id="customCheck1" required> {{_i('I have taken the oath and I will stick to it')}}</label>
                    </div>


                    <div class="text-center">
                        <input type="submit" value="{{_i('save')}}" class="btn btn-pink mt-4 ">
                    </div>
                </div>
            </div>
            </div>


        </form>

    </section>

@endsection

@push('js')

    <script>
        $(document).ready(function () {

            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('get_City') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        if (response.status){

                            $('.city').empty();
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{_i('Sorry not found city to this country')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }

                        $('.city').empty();
                        console.log(response);
                        for (var i = 0; i < response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                        }
                    }

                });

            });


            $('body').on('click','input[type=radio]',function (e) {
                // e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '{{ route('statue-user') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        console.log(response.data);
                        $('.status').empty();
                        for (var i = 0; i < response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });

            });

            $('body').on('click','#clicknext',function (e) {
                    e.preventDefault();
                var gender = $('#first input[type=radio]:checked').val();
                var checked = $('#first input[type=checkbox]:checked').val();

                if (checked != null && gender != null ){
                    $('#first').hide(500);
                    $('#finish').show(500);
                }else{
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('You must determine your commitment to the department and determine your nationality')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }


            });



        });
</script>

    @endpush