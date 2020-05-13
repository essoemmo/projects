@extends('admin.layout.layout')

@section('title')
    {{_i('Edit Group')}}
@endsection


@section('box-title' )
    {{_i('Edit Group')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Edit Group')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/groups/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form   action="{{url('/admin/groups/update')}}"  method="POST" class="form-horizontal"  data-parsley-validate="">

                @csrf
                <input type="hidden" name="id" value="{{$group['id']}}">
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Group Name')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{$group['title']}}"  required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Description')}} </label>
                        <div class="col-xs-6">
                            <textarea type="text" name="description"  class="form-control">{{$group['description']}}</textarea>

                        </div>
                    </div>


                    <!-- ================================== users =================================== -->
                    <div class="form-group " >
                        <label class="col-xs-2 col-form-label " for="get_country">
                            {{_i('Users')}} </label>
                        <div class="col-xs-6">
                            <select multiple required="" id="users_selected" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="users_id[]" >
                                <option disabled> {{_i('Choose')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"
                                    @foreach($users_group as $item) {{$item->user_id == $user->id ? 'selected' : '' }}
                                            @endforeach> {{$user['first_name'].' '.$user['last_name']}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>


@endsection

@section('footer')
    <script>


        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

@endsection
