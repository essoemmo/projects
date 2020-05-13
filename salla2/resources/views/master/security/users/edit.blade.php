@extends('master.layout.index',[
'title' => _i('User Store Details'),
'subtitle' => _i('User Store Details'),
'activePageName' => _i('User Store Details'),
] )

@section('content')
    <!-- Page-body start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('User Store Details') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">


                    <form method="post" action="{{url('/master/user/'.$user->id.'/edit')}}" class="form-horizontal"   data-parsley-validate="">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">{{ _i('First Name') }} :</label>
                            <label id="name"  class="col-sm-6 control-label"  >{{ $user['name'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 control-label">{{ _i('Last Name') }} :</label>
                            <label   class="col-sm-6 control-label"   >{{ $user['lastname'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('E-Mail Address') }} :</label>
                            <label  class="col-sm-6 control-label"  >{{ $user['email'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('Mobile') }}</label>
                            <label  class="col-sm-6 control-label"  >{{ $user['phone'] }}</label>
                        </div>

                        <h4> {{_i('Stores Details')}} :</h4>
                        <br />
                        <div class="form-group row text-center info">
                            <table  class="table table-bordered table-striped dataTable text-center">
                                <thead>
                                <tr  class="text-center ">
                                    <th class="text-center"> {{_i('Domain Name')}}</th>
                                    <th class="text-center"> {{_i('Domain Url')}}</th>
                                    <th class="text-center"> {{_i('Membership')}}</th>
                                </tr>
                                </thead>
                                @php
                                    $stores = \App\StoreData::where('owner_id' ,$user['id'])->get();
                                @endphp
                                @foreach($stores as $item)
                                    <tr>
                                        <td>
                                            <label for="email" class="col-sm-4 control-label"><a target="_blank" href="{{ ($item['domain']) }}" style="color: black;">{{ ($item['title']) }}</a></label>
                                        </td>
                                        <td>
                                            <label  class="col-sm-5 control-label">  <a
                                                href="{{request()->getScheme()}}://{{$item->domain}}.{{request()->getHost().'/home'}}">
                                                {!!_i($item->domain)!!}.{{request()->getHost().'/home'}}
                                            </a></label>
                                        </td>
                                        <?php
                                            $membership = \App\Models\Membership\Membership::join('memberships_data','memberships_data.membership_id','memberships.id')
                                                    ->select(['memberships.id as id','memberships_data.title','memberships_data.lang_id','memberships_data.membership_id'])
                                                        ->where('memberships_data.lang_id', getLang(session('MasterLang')))
                                                        ->where('memberships_data.membership_id', $item->membership_id)
                                                    ->first();
                                        ?>
                                        <td>
                                            <a style="color: #13866f !important" target="_blank" href="{{ url('master/membership/'.$item->membership_id.'/edit') }}">
                                                <b>{{ ($membership['title']) }}</b>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        {{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-sm-4 control-label"><b>{{ _i('Domain Name') }}</b> :</label>--}}
{{--                            <label  class="col-sm-5 control-label"  > <b>{{ _i('Domain Url') }}</b> :</label>--}}
{{--                            <label for="email" class="col-sm-3 control-label"><b>{{ _i('Membership') }}</b> :</label>--}}
{{--                        </div>--}}
{{--                        @php--}}
{{--                        $stores = \App\StoreData::where('owner_id' ,$user['id'])->get();--}}
{{--                        @endphp--}}
{{--                        @foreach($stores as $item)--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="email" class="col-sm-4 control-label"><a target="_blank" href="{{ ($item['domain']) }}" style="color: black;">{{ ($item['title']) }}</a></label>--}}
{{--                                <label  class="col-sm-5 control-label"><a target="_blank" href="{{ ($item['domain']) }}"> {{ ($item['domain']) }}</a></label>--}}
{{--                                @php--}}
{{--                                    $membership = \App\Models\Membership\Membership::join('memberships_data','memberships_data.membership_id','memberships.id')--}}
{{--                                            ->select(['memberships.id as id','memberships_data.title','memberships_data.lang_id'])--}}
{{--                                                ->where('memberships_data.lang_id', getLang(session('lang')))--}}
{{--                                            ->first();--}}
{{--                                @endphp--}}
{{--                                <label  class="col-sm-3 control-label">--}}
{{--                                    <a style="color: #13866f !important" target="_blank" href="{{ url('master/membership/'.$membership->id.'/edit') }}">--}}
{{--                                        <b>{{ ($membership['title']) }}</b>--}}
{{--                                    </a></label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

                    </form>

                </div>

            </div>
        </div>

    </div>


@endsection


