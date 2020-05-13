@extends('admin.index')
@section('title', $title)
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            @if(auth()->user()->can('member-Add'))
            <a href="{{route('members.create')}}" class="btn btn-primary "><i class="fa fa-plus"></i>{{_i('create Members')}}</a>
            @endif
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('send massege')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modeldata">
{{--                    <form action="{{route('send-messageUser')}}" method="post" style="display: none;margin-top: 27px;" id="mass">--}}
{{--                        {{csrf_field()}}--}}
{{--                        {{method_field('post')}}--}}
{{--                        <input type="hidden" name="to" value="{{$user->id}}">--}}
{{--                        <input type="hidden" name="from" value="{{auth()->user()->id}}">--}}
{{--                        <div class="massege">--}}
{{--                            <textarea class="form-control" name="messge"></textarea>--}}
{{--                        </div>--}}

{{--                        <input type="submit" class="btn btn-info btn-sm" value="send">--}}
{{--                    </form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="save">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        $('body').on('click','#comment',function (e) {
            e.preventDefault();

            var to = $(this).data('to');
            var fro = $(this).data('from');
            var username = $(this).data('username');


                    @if(\Illuminate\Support\Facades\Auth::check())
            var html = `
                <h3>{{_i('send massege to')}} ${username}</h3>
            <form action="{{route('send-messageUser')}}" method="post" id="mass">
                                    {{csrf_field()}}
                            {{method_field('post')}}
                    <input type="hidden" name="from" value="${fro}">
            <input type="hidden" name="to" value="${to}">

                        <textarea rows="5"  name="messge" class="form-control"></textarea>

                            </form>`;

            @else
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "{{_i('Sorry you should Login')}}",
                timeout: 2000,
                killer: true
            }).show();

            @endif

            $('#modeldata').empty();
            $('#modeldata').append(html);

        });

        $('body').on('click','#save',function () {
            $('#mass').submit();
        })
    </script>

    @endpush
