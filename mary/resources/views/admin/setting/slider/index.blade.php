@extends('admin.index')


@section('content')

    @if(auth()->user()->can('slider-add'))
        <button class="btn btn-info btn-sm pull-left" id="add-slider" data-toggle="modal" data-target="#exampleModal">{{_i('add slider')}}</button>

    @endif

    <div class="table-responsive" id="SliderTable">
        <table class="table table-bordered table-striped dataTable text-center" id="slider_table">

        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('add-Slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('slider-store')}}" method="post" id="form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" class="form-control">

                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                    <option value="{{$key}}">{{$lang}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="from-group">
                            <label>{{_i('title')}}</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>


                        <div class="from-group">
                            <label>{{_i('Descrption')}}</label>
                            <textarea type="text" name="desc" class="form-control">{{old('desc')}}</textarea>
                        </div>

                        <div class="from-group">
                            <label>{{_i('Image')}}</label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="from-group">
                            <img src="" class="image-preview" style="width: 300px">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="submit">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('edit-Slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edited">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="submitedit">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('#slider_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/slider/get_datatable')}}',
                columns: [
                    {data: 'title', title: '{{_i('title')}}'},
                    {data: 'image', title: '{{_i('image')}}'},
                    // {data: 'created_at', title: 'created_at'},
                    {data: 'action', title: 'edit', orderable: true, searchable: true},
                    {data: 'delete', title: 'delete', orderable: true, searchable: true}

                ]
            });
            $('body').on('click','#submit',function () {
                $('#form').submit();
            });

            $('body').on('click','#edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var desc = $(this).data('desc');
                var image = $(this).data('image');
                var lang = $(this).data('lang');


                var html = `<form action="{{route('slider-update')}}" method="post" id="formEdit" enctype="multipart/form-data">
                       {{csrf_field()}}
                        {{method_field('put')}}
                    <input type="hidden" name="id" value=${id}>
                         <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" class="form-control" id="lang_ax">

                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                    <option value="{{$key}}">{{$lang}}</option>
                                @endforeach
                    </select>

                </div>
               <div class="from-group">
                   <label>{{_i('title')}}</label>
                           <input type="text" name="title" class="form-control" value="${title}">
                       </div>


                       <div class="from-group">
                           <label>{{_i('Descrption')}}</label>
                           <textarea type="text" name="desc" class="form-control">${desc}</textarea>
                       </div>

                       <div class="from-group">
                           <label>{{_i('Image')}}</label>
                           <input type="file" name="image" class="form-control image">
                       </div>
                       <div class="from-group">
                           <img src="${image}" class="image-preview" style="width: 300px">
                       </div>

                   </form>`;
                $('#edited').empty();

                $('#edited').append(html);
                $('#lang_ax').val(lang);

            })

            $('body').on('click','#submitedit',function () {
                $('#formEdit').submit();
            });

        })
    </script>

@endsection