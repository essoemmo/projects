@extends('admin.layout.master')
@section('content')

    <div class="wrap">
        <section class="app-content">

            <h3>اضافة الصلاحيلات</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">الصلاحيات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافة الصلاحيلات</li>
            </ul>

        </section><!-- #dash-content -->
    </div><!-- .wrap -->


    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget p-lg">
                        <form action="{{route('roles.store')}}" method="post" style="padding: 30px">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            @include('admin.layout.message')
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="">nameOfRole</label>
                                    <input type="text" class="form-control" id="" name="name" value="{{old('name')}}"
                                           placeholder=" name">
                                </div>

                                <div class="form-group">
                                    <h3>permissions</h3>
                                    <?php
                                    $models = ['users', 'categories','uploads','reports'];
                                    $maps = ['create', 'read', 'update', 'delete'];


                                    ?>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>model</th>
                                            <th>permissions</th>
                                        </tr>
                                        @foreach($models as $index=>$model)
                                                @if($model == 'reports')
                                                    <?php  $maps = ['read']; ?>
                                                    @endif
                                            <tr>
                                                <td style="width:5%">{{$index+1}}</td>
                                                <td style="width: 15%">{{$model}}</td>
                                                <td>
                                                    <select class="form-control select2" name="permissions[]" multiple>
                                                        @foreach($maps as $index=>$map)
                                                            <option value="{{$map.'_'.$model}}">{{$map}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>


                                <div class="box-footer" style="padding: 50px">
                                    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div>
        </section><!-- #dash-content -->
    </div>


@endsection
