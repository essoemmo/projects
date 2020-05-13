{{--@extends('web.layout.master')--}}
{{--@section('content')--}}
{{--    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">--}}
{{--        <div class="container">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="#">{{_i('home')}}</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">{{_i('onlineUser')}} </li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--    </nav>--}}

    <section class="latest-members  common-wrapper ">
        <div class="container">

            <div class="top-member-filter">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" class="users-country-selection form-inline">
{{--                            <label>{{_i('OnineUser')}} </label>--}}
                            <?php
                            $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                                ->get();
                            ?>

                            <select class="form-control my-1 mr-sm-2" id="country">
                                <option >{{_i('Country')}}</option>
                                @foreach($countyname as $country)
                                    <option value="{{$country->id}}">{{$country->county_name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6 align-self-md-center">
                        <div class="filter-btns text-left">
                            <button class="btn btn-default filter-button" id="filter" data-filter="all">{{_i('all')}}</button>
                            <button class="btn btn-default male-icon-img filter-button" id="filter" data-filter="male"></button>
                            <button class="btn btn-default female-icon-img filter-button" id="filter" data-filter="female"></button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="data">

                @include('web.user.OnlineUser.ajax')

            </div>

            {{--            <div class="text-center">--}}
            {{--                <a href="" class="btn btn-pink">اعرض المزيد</a>--}}
            {{--            </div>--}}

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


{{--@endsection--}}
{{--@push('js')--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $('body').on('change', '#country', function (e) {--}}
{{--                e.preventDefault();--}}

{{--                var val = $(this).val();--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('get-onlineUser-country') }}',--}}
{{--                    method: "get",--}}
{{--                    data: {val: val},--}}
{{--                    success: function (response) {--}}
{{--                        $('#data').html(response)--}}
{{--                    }--}}
{{--                });--}}
{{--            })--}}

{{--            $('body').on('click','#filter',function (e) {--}}
{{--                e.preventDefault();--}}
{{--                var filter = $(this).data('filter');--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('get-onlineUser-filter') }}',--}}
{{--                    method: "get",--}}
{{--                    data: {filter:filter},--}}
{{--                    success: function (response) {--}}
{{--                        $('#data').html(response)--}}
{{--                    }--}}
{{--                });--}}

{{--            });--}}

{{--            $('body').on('click','#comment',function (e) {--}}
{{--                e.preventDefault();--}}

{{--                var to = $(this).data('to');--}}
{{--                var fro = $(this).data('fro');--}}


{{--                        @if(\Illuminate\Support\Facades\Auth::check())--}}
{{--                var html = ` <form action="{{route('send-messageUser')}}" method="post" id="mass">--}}
{{--                                    {{csrf_field()}}--}}
{{--                                {{method_field('post')}}--}}
{{--                        <input type="hidden" name="from" value="${fro}">--}}
{{--            <input type="hidden" name="to" value="${to}">--}}

{{--                        <textarea rows="5"  name="messge" class="form-control"></textarea>--}}

{{--                            </form>`;--}}

{{--                @else--}}
{{--                new Noty({--}}
{{--                    type: 'success',--}}
{{--                    layout: 'topRight',--}}
{{--                    text: "{{_i('Sorry you should Login')}}",--}}
{{--                    timeout: 2000,--}}
{{--                    killer: true--}}
{{--                }).show();--}}

{{--                @endif--}}

{{--                $('#modeldata').empty();--}}
{{--                $('#modeldata').append(html);--}}



{{--            });--}}

{{--            $('body').on('click','.add-to-fav',function (e) {--}}
{{--                e.preventDefault();--}}

{{--                var id = $(this).data('id');--}}
{{--                var f = $(this).data('from');--}}
{{--                var t = $(this).data('to');--}}

{{--                if (f.length <= 0){--}}
{{--                    new Noty({--}}
{{--                        type: 'warning',--}}
{{--                        layout: 'topRight',--}}
{{--                        text: "{{_i('You should login in the web to send the like')}}",--}}
{{--                        timeout: 2000,--}}
{{--                        killer: true--}}
{{--                    }).show();--}}

{{--                }else{--}}
{{--                    $.ajax({--}}
{{--                        url: '{{ route('add-heart') }}',--}}
{{--                        method: "post",--}}
{{--                        data: {_token: '{{ csrf_token() }}',--}}
{{--                            f:f,--}}
{{--                            t:t,--}}


{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            if (response === "true"){--}}
{{--                                $('#like-'+id+' i').attr('class','fa fa-heart');--}}
{{--                                new Noty({--}}
{{--                                    type: 'success',--}}
{{--                                    layout: 'topRight',--}}
{{--                                    text: "{{_i('done like !!')}}",--}}
{{--                                    timeout: 2000,--}}
{{--                                    killer: true--}}
{{--                                }).show();--}}
{{--                            }else{--}}
{{--                                $('#like-'+id+' i').attr('class','fa fa-heart-o');--}}
{{--                                new Noty({--}}
{{--                                    type: 'warning',--}}
{{--                                    layout: 'topRight',--}}
{{--                                    text: "{{_i('done dislike !!')}}",--}}
{{--                                    timeout: 2000,--}}
{{--                                    killer: true--}}
{{--                                }).show();--}}

{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}

{{--            });--}}

{{--            $('body').on('click','#submit',function () {--}}

{{--                $('#mass').submit();--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(document).on('click','.pagination a' ,function(e){--}}
{{--            e.preventDefault();--}}

{{--            var page = $(this).attr('href').split('page=')[1];--}}
{{--            $.ajax({--}}
{{--                url:"/paginate/fetch/online?page="+page,--}}
{{--                success:function (data) {--}}
{{--                    $('#data').html(data)--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
