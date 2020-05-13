@extends('admin.AdminLayout.index')

@section('title')
    {{ _i('Account Control') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Account control') }}</h5>
        </div>
        <div class="card-block">

            <div class="card-body  ">



                    <div class="form-group row show_stop_div" @if($is_stopped != null) style="display: none" @endif>
                        <label class="col-sm-12 control-label store_pause" style="color: #f44336 !important;">
                            <i class="icofont icofont-ui-pause"></i> <strong>{{_i('Stopping the subscription Temporarily')}}</strong>
                        </label>

                        <label class="col-sm-12 text-muted">
                            {{_i('Stopping the subscription will temporarily disable the benefits of the package for a maximum period of 30 days')}}
                        </label>
                    </div>

                    <div class="form-group row show_resume_div" @if($is_stopped == null) style="display: none" @endif>
                        <label class="col-sm-12 control-label store_activate" style="color: #5dd5c4 !important;">
                            <i class="icofont icofont-check-circled"></i> <strong>{{_i('Resume subscription')}}</strong>
                        </label>

                        <label class="col-sm-12 text-muted">
                            {{_i('Stopping the subscription will temporarily disable the benefits of the package for a maximum period of 30 days')}}
                        </label>
                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-sm-12 control-label delete_store" style="color: #f44336 !important;">
                            <i class="icofont icofont-trash"></i> <strong>{{_i('Delete Store')}}</strong>
                        </label>

                        <label class="col-sm-12 text-muted">
                            {{_i('Store data will be permanently deleted')}}
                        </label>
                    </div>




            </div>



        </div>
    </div>




@endsection

@push('js')

    <script>
        $('body').on('click','.store_pause',function () {

            Swal.fire({
                title: "{{_i('Warning')}}",
                text: "{{_i('All features of the package will be disabled, given that the maximum period of suspension is 30 days, and the subscription can be stopped twice a year only')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5dd5c4',
                cancelButtonColor: 'rgb(136, 136, 136)',
                confirmButtonText: '{{_i('Confirm')}}'
            }).then((result) => {
                if (result.value) {
                    $(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var store = "{{\App\Bll\Utility::getStoreId()}}";
                        $.ajax({
                            url: "{{url('adminpanel/accountControl/change')}}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                status: 0,
                                store: store
                            },
                            success: function (res) {
                                console.log(res);
                                if(res == true){
                                    Swal.fire(
                                        '',
                                        "{{_i('subscription Stopped Temporarily')}}",
                                        'success'
                                    );
                                    $('.show_stop_div').hide();
                                    $('.show_resume_div').show();
                                }else{

                                    Swal.fire({
                                        icon: 'error',
                                        title: '{{_i('Oops...')}}',
                                        text: '{{_i('The subscription cannot be stopped more than twice a year')}}',
                                        //footer: '<a href>Why do I have this issue?</a>'
                                    })
                                }
                            }
                        });

                    });

                }
            })

        });
        // //store_activate

        $('body').on('click','.store_activate',function () {

            Swal.fire({
                title: "{{_i('Warning')}}",
                text: "{{_i('The remainder of the subscription will be resumed starting today')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5dd5c4',
                cancelButtonColor: 'rgb(136, 136, 136)',
                confirmButtonText: '{{_i('Confirm')}}'
            }).then((result) => {
                if (result.value) {
                    $(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var store = "{{\App\Bll\Utility::getStoreId()}}";
                        $.ajax({
                            url: "{{url('adminpanel/accountControl/change')}}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                status: 1,
                                store: store
                            },
                            success: function (res) {
                                if(res == true){
                                    Swal.fire(
                                        '',
                                        "{{_i('Subscription resumed')}}",
                                        'success'
                                    );
                                    $('.show_stop_div').show();
                                    $('.show_resume_div').hide();
                                }
                            }
                        });

                    });

                }
            })

        });

        $('body').on('click','.delete_store',function () {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '{{ _i('This Feature Is Coming Soon') }}',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>

@endpush