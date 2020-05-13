@extends('admin.layout.index',[
'title' => _i('Customer Reports'),
'activePageName' => _i('Customer Reports'),
] )

@push('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

@endpush

@section('content')
<div class="row">

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5> {{ _i('Customer Reports') }} </h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>
            </div>
            <div class="card-block">

                <div class="row">
                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-sm-4 col-form-label" for="start_date">{{ _i('Start Date') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" name="start_date" id="start_date" placeholder="{{ _i('Start Date') }}" class="form-control datepicker">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-sm-4 col-form-label" for="end_date">{{ _i('End Date') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" name="end_date" id="end_date" placeholder="{{ _i('End Date') }}" class="form-control datepicker">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <br>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label class="col-sm-4 col-form-label" for="country_id">{{ _i('Country') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" id="country_id" name="country_id">
                                <option></option>
                                @foreach ($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2" >
                    <button type="text" id="btnFiterSubmitSearch" class="btn btn-info" style="margin-top: 35px">{{ _i('Search') }}</button>
                </div>

            </div>
            <hr>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped" id="list-table">
                    <thead>
                    <tr>
                        <th>{{_i('Customer Name')}}</th>
                        <th>{{_i('Email')}}</th>
                        <th>{{_i('Orders Number')}}</th>
                        <th>{{_i('Products Number')}}</th>
                        <th>{{_i('Country')}}</th>
                        <th>{{_i('Total')}}</th>
                        <th>{{_i('Show')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>

        $('.datepicker').datepicker();

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btnFiterSubmitSearch').click(function(){
                $('#list-table').DataTable().draw(true);
            });

            oTable = $('#list-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url('/admin/panel/customerOrderReport/dt') !!}',
                    type: 'GET',
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.country_id = $('#country_id').val();
                        d.order_status_id = $('#order_status_id').val();
                    }
                },
                columns: [
                    { data: 'customerName', name: 'customerName', orderable: true, searchable: true },
                    { data: 'email', name: 'email', orderable: true, searchable: true },
                    { data: 'orderCount', name: 'orderCount', orderable: true, searchable: true },
                    { data: 'productCount', name: 'productCount', orderable: true, searchable: true },
                    { data: 'countryName', name: 'countryName', orderable: true, searchable: true },
                    { data: 'orderTotal', name: 'total', searchable: false },
                    { data: 'show', name: 'show', searchable: false },
                ]
            });
        });
    </script>

@endpush
