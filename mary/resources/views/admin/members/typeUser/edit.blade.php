
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
                    <h3 class="card-title">
                        {{_i($title)}}
                            - {{$editSetting->type == 0 ? _i('Normal user'):_i('The matchmaker')}}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="{{route('type-member-update',$editSetting->id)}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

{{--                                <div class="form-group">--}}
{{--                                    <label>{{_i('member ship')}}</label>--}}
{{--                                    <select name="type" class="form-control selectpicker">--}}
{{--                                        <option value="" disabled selected>{{_i('Choose...')}}</option>--}}
{{--                                        <option value="0" {{$editSetting->type == 0 ? 'selected': ''}}>{{_i('Normal user')}}</option>--}}
{{--                                        <option value="1" {{$editSetting->type == 1 ? 'selected': ''}}>{{_i('The matchmaker')}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}


                                <div class="optionmember">

                                        <div class="row options">

                                            @foreach($codes as $indexx =>$code)

                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label>{{$code}}</label>
                                                        <input type="checkbox" name="options[]" {{in_array($code,$options) ? "checked": ''}} value="{{$code}}">
                                                    </div>
                                                    <br>
                                                </div>


                                            @endforeach


                                        </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm">{{(_i('edit'))}}</button>
{{--                                    <button class="btn btn-warning pull-left btn-sm" id="newOption">{{_i('edit option')}}</button>--}}

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
    <script>
        $(function () {
            $('#newOption').on('click',function (e) {
                e.preventDefault();
                $('.optionmember').append(`

                <div class="row options">
                                <div class="col-md-6">
                                    <div class="">
                                       <label>{{_i('name ')}}</label>
                                           <input type="text" name="options[]" class="form-control">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <button class="btn btn-danger del" style="margin-top: 31px;">{{_i('delete')}}</button>
                                        </div>
                                        <br>
                                    </div>

                                </div>


                `);

            });

            $('body').on('click','.del',function (e) {
                e.preventDefault();
                $(this).closest('.row').remove();
            })

        })
    </script>
@endpush
