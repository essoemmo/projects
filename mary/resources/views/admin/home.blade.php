@extends('admin.index')
@section('content')


    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{_i('online User')}}</span>
                        <span class="info-box-number">
                  <?php  $onlineUser = \App\Models\User_activity::with('user')
                                ->where('status','=','online')
                                ->count() ?>
                  <small>{{$onlineUser}}</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <canvas id="myChart" width="200" height="200"></canvas>

            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{_i('registered user')}}</span>
                        <?php   $latestmember = \App\Models\User::count(); ?>
                        <span class="info-box-number">{{$latestmember}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <canvas id="myChart2" width="200" height="200"></canvas>

            </div>
            </div>
            <!-- /.col -->
    </div><!--/. container-fluid -->


    <?php

    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
        ->get();
    $users = \Illuminate\Support\Facades\DB::table('users')
        ->get();

    ?>


    <!-- STACKED BAR CHART -->

@endsection
@section('footer')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['male', 'Female'],
                datasets: [{
                    label: '',
                    data: [{{$male}},{{$female}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>


        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:  [

{{--                    @php--}}
{{--                        $country = \Illuminate\Support\Facades\DB::table('nationalies_data')->get();--}}
{{--                    @endphp--}}

{{--                    @foreach ($country as $us)--}}
{{--                    @php--}}
{{--                        $user = \App\Models\User::where('resident_country_id',$us->id)->get();--}}
{{--                    @endphp--}}

{{--                    @foreach ($user as $usss)--}}
{{--                    @php--}}
{{--                        $coun = \Illuminate\Support\Facades\DB::table('nationalies_data')->where('id',$usss->resident_country_id)->first();--}}
{{--                    @endphp--}}
{{--                        @foreach($coun->toArray() as $coooo)--}}
{{--                        '{{ str_replace(' ',',',$coun->county_name)}}',--}}

{{--                @endforeach--}}


{{--                    @endforeach--}}


{{--                    @endforeach--}}

                            @foreach($countyname->toArray() as $count)
                    '{{ str_replace(' ',',',$count->county_name)}}',
                    @endforeach

                ],
                datasets: [{
                    label: '',
                    data: [

                        @php
                        $country = \Illuminate\Support\Facades\DB::table('nationalies_data')->get();
                        @endphp

                        @foreach ($country as $us)
                            @php
                                $user = \App\Models\User::where('resident_country_id',$us->id)->count();
                            @endphp
                        {{$user}},
                        @endforeach


                    ],
                    backgroundColor: [
                        @foreach($countyname->toArray() as $count)
                            'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',

                        @endforeach

                    ],
                    borderColor: [
                        @foreach($countyname->toArray() as $count)
                            'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        @endforeach

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>


@endsection
