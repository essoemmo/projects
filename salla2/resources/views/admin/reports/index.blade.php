@extends('admin.AdminLayout.index')

@section('title')
{{_i('All Reports')}}
@endsection

@section('page_header_name')
{{_i('All Reports')}}
@endsection


@section('content')


<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('Reports')}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">{{_i('Reports')}}</a>
            </li>
        </ul>
    </div>
</div>


<div class="page-body">

    <div class="row">
        <div class="col-md-12 mb-3">

                <div class="dropdown-inverse dropdown open mr-3">
                    <select id="type-report" name="type-report" class="form-control form-control-primary">
                        <option value="all">{{_i('All')}}</option>
                        <option value="day">{{_i('Daily')}}</option>
                        <option value="week">{{_i('Weekly')}}</option>
                        <option value="month">{{_i('Monthly')}}</option>
                        <option value="year">{{_i('Yearly')}}</option>
                    </select>
                </div>

                <form method="post" id="day" action="{{route('reports.index')}}" >
                    @csrf
                <div id="report-day" class="dropdown-inverse dropdown open day report mr-3">
                    {{Form::date('date', \Carbon\Carbon::today(),['class' => 'form-control mr-sm-2 mb-sm-0','id' => 'date'])}}
                    <input type="submit" class="btn btn-primary waves-effect waves-light ml-3" value="Submit">
                </div>
                </form>


                <form method="post" id="week" action="{{route('reports.index')}}">
                    @csrf
                <div id="report-week" class="dropdown-inverse dropdown open week report">
                    <select id="week" name="week" class="form-control form-control-primary">
                        <option value="1"> {{_i('current week')}} ({{Carbon\Carbon::now()->startOfWeek()->format('Y/m/d')}} / {{Carbon\Carbon::now()->endOfWeek()->format('Y/m/d')}})</option>
                        <option value="2"> {{_i('last week')}} ({{\App\Bll\Utility::LastWeek()[0]}} / {{\App\Bll\Utility::LastWeek()[1]}})</option>
                    </select>

                    <input type="submit" class="btn btn-primary waves-effect waves-light ml-3" value="Submit">
                </div>
            </form>

            <form method="post" id="month" action="{{route('reports.index')}}">
                @csrf
                <div id="report-month" class="dropdown-inverse dropdown open month report">
                    <div class="row">
                    <div class="report-filter-month mr-2">
                        <select id="month" name="month" class="form-control form-control-primary">
                            @foreach (\App\Bll\Utility::allMonths() as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="report-month-year">
                        <select id="month_year" name="month_year" class="form-control form-control-primary">
                            @foreach (\App\Bll\Utility::allyears() as $key => $value)
                            <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                        </select>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary waves-effect waves-light ml-3" value="Submit">
                </div>
            </form>

            <form method="post" id="year" action="{{route('reports.index')}}">
                @csrf
                <div id="report-year" class="dropdown-inverse dropdown open year report">
                    <select id="year" name="year" class="form-control form-control-primary">
                        @foreach (\App\Bll\Utility::allyears() as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary waves-effect waves-light ml-3" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Sales')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>{{_i('All Sales')}}</td>
                                    <td class="total">
                                           {{ $orders_total->sum('total') }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>{{_i('Proudct Costs')}}</td>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <td>{{_i('Shipping')}}</td>
                                    <td class="ship_cost">{{ $orders_ship_cost->sum('shipping_cost') }}</td>
                                </tr>

                                <tr>
                                    <td>{{_i('Taxs')}}</td>
                                    <td>----</td>
                                </tr>

                                <tr>
                                    <td>{{_i('Electronic payment fees')}}</td>
                                    <td>-----</td>
                                </tr>

                                <tr>
                                    <td>{{_i('earning')}}</td>
                                    <td>----</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>

        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Orders')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <span class="report-big-number ordercount">{{ $orders_count->count() }}</span>
                                    <span class="report-sub-text">{{_i('order')}}</span>
                                </tr>
                            </tbody>
                        </table>

                        <canvas id="Chart" width="280" height="280"></canvas>

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('clints')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <span class="report-big-number clint">{{ $clints->count() }}</span>
                                    <span class="report-sub-text">{{_i('clint')}}</span>
                                </tr>
                            </tbody>
                        </table>

                        <div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>

        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Countries')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        {{-- <div class="listcardes"> --}}
                        <ul class="scroll-list cards" style="margin-right: 70px;">

                            @foreach ($countries as $count)
                            <li>
                                <h6>{{ $count->title}}</h6>
                            </li>
                            @endforeach
                        </ul>

                        {{-- </div> --}}

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('visits')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <span class="report-big-number vistors">{{ $visitors->count() }}</span>
                                    <span class="report-sub-text">{{_i('visit')}}</span>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>

        {{--  <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Clint Satisfaction')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <span class="report-big-number">80%</span>
                                    <span class="report-sub-text">{{_i('Satisfied')}}</span>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>  --}}
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Best Seller')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">

                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    @foreach ( $best_products as $item)
                                    <td>{{ $item->name }}</td>
                                    @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Best Clints Payment')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    @foreach ( $best_paymant as $item)
                                    <td>{{ $item->userName }}</td>
                                    @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>

        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Best Clints Ordered')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    @foreach ( $best_clints as $item)
                                    <td>{{ $item->user_name }}</td>
                                    @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Payment way')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">

                        <ul class="scroll-list cards" style="margin-right: 70px;">

                            @foreach ($transaction_types as $tranc)
                            <li>
                                <h6>{{ $tranc->title}}</h6>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>

        <div class="col-md-6">
            <!-- round card start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Shipping Companies')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row users-card">
                        <ul class="scroll-list cards" style="margin-right: 70px;">

                            @foreach ($shippingcompanies as $comp)
                            <li>
                                <h6>{{ $comp->title}}</h6>
                            </li>
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>
            <!-- Round card end -->
        </div>
    </div>

    @endsection

    @push('js')
    <script>
        $(document).ready(function(){
    $("#type-report").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".report").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".report").hide();
            }
        });
    }).change();
});
    </script>

 <script>
    $('body').on('submit', '#day', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{route('DayFilter')}}',
            method: "post",
            "_token": "{{ csrf_token() }}",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('.total').text(response.orders_total);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ordercount').text(response.orders_count);
                    $('.clint').text(response.clints);
                    $('.vistors').text(response.visitors);

                    new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('This data for your day')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                }
            },
        });

    })
</script>

 <script>
    $('body').on('submit', '#week', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{route('WeekFilter')}}',
            method: "post",
            "_token": "{{ csrf_token() }}",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('.total').text(response.orders_total);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ordercount').text(response.orders_count);
                    $('.clint').text(response.clints);
                    $('.vistors').text(response.clints);
                    new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('This data for your week')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                }
            },
        });

    })
</script>

 <script>
    $('body').on('submit', '#month', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{route('MonthFilter')}}',
            method: "post",
            "_token": "{{ csrf_token() }}",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('.total').text(response.orders_total);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ordercount').text(response.orders_count);
                    $('.clint').text(response.clints);
                    $('.vistors').text(response.clints);
                    $('.vistors').text(response.clints);

                    new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('This data for your Month')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                }
            },
        });

    })
</script>


 <script>
    $('body').on('submit', '#year', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{route('YearFilter')}}',
            method: "post",
            "_token": "{{ csrf_token() }}",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('.total').text(response.orders_total);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ship_cost').text(response.orders_ship_cost);
                    $('.ordercount').text(response.orders_count);
                    $('.clint').text(response.clints);
                    $('.vistors').text(response.clints);

                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('This data for your Year')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }
            },
        });

    })
</script>
@endpush
