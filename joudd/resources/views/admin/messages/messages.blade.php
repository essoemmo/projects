@extends('admin.layout.layout')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Messages')}}</li>
            </ol>
        </div>
    </nav>
                <div class="col-sm-12">
                    <h3 class=" text-center">{{ _i('Messages') }}</h3>
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="headind_srch">
                                    <div class="recent_heading">
                                        <h4>{{ _i('Recent') }}</h4>
                                    </div>
                                </div>

{{--                                                                        @dd($messages)--}}
                                    <div class="inbox_chat">
                                        @foreach($messages as $message)
                                            <div class="chat_list active_chat">
                                                <div class="chat_people">
                                                    <div class="chat_img">
                                                        @if($message->image == null)
                                                            <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                                        @else
                                                            <img src="{{ asset('uploads/applicants/' . $message->from_id . '/' . $message->image) }}" alt="{{ $message->image }}">
                                                        @endif
                                                    </div>
                                                    <div class="chat_ib">
                                                        <h5>
                                                            <a href="javascript:void(0)" class="get_messages">
                                                                <input type="hidden" name="from_id" class="from_id" value="{{ $message->from_id }}">
                                                                <input type="hidden" name="message_id" class="message_id" value="{{ $message->id }}">
                                                                {{--                                                            <input type="hidden" name="id_message" class="id_message" value="{{ $message->id }}">--}}
                                                                {{ $message->first_name }} {{ $message->last_name }}
                                                            </a>
                                                        </h5>
                                                        <p>
                                                            <span class="chat_date ml-2">{{ date('d M', strtotime( $message->updated_at)) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">

                                </div>
                                <div class="type_msg">

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

@endsection

@push('js')

    <script>
        $(function () {
            'use strict';
            $('a.get_messages').click(function (e) {
                var from_id = $(this).children('.from_id').val();
                var message_id = $(this).children('.message_id').val();
                // console.log(from_id,message_id);
                $.ajax({
                    url:'/user/get_messages_from_id',
                    DataType:'json',
                    type:'get',
                    data: {from_id: from_id},
                    success:function (res) {
                        $('.msg_history').empty();
                        $('.type_msg').empty();
                        res.forEach(message => {
                            if(message.sender_user_id == '{{ auth()->id() }}') {
                                var msg_class = 'sent_msg';
                                var msg_inc = 'outgoing_msg';
                                var incoming_msg_img ='';
                                var img_src = '';
                            } else {
                                var msg_class = 'received_msg';
                                var msg_inc = 'incoming_msg';
                                var received_withd_msg ='received_withd_msg';
                                var incoming_msg_img ='incoming_msg_img';
                                var img_src = '<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">';
                            }
                            $('.msg_history').append(`
                                <div class="${msg_inc}">
                                    <div class="${incoming_msg_img}">
                                        ${img_src}
                                    </div>
                                    <div class="${msg_class}">
                                        <div class="${received_withd_msg}">
                                            <p>${message.message}</p>
                                            <span class="time_date"> 11:01 AM    |    June 9</span>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                        $('.type_msg').append(`
                            <div class="input_msg_write">
                                <div class="col-sm-10">
                                    <div>
                                        <input name="message" type="text" class="write_msg" placeholder="Type a message"/>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a href="javascript:void(0)" class="msg_send_btn">
                                        <input name="to_id" type="hidden" id="to_id" value="${from_id}"/>
                                        <input type="hidden" name="message_id" value="${message_id}" id="message_id">
                                    </a>
                                </div>
                            </div>
                        `);
                    }
                })
            });
        })

        $(function () {
            'use strict';
            $('.msg_send_btn').click(function (e) {
                console.log('clicked');
                var to_id = $(this).children('#to_id').val();
                var message_id = $(this).children('#message_id').val();
                var message = $('.message').val();
                console.log(to_id,message_id,message);
                {{--$.ajax({--}}
                {{--    url:'/admin/sliders/{{ $id }}/change',--}}
                {{--    DataType:'json',--}}
                {{--    type:'get',--}}
                {{--    success:function (res) {--}}
                {{--        table.ajax.reload();--}}
                {{--    }--}}
                {{--})--}}
            });
        })
    </script>

{{--    <script>--}}
{{--        $(function () {--}}
{{--            'use strict';--}}
{{--            $('a.msg_send_btn').click(function (e) {--}}
{{--                console.log('clicked');--}}
{{--                var to_id = $(this).children('#to_id').val();--}}
{{--                var message_id = $(this).children('#message_id').val();--}}
{{--                var message = $('.message').val();--}}
{{--                console.log(to_id,message_id,message);--}}
{{--                --}}{{--$.ajax({--}}
{{--                --}}{{--    url:'/admin/sliders/{{ $id }}/change',--}}
{{--                --}}{{--    DataType:'json',--}}
{{--                --}}{{--    type:'get',--}}
{{--                --}}{{--    success:function (res) {--}}
{{--                --}}{{--        table.ajax.reload();--}}
{{--                --}}{{--    }--}}
{{--                --}}{{--})--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}



@endpush

