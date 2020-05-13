@extends('web.layout.index')
@section('content')
    @if (\Session::has('success'))
        <div class="text-center alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    @if (\Session::has('failure'))
        <div class="text-center alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
        </div><br />
    @endif


<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin: 36px;
    padding: 30px;">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">اخر الاعضاء دخولا</h5>
                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">age</th>
                            <th scope="col">الجنسية</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($lastLogin->where('user_id','!=',$user->id) as $last)
                            <tr>
                                <td> @if($last->user->gender == 'male') <i class="fa fa-heart-o"></i> @else <i class="fa fa-heart"></i>  @endif  </td>
                                <td><a href="{{route('user-details',$last->user->id)}}">{{$last->user->username}}</a> </td>
                                <td>{{$last->user->age}}</td>

                            <?php
        $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $last->user_id)->first();
        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
            ->where('nationalty_id', $usernat->nationalty_id)
            ->value('name');
                                        ?>
                                <td>{{$countyname}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


        <div class="col-md-6" style="margin: 36px;
                  padding: 30px;">
            <div class="card" style="width: 18rem;">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="card-body">
                        <h5 class="card-title">{{_i('profile').auth()->user()->username}}</h5>
                       <ul>
                           <li><a href="{{route('profile-user')}}">{{_i('profile')}}</a> </li>
                           <li><a href="{{route('profile-value','like')}}">{{_i('like')}}</a></li>
                           <li><a href="{{route('profile-value','block')}}">{{_i('blocked')}}</a></li>
                           <li><a href="{{route('profile-value','dislike')}}">{{_i('disliked')}}</a></li>
                       </ul>
                    </div>
                    @else
                    <p style="text-align: center;     font-size: 25px;
" >{{_i('login in web')}}</p>
                    <form class="shadow-lg" action="{{url('/login')}}" method="post" data-parsley-validate="">

                        @csrf

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="{{_i('Email')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="Password"  name="password" required=""
                                       placeholder="{{_i('Password')}}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" >
                                    <label class="custom-control-label" for="customCheck1">{{_i('Remember Me')}}</label>
                                </div>

                                {{--                                <div class="center">--}}
                                {{--                                    <button type="submit" class="btn btn-red">{{_i('Login')}}</button>--}}
                                {{--                                </div>--}}


                                <div class="">
                                    <div class="right" style="display:inline-block;">
                                        <button type="submit" class="btn btn-red">{{_i('Login')}}</button>
                                    </div>
                                    <div class="left" style="text-align: left; display:inline-block; float: left;" >
                                        <a href="{{url('/reset_password')}}">
                                            <button type="button"  class="btn btn-green" >
                                                {{_i('Forgot your password')}}
                                            </button>
                                        </a>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </form>

                @endif

            </div>
        </div>

    </div>

</div>
    <?php
        $national = \Illuminate\Support\Facades\DB::table('nationalies_data')
            ->join('nationalties','nationalies_data.nationalty_id','=','nationalties.id')
            ->get();

    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin: 36px;
    padding: 30px;">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link stat" id="home-tab" data-toggle="tab" href="#zoug" role="tab" aria-controls="home"
                                   aria-selected="true" data-name="male">بحث عن زوج</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active stat" id="profile-tab" data-toggle="tab" href="#wife" role="tab" aria-controls="profile"
                                   aria-selected="false" data-name="female">بحث عن زوجة</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="zoug" role="tabpanel" aria-labelledby="home-tab">
                                <form action="{{route('search')}}" method="get">
                                      @csrf
                                    <input type="hidden" name="gendar" value="male">

                                    <label>جنسيته</label>
                                    <select name="nationalty" class="form-control nationalty">
                                        <option value="">كل الجنسيات</option>
                                      @foreach($national as $natio)
                                          <option value="{{$natio->id}}">{{$natio->name}}</option>
                                      @endforeach
                                    </select>


                                    <label>مقيم في</label>
                                    <select name="country" class="form-control country">
                                        <option value="">كل الدول</option>

                                    </select>


                                    <label>عمره</label>
                                    <select name="from" class="form-control">
                                        <option value="">لايهم</option>
                                        @for($i=18 ; $i<= 90 ;$i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <label>الي </label>
                                    <select name="to" class="form-control">
                                        <option value="">الي</option>
                                        @for($i=18 ; $i<= 90 ;$i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>


                                    <label>الحالة الاجتماعية </label>
                                    <select name="status" class="form-control status">
                                        <option value=""></option>
{{--                                       @foreach(\App\Models\Material_status::get() as $mat)--}}
{{--                                            <option>{{$mat->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>


                                    <label>ترتيب النتائج</label>
                                    <select name="order" class="form-control">
                                        <option value="lastlogin desc">الآخر دخولا أولا</option>
                                        <option value="postdate desc">المشتركين الجدد أولا</option>
                                        <option value="age">الأصغر عمر أولا</option>
                                        <option value="country">حسب الإقامة</option>
                                    </select>

                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>بحث</button>

                                </form>

                            </div>


                            <div class="tab-pane fade" id="wife" role="tabpanel" aria-labelledby="profile-tab">


                                <form action="{{route('search')}}" method="get">
                                    @csrf
                                    <input type="hidden" name="gendar" value="female">

                                    <label>جنسيتها</label>
                                    <select name="nationalty" class="form-control nationalty">
                                        <option value="">كل الجنسيات</option>
                                        @foreach($national as $natio)
                                            <option value="{{$natio->id}}">{{$natio->name}}</option>
                                        @endforeach
                                    </select>


                                    <label>مقيمة في</label>
                                    <select name="country" class="form-control country">
                                        <option value="">كل الدول</option>

                                    </select>


                                    <label>عمرها</label>
                                    <select name="from" class="form-control">
                                        <option value="">لايهم</option>
                                        @for($i=18 ; $i<= 90 ;$i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <label>الي </label>
                                    <select name="to" class="form-control">
                                        <option value="">الي</option>
                                        @for($i=18 ; $i<= 90 ;$i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>


                                    <label>الحالة الاجتماعية </label>
                                    <select name="status" class="form-control status">
                                        <option value=""></option>
{{--                                        @foreach(\App\Models\Material_status::get() as $mat)--}}
{{--                                            <option>{{$mat->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>


                                    <label>ترتيب النتائج</label>
                                    <select name="order" class="form-control">
                                        <option value="lastlogin desc">الآخر دخولا أولا</option>
                                        <option value="postdate desc">المشتركين الجدد أولا</option>
                                        <option value="age">الأصغر عمر أولا</option>
                                        <option value="country">حسب الإقامة</option>
                                    </select>

                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>بحث</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $('body').on('change','.nationalty',function () {

                var id = $(this).val();


                $.ajax({
                    url: '{{route('get-searchCountry')}}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {id: id},
                    success: function (response) {

                        $('.country').empty();
                        $('.country').append('<option value="'+response.data.id+'">'+response.data.county_name+'</option>');

                    }

                });

            });

            $('body').on('change','.stat',function () {

                var val = $(this).data('name');

                $.ajax({
                    url: '{{ route('statue-user') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        $('.status').empty();
                        for (var i = 0; i <= response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });
            })

            // $('.stat').trigger('click');


        });
    </script>

    @endpush