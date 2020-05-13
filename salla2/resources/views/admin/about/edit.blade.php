@extends('admin.AdminLayout.index')

@section('title')
    {{_i('about')}}
@endsection

@section('page_header_name')
    {{_i('about')}}
@endsection

@section('page_url')

@endsection


@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            {{--<h3 class="box-title"> {{_i('User Form')}}</h3>--}}
        </div>
        <!-- /.box-header -->
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>

        @endif
        <form method="post" action="{{route('about.update',$about->id)}}" class="form-horizontal">
            @csrf
            {{method_field('put')}}
            <div class="box-body">
                <div style="background-color: #f2f2f2; padding: 20px;">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{$about->title}}">
                    </div>

                    <div class="form-group">
                        <label>descrption</label>
                        <textarea type="text" name="descrption" class="form-control" >
                            {{$about->descrption}}
                        </textarea>
                    </div>


{{--                    <div class="form-group">--}}
{{--                        <label>Store</label>--}}
{{--                        <select name="store_id" class="form-control">--}}
{{--                            <option value="">all Store</option>--}}
{{--                            @foreach(DB::table('stores')->get() as $store)--}}
{{--                                <option value="{{$store->id}}" {{$store->id == $about->store_id ? 'selected':''}}>{{$store->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info "> {{ _i('Edit') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>


@endsection

@section('footer')
    {{--    <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>--}}
    {{--    <script src="{{asset('admin/ckeditor.js')}}"></script>--}}


@endsection