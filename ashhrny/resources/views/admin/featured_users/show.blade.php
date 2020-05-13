@extends('admin.layout.index',[
'title' => _i('Show Advertisement'),
'activePageName' => _i('Show Advertisement'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Show Advertisement') }}</h5>
        </div>
        <div class="card-block">
            {{--            {!! Form::open(['route' => 'featured_users.update', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}--}}
            <form action="{{route('featured_users.update',$id)}}" method="POST" class="j-forms" data-parsley-validate>
                @csrf
                {{method_field('put')}}
                @honeypot {{--prevent form spam--}}

                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('Show Advertisement Details') }}</span>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-2 control-label">{{ _i('User')  }} :</label>
                        <div class="col-sm-4">
                            <label class="col-sm-10 control-label">
                                <b><a href="">{{ $users['first_name'] ." ". $users['last_name']}}</a></b>
                            </label>
                        </div>

                        <label class="col-sm-2 control-label">{{ _i('Place') }} :</label>
                        <div class="col-sm-4">
                            <label
                                class="col-sm-10 control-label"><b>{{ $advertise_details['featured_type']}}</b></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Price') }} :</label>
                        <div class="col-sm-4">
                            <label class="col-sm-10 control-label"><b>{{ $advertise_details['price']}} {{_i('SR')}} </b></label>
                        </div>

                        <label class="col-sm-2 control-label">{{ _i('Total') }} :</label>
                        <div class="col-sm-4">
                            <label class="col-sm-10 control-label"><b>{{ $advertise_details['total']}} {{_i('SR')}} </b></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Duration') }} :</label>
                        <div class="col-sm-10">
                            <label
                                class="col-sm-10 control-label"><b>{{ $advertise_details['duration']}} {{_i('Hour')}}</b></label>
                        </div>
                    </div>

                    <br/>
                    <br/>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('From') }} :</label>
                        <div class=" col-sm-10">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="from" required=""/>
                                <span class="input-group-addon sm-default">
                                            <span class="icofont icofont-ui-calendar"></span>
                                         </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('To') }} :</label>
                        <div class=" col-sm-10">
                            <div class='input-group date' id='datetimepicker4'>
                                <input type='text' class="form-control" name="to" required=""/>
                                <span class="input-group-addon sm-default">
                                            <span class="icofont icofont-ui-calendar"></span>
                                        </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="checkbox-fade fade-in-primary">
                            <label>
                                <input id="published_check" @if($advertise_details->publish == 1) checked
                                       @endif type="checkbox" name="publish" value="1">
                                <span class="cr float-right">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                <span class="mr-4">{{ _i('Publish') }}</span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit"
                                    class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

