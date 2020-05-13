@extends('admin.layout.index',[
'title' => _i('Show Message'),
'activePageName' => _i('Show Message'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Show Message Details') }}</h5>
        </div>
        <div class="card-block">
            <form method="POST" action="{{route('contact.destroy', $contact->id)}}" class="j-forms"
                  data-parsley-validate>
                @method('DELETE')
                @csrf
                @honeypot {{--prevent form spam--}}

                <div class="content">

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Message Details') }}</span>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Name') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control" disabled value="{{$contact->name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Phone') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control" disabled value="{{$contact->phone}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Email') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control" disabled value="{{$contact->email}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Membership No') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control" disabled
                                   value="{{ membership_number($contact->membership_number) }}">
                        </div>
                    </div>

                    @if($contact->ticket_id != null)
                        <div class="form-group row">
                            <label for="" class="col-sm-2 control-label">{{ _i('Section') }}</label>
                            <div class="col-sm-10">
                                <select name="ticket_id" disabled class="form-control">
                                    @if(count($openTickets) > 0)
                                        @foreach($openTickets as $ticket)
                                            <option value="{{ $ticket->id }}"
                                                    @if($ticket->id == $contact->ticket_id) selected @endif>{{ $ticket->title }}</option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($contact->priority_id != null)
                        <div class="form-group row">
                            <label for="" class="col-sm-2 control-label">{{ _i('Priority') }}</label>
                            <div class="col-sm-10">
                                <select name="ticket_id" disabled class="form-control">
                                    @if(count($priorities) > 0)
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}"
                                                    @if($priority->id == $contact->priority_id) selected @endif>{{ $priority->title }}</option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Message') }}</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" disabled>{!! strip_tags($contact->message) !!}</textarea>
                        </div>
                    </div>

                    @if($contact->attach != null)
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">{{ _i('Attachment') }}</label>
                            <div class="col-sm-10">
                                <a href="{{ $contact->attach }}">{{ _i('Attachment') }}</a>
                            </div>
                        </div>
                    @endif


                    @if($trans != null)
                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Payment Details') }}</span>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 control-label">{{ _i('Bank') }}</label>
                            <div class="col-sm-10">
                                <select name="ticket_id" disabled class="form-control">
                                    @if(count($banks) > 0)
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}"
                                                    @if($bank->id == $trans->bank_id) selected @endif>{{ $bank->title }}</option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">{{ _i('Sender Name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" disabled value="{{$trans->holder_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">{{ _i('Transfer Number') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" disabled value="{{$trans->bank_transactions_num}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">{{ _i('The amount paid') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" disabled value="{{$trans->total}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 control-label">{{ _i('Order') }}</label>
                            <div class="col-sm-10">
                                <select name="ticket_id" disabled class="form-control">
                                    @if(count($user_orders) > 0)
                                        @foreach($user_orders as $user_order)
                                            <option value="{{ $user_order->id }}"
                                                    @if($user_order->orderNumber == $trans->orderNumber) selected @endif>
                                                @if($user_order->advert_type != null)
                                                    @if($user_order->advert_type == 'website')
                                                        {{ _i('Ad on our accounts') }}
                                                    @else
                                                        {{ _i('Ad with celebrities') }}
                                                    @endif
                                                @else
                                                    @if($user_order->featured_type == 'featured')
                                                        {{ _i('Featured Members') }}
                                                    @else
                                                        {{ _i('Slider') }}
                                                    @endif
                                                @endif
                                            </option>
                                        @endforeach
                                    @else
                                        <option>{{ _i('No Data') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">{{ _i('Transfer image') }}</label>
                            <div class="col-sm-10">
                                <img class="img-responsive pad" width="150px"
                                     height="150px"
                                     src="{{ asset($trans->image) }}" id="image">
                            </div>
                        </div>

                    @endif

                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <a href="{{aUrl('contact/all')}}">
                                <button type="button" class="btn btn-default btn-outline-default m-b-0 col-sm-2 ">
                                    {{_i('Back')}}
                                </button>
                            </a>

                            <button type="submit" class="btn btn-danger btn-outline-danger m-b-0 col-sm-2"
                                    style="margin-left: 10px; margin-right: 10px;">{{ _i('Delete') }}</button>

                            <button type="button" class="btn btn-primary btn-outline-primary m-b-0 col-sm-2"
                                    data-toggle="modal" data-target="#notification"
                                    style="margin-left: 10px; margin-right: 10px;">{{ _i('Send Notification') }}</button>

                            <button type="button" class="btn btn-primary btn-outline-primary m-b-0 col-sm-2"
                                    data-toggle="modal" data-target="#email"
                                    style="margin-left: 10px; margin-right: 10px;">{{ _i('Send Email') }}</button>

                        </div>
                    </div>

                </div>
            </form>

            @include('admin.contact.includes.model')
        </div>
    </div>

@endsection

@push('js')

    <script>
        $('.click').on('click', function () {
            var email = $('.user_email').val();
            var message = $('.message').val();

        });
        $('#send_noty').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('send_notification')}}",
                type: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.modal.modal-notification').modal('hide');
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('Message Sent Successfully')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }
            })
        });

        $('#send_email').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('send_notification')}}",
                type: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.modal.modal-notification').modal('hide');
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('Message Sent Successfully')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }
            })
        });
    </script>

@endpush

