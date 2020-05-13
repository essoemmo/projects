@extends('master.layout.index',[
'title' => _i('Store Details'),
'subtitle' => _i('Store Details'),
'activePageName' => _i('Store Details'),
] )

@section('content')
<!-- Page-body start -->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5> {{ _i('Store Details') }} </h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>
            </div>
            <div class="card-block">



                    <div class="form-group row">
                        <label for="name" class="col-sm-2 control-label">{{ _i('Title') }} :</label>
                        <label id="name" class="col-sm-6 control-label">{{ $store['title'] }}</label>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-sm-2 control-label">{{ _i('Domain') }} :</label>
                        <label class="col-sm-6 control-label">
                            {{--                                {{ $store['domain'] }}--}}
                            <a 
                                href="{{request()->getScheme()}}://{{$store->domain}}.{{request()->getHost().'/home'}}">
                                {!!_i($store->domain)!!}.{{request()->getHost().'/home'}}
                            </a>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">{{ _i('Package') }} :</label>
                        <label class="col-sm-6 control-label">
                            {{--                                {{ $membership['title'] }}--}}
                            <a style="color: #13866f !important" target="_blank"
                                href="{{ url('master/membership/'.$store['membership_id'].'/edit') }}">
                                <b>{{ ($membership_data['title']) }}</b>
                            </a>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">{{ _i('Price') }} :</label>
                        <label class="col-sm-6 control-label">{{ $membership['price'] }}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">{{ _i('Owner') }} :</label>
                        <a  href="{{url('master/user/'.$user->id.'/edit')}}">{{ $user['name'] .' '. $user['lastname']}}</a>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">{{ _i('NO.Users') }} :</label>
                        <label class="col-sm-6 control-label">{{ $store_users}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">{{ _i('Status') }} :</label>
                        <label class="col-sm-6 control-label" id="store_status">
                            @if($store['is_active'] == 1)
                                <div class="badge badge-info" > {{_i(" Active ")}}</div>
                            @else
                                <div class="badge badge-warning" > {{_i(" Not Active ")}} </div>
                            @endif

                        </label>
                    </div>

                    <div class="box-footer">
                        <a href="{{url('/master/store/all')}}" class="backLink">
                            <button type="button" class="btn btn-default col-sm-4 ">
                                {{_i('Back')}}
                            </button>
                        </a>

                        <div   style="display: inline" class="show_button_status">
                            @if($store['is_active'] == 1)
                                <form method="Post" action="{{url('/master/store/change_status')}}" class="status_button disaple_form" style="display: inline">
                                    {{method_field('post')}}
                                    <input type="hidden" name="store_id" value="{{$store['id']}}">
                                    <input type="hidden" name="store_status" value="0">
                                    <button type="submit" class="btn btn-primary  col-sm-4  "  >
                                        {{_i('Not Activate')}}
                                    </button>
                                </form>
                            @else
                                <form method="Post" action="{{url('/master/store/change_status')}}" class="status_button active_form"  style="display: inline">
                                    {{method_field('post')}}
                                    <input type="hidden" name="store_id" value="{{$store['id']}}">
                                    <input type="hidden" name="store_status" value="1">
                                    <button type="submit" class="btn btn-primary  col-sm-4 ">
                                        {{_i('Activate')}}
                                    </button>
                                </form>

                            @endif
                        </div>

                    </div>


            </div>

        </div>
    </div>

</div>


@endsection

@push('js')

    <script>
        $('body').on('submit','.status_button',function (e) {
            e.preventDefault();
            console.log('kkjj');
            let url = $(this).attr('action');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form =$(this);
            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                // dataType: 'json',
                type: 'POST',
                datatype: 'JSON',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                   // $('[data-enable]').hide()
                    //$('<i class="icofont icofont-check-circled text-primary" data-enable=""></i> <span data-enable=""  class="text-primary"><?=_i("Enabled")?></span>').insertAfter($(form).find("button"));

                    if(response.is_active == 1)
                    {
                        $('#store_status').empty();
                        $('#store_status').append('<div class="badge badge-info" > {{_i(" Active ")}}</div>');
                        $('.show_button_status').empty();
                        $('.show_button_status').append('<form method="Post" action="{{url('/master/store/change_status')}}" class="status_button disaple_form" style="display: inline">'+
                        '{{method_field('post')}} <input type="hidden" name="store_id" value="{{$store['id']}}"> <input type="hidden" name="store_status" value="0">' +
                        '<button type="submit" class="btn btn-primary col-sm-4"> {{_i('Not Activate')}} </button>  </form>');

                    }else{ // if is_active = 0
                        $('#store_status').empty();
                        $('#store_status').append('<div class="badge badge-warning" > {{_i(" Not Active ")}} </div>');
                        $('.show_button_status').empty();
                        $('.show_button_status').append('<form method="Post" action="{{url('/master/store/change_status')}}" class="status_button disaple_form" style="display: inline">'+
                            '{{method_field('post')}} <input type="hidden" name="store_id" value="{{$store['id']}}"> <input type="hidden" name="store_status" value="1">' +
                            '<button type="submit" class="btn btn-primary col-sm-4"> {{_i('Activate')}} </button>  </form>');

                    }
                    console.log(response.is_active);
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('Changes saved successfully') }}",
                        timeout: 2000,
                        killer: true
                    }).show();



                },

            });

        });
    </script>
@endpush