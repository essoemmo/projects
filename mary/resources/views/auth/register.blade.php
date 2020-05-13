@extends('layouts.app')

@section('css')
    <style>
        .account_setting {
            width: 100%;
            background: #ddd;
            text-align: left;
        }
        .account_setting p {
            font-size: 30px;
            font-style: oblique;
        }

    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="col-md-12">
                        @if ($errors->all())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('store-member') }}">
                            @csrf

                            <div class="form-group">
                                <label>{{_i('member ship')}}</label>
                                <select class="form-control select2" style="width: 100%;" name="memberShip">
                                    <option value="">{{_i(' All member ship')}}</option>
                                    @foreach(\App\Models\Membership::get() as $member)
                                        <option value="{{$member->id}}">{{$member->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label>{{_i('Department')}}</label>
                                <select class="form-control select2" style="width: 100%;" name="category">
                                    @foreach(\App\Models\Category::get() as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group" style="display: inline-flex;position: relative; right: 487px;">
                                <div class="male"  style="    position: relative;left: 80px;}">
                                    <input type="radio" class="gender" name="gendar" value="male"><label>{{_i('male')}}</label>
                                </div>
                                <div class="female" style="    position: relative; right: 80px;}" >
                                    <input type="radio"  class="gender" name="gendar" value="female"><label>{{_i('female')}}</label>
                                </div>

                            </div>


                            <div class="form-group">
                                <label>{{_i('material_status')}}</label>
                                <select class="form-control status" style="width: 100%;" name="material_status_id">
                                    {{--                                        @foreach(\App\Models\Material_status::get() as $matiral)--}}
                                    {{--                                            <option value="{{$matiral->id}}">{{$matiral->name}}</option>--}}
                                    {{--                                        @endforeach--}}
                                </select>
                            </div>
                            <!-- /.form-group -->

                            {{--Account setting--}}
                            <div class="clearfix"></div>
                            <hr>
                            <div class="account_setting">
                                <p>{{_i('account_setting')}}</p>
                            </div>

                            <div class="form-group">
                                <label>{{_i('User name')}}</label>
                                <input type="text" name="username" class="form-control"{{old('username')}}>
                            </div>

                            <div class="form-group">
                                <label>{{_i('email')}}</label>
                                <input type="email" name="email" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>{{_i('password')}}</label>
                                <input type="password" name="password" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>{{_i('Password_confirmation')}}</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            {{--Address--}}

                            <div class="clearfix"></div>
                            <hr>
                            <div class="account_setting">
                                <p>{{_i('Address')}}</p>
                            </div>


                            <div class="form-group">
                                <label>{{_i('nationalty')}}</label>
                                <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                                    @php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); @endphp
                                    @foreach ($nationName as $namenat)
                                        <option value="{{$namenat->nationalty_id}}">{{$namenat->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{_i('Country')}}</label>
                                <select class="form-control country" name="country" style="width: 100%;">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{_i('City')}}</label>
                                <select class="form-control city" name="city" style="width: 100%;">
{{--                                    <option value="0">0</option>--}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{_i('Address')}}</label>
                                <textarea type="text" name="address" class="form-control"></textarea>
                            </div>

                            <div class="clearfix"></div>
                            <hr>
                            @php
                                $group = \App\Models\Option_group::get();
                            @endphp
                            @foreach($group as $gro)

                                <div class="account_setting">
                                    <p>{{_i($gro->title)}}</p>
                                </div>
                                <div class="row">
                                    @foreach(\App\Models\Option::where('group_id',$gro->id)->get() as $option)
                                        <div class="col-md-6">
                                            <label>{{_i($option->title)}}</label>
                                            <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                                @foreach(\App\Models\Option_value::where('option_id',$option->id)->get() as $val)
                                                    <option value="{{$val->id}}">{{$val->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                </div>



                            @endforeach

                            <div class="form-group">
                                <label>{{_i('About the partener')}}</label>
                                <textarea type="text" name="partener" class="form-control ckeditor"></textarea>
                            </div>

                            <div class="form-group">
                                <label>{{_i('About me')}}</label>
                                <textarea type="text" name="about_me" class="form-control ckeditor"></textarea>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-sm">{{(_i('add Member'))}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('body').on('change','.nationalty',function () {
                var id = $(this).val();

                $.ajax({
                    url: '{{ route('get-Country') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        $('.country').empty();
                        $('.country').append('<option value="'+response.data.id+'">'+response.data.county_name+'</option>');

                    }
                });
            });



            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('get_City') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        console.log(response);
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

                        for (var i = 0; i <= response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                        }
                    }

                });

            });

            $('body').on('change','.nationalty',function () {
                setTimeout(
                    function()
                    {
                        $('.country').trigger('change');
                    }, 500);

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
                        for (var i = 0; i <= response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });

            })

        });
    </script>
@endsection

