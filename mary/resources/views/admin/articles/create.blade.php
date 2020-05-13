@extends('admin.index')
@section('title', $title)
@section('content')


    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form action="{{route('articles.store')}}" method="post" id="addForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('post')}}


                                <div class="form-group">
                                    <label>{{_i('language')}}</label>
                                    <select name="language" class="form-control" id="lang">

                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                            <option value="{{$key}}">{{$lang}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>{{_i('title')}}</label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group row" >

                                    <label class="col-xs-2 col-form-label " for="date">
                                        {{_i('Date')}} </label>
                                    <div class="col-xs-6">
                                        <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{old('created')}}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('published')}}</label>
                                    <input type="checkbox" name="published">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('Category')}}</label>
                                    <select class="form-control select2" style="width: 100%;" name="category" id="category">
{{--                                        @foreach(\App\Models\Artcl_category::get() as $category)--}}
{{--                                            <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('Image')}}</label>
                                    <input type="file" name="image" class="form-control image">
                                </div>

                                <img src="" style="width: 100%; height: 200px" class="image-preview">

                                <div class="form-group">
                                    <label>{{_i('content')}}</label>
                                    <textarea  name="conteent" class="form-control ckeditor"></textarea>
                                </div>
                    <input type="submit" class="btn btn-info btn-sm">
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
        $(document).ready(function () {


            $('body').on('change','#lang',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('getlangarticl') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#category').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#category').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');

                        }
                        // $('#group_ax').val(group);
                    }
                });
            });


            $('#lang').trigger('change');
        });


    </script>

    @endpush
