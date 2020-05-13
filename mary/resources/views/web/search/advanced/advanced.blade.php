@extends('web.layout.master')
@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Search Advanced')}}</li>
            </ol>
        </div>
    </nav>


    <section class="latest-members  common-wrapper ">

            <div class="container">
                <form action="{{route('advanced-search-post')}}" method="post">
                    {{csrf_field()}}
                    {{method_field('post')}}
                    @php

                        $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
                    @endphp
                    {{--                                {{dd(session('language'))}}--}}
                    @foreach($group as $gro)

                        <div class="account_setting">
                            <p>{{_i($gro->title)}}</p>
                        </div>
                        <div class="row">
                            @if($gro->source_id == null)
                                @foreach(\App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get() as $option)
                                    {{--                                            @foreach($new as $option)--}}
                                    <div class="col-md-6">
                                        <label>{{_i($option->title)}}</label>
                                        <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                            @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach

                            @else

                                @foreach(\App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get() as $option)
                                    <div class="col-md-6">
                                        <label>{{_i($option->title)}}</label>
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
                                @endforeach


                            @endif

                        </div>

                    @endforeach

                    <input type="submit" class="btn btn-grad my-1" value="{{_i('search')}}">
                </form>
            </div>




    </section>
    <br>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('Send massges')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modeldata">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <button type="button" class="btn btn-primary" id="submit">{{_i('send massege')}}</button>
                    @else
                        <a href="{{url('login')}}" type="button" class="btn btn-pink">{{_i('To login')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $('body').on('click','#comment',function (e) {
            e.preventDefault();

            var to = $(this).data('to');
            var fro = $(this).data('fro');


                    @if(\Illuminate\Support\Facades\Auth::check())
            var html = ` <form action="{{route('send-messageUser')}}" method="post" id="mass">
                                    {{csrf_field()}}
                            {{method_field('post')}}
                    <input type="hidden" name="from" value="${fro}">
            <input type="hidden" name="to" value="${to}">

                        <textarea rows="5"  name="messge" class="form-control"></textarea>

                            </form>`;

            @else
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "{{_i('Sorry you should Login')}}",
                timeout: 2000,
                killer: true
            }).show();

            @endif

            $('#modeldata').empty();
            $('#modeldata').append(html);



        });
        $('body').on('click','.add-to-fav',function (e) {
            e.preventDefault();

            var id = $(this).data('id');
            var f = $(this).data('from');
            var t = $(this).data('to');

            if (f.length <= 0){
                new Noty({
                    type: 'warning',
                    layout: 'topRight',
                    text: "{{_i('You should login in the web to send the like')}}",
                    timeout: 2000,
                    killer: true
                }).show();

            }else{
                $.ajax({
                    url: '{{ route('add-heart') }}',
                    method: "post",
                    data: {_token: '{{ csrf_token() }}',
                        f:f,
                        t:t,


                    },
                    success: function (response) {
                        if (response === "true"){
                            $('#like-'+id+' i').attr('class','fa fa-heart');
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{_i('done like !!')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }else{
                            $('#like-'+id+' i').attr('class','fa fa-heart-o');
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{_i('done dislike !!')}}",
                                timeout: 2000,
                                killer: true
                            }).show();

                        }
                    }
                });
            }

        });

        $('body').on('click','#submit',function () {

            $('#mass').submit();
        })
    </script>
    {{--    <script>--}}
    {{--        $(document).on('click','.pagination a' ,function(e){--}}
    {{--            e.preventDefault();--}}

    {{--            var page = $(this).attr('href').split('page=')[1];--}}
    {{--            $.ajax({--}}

    {{--                url:"/paginate/fetch/search?page="+page,--}}
    {{--                success:function (data) {--}}

    {{--                    console.log(data);--}}
    {{--                    $('#data').html(data)--}}
    {{--                }--}}
    {{--            });--}}

    {{--        });--}}
    {{--    </script>--}}

@endpush