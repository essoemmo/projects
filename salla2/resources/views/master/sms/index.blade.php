
@extends('master.layout.index',[
'title' => _i('All Sms Reservation'),
'subtitle' => _i('All Sms Reservation'),
'activePageName' => _i('All Sms Reservation'),

] )

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Sms Reservation') }} </h5>
                </div>
                <div class="card-block">

                    {!! $dataTable->table([
                                   'class'=> 'table table-striped table-bordered  dataTable text-center '
                                        ],true) !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! $dataTable->scripts() !!}
@endpush
