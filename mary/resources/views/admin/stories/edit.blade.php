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
                            <form action="{{route('Stories.update',$story->id)}}" method="post" >
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>{{_i('male partner')}}</label>
                                    <select name="user_id" class="form-control">
                    <option value="" selected disabled>{{_i('choose')}}</option>
                                        @foreach(\App\Models\User::where('guard','!=','admin')->where('gender','male')->pluck('username','id')->all() as $key =>$val)
                                            <option value="{{$key}}" {{$story->user_id == $key ? 'selected' : ''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('female partener')}}</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="" selected disabled>{{_i('choose')}}</option>

                                        @foreach(\App\Models\User::where('guard','!=','admin')->where('gender','female')->pluck('username','id')->all() as $key =>$val)
                                            <option value="{{$key}}"  {{$story->Partner_id == $key ? 'selected' : ''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card card-primary card-outline card-tabs">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            @foreach($langs as $index => $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link {{$index == 0 ? 'active': '' }}" id="custom-tabs-two-home-tab" data-toggle="pill" href="#{{$lang->code}}" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">{{$lang->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            @foreach($langs as $index => $lang)
                                                    @if(in_array($lang->id ,$storyLang))
                                                        @foreach($stories as $storyy)
                                                            @if($storyy->lang_id == $lang->id)
                                                            <input type="hidden" name="lang_id[]" value="{{$lang->id}}"  class="form-control">

                                                            <div class="tab-pane {{$index == 0 ? 'active': '' }}" id="{{$lang->code}}" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                            <div class="form-group">
                                                                <label>{{_i('title')}}</label>
                                                                <input type="text" name="{{$lang->code}}_title" value="{{$storyy->title}}" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{{_i('content')}}</label>
                                                                <textarea name="{{$lang->code}}_conteent" class="form-control ckeditor">{{$storyy->content}}</textarea>
                                                            </div>
                                                        </div>
                                                              @endif
                                                    @endforeach
                                                    @endif
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
{{--                                @dd($story->type)--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>{{_i('place')}}</label>
                                    </div>
                                    <div class="col-md-6">
{{--                                        @dd($story)--}}
                                        <lablel>{{_i('inside')}}</lablel>
{{--                                        @dd($story->type)--}}
                                        <input type="radio" name="type"  value="inside" {{$story->type == 'inside' ? 'checked' : ''}}>
                                    </div>
                                    <div class="col-md-6">
                                        <lablel>{{_i('outside')}}</lablel>
                                        <input type="radio" name="type" value="outside" {{$story->type == 'outside' ? 'checked' : ''}}>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>{{_i('published')}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="publish" {{$story->published == 'true' ? 'checked' : ''}}>

                                    </div>


                                </div>

                                <input type="submit" class="btn btn-info btn-sm" value="{{_i('save')}}">

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
{{--        $(document).ready(function () {--}}


{{--            $('body').on('change','#lang',function () {--}}

{{--                var id = $(this).val();--}}

{{--                $.ajax({--}}
{{--                    url: '{{ route('getlangarticl') }}',--}}
{{--                    method: "get",--}}
{{--                    --}}{{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
{{--                    data: { id: id},--}}
{{--                    success: function (response) {--}}
{{--                        // console.log(response.data[1]['title']);--}}
{{--                        $('#category').empty();--}}
{{--                        for (var i=0 ; i< response.data.length ; i++){--}}
{{--                            // console.log(response.data[i].id);--}}
{{--                            $('#category').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');--}}

{{--                        }--}}
{{--                        // $('#group_ax').val(group);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}


{{--            $('#lang').trigger('change');--}}
{{--        });--}}


{{--    </script>--}}

@endpush
