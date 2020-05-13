
@extends('admin.index')
@section('title', $title)
@section('css')

@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{_i($title)}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="{{route('setting-member-update',$editSetting->id)}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>{{_i('member ship')}}</label>
                                    <select name="user_id" class="form-control selectpicker">
                                        @foreach(\App\Models\User::where('guard','!=','admin')->get() as  $membership)
                                            <option value="{{$membership->id}}" {{$editSetting->user_id == $membership->id ? 'selected' : ''}} >{{$membership->username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="optionmember">


                                        <div class="row options">

                                            @foreach($data as $dat)
                                                @if($dat->type == 0 )
                                                    <div class="col-md-12">
                                                        <label style="background: #ddd;padding: 11px;width: 200px;">{{_i('Normal user')}}</label>
                                                    </div>
                                                @elseif($dat->type == 1)
                                                    <div class="col-md-12">
                                                        <label style="background: #ddd;padding: 11px;width: 200px;">{{_i('The matchmaker')}}</label>
                                                    </div>
                                                @endif

                                                @foreach(json_decode($dat->json_data) as $da)
                                                    <div class="col-md-4">
                                                        <div class="">
                                                            <label>{{_i($da)}}</label>
                                                            <input type="checkbox" name="options[]" class="" value="{{$da}}" {{in_array($da,$options) ? "checked":"" }}>
                                                        </div>
                                                        <br>
                                                    </div>

                                                @endforeach
                                            @endforeach

                                        </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm">{{(_i('edit'))}}</button>
{{--                                    <button class="btn btn-warning pull-left btn-sm" id="newOption">{{_i('new option')}}</button>--}}

                                </div>
                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@push('js')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('#newOption').on('click',function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $('.optionmember').append(`--}}

{{--                <div class="row options">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="">--}}
{{--                                       <label>{{_i('name ')}}</label>--}}
{{--                                           <input type="text" name="options[]" class="form-control">--}}
{{--                                        </div>--}}
{{--                                        <br>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="">--}}
{{--                                            <button class="btn btn-danger del" style="margin-top: 31px;">{{_i('delete')}}</button>--}}
{{--                                        </div>--}}
{{--                                        <br>--}}
{{--                                    </div>--}}

{{--                                </div>--}}


{{--                `);--}}

{{--            });--}}

{{--            $('body').on('click','.del',function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $(this).closest('.row').remove();--}}
{{--            })--}}

{{--        })--}}
{{--    </script>--}}
@endpush
