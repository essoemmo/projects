@extends('admin.index')
@section('title', $title)
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    {{--    @include('admin.layouts.message')--}}
    <!-- /.box-header -->
        <div class="card-body table-responsive">
{{--                <button class="btn btn-primary create" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i>{{_i('create new memberShip')}}</button>--}}
{{--            <a href="{{route('memberships-details.create')}}" class="btn btn-primary create"><i class="fa fa-plus"></i>{{_i('create new')}}</a>--}}
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>



@endsection
@push('js')

        {!! $dataTable->scripts() !!}>
    <script>
        $(document).ready(function () {
            var table = $('.dataTable').DataTable();
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });

            $('body').on('submit','#addForm',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('memberships.store')}}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        if (response.errors){
                            $('#masages_model1').empty();
                            $.each(response.errors, function( index, value ) {
                                $('#masages_model1').show();
                                $('#masages_model1').append(value + "<br>");
                            });
                        }
                        if (response == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added is Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();
                            $('#masages_model1').hide();
                            $modal = $('#create');
                            $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');
                var cost = $(this).data('cost');
                var years = $(this).data('years');
                var lang = $(this).data('lang');

                var html = `

                <form action="{{route('edit-membership')}}"  method="post" id="formedit" data-parsley-validate="">
                    @csrf
                        {{method_field('put')}}
                    <input type="hidden" name="id" value="${id}" class="form-control">
                         <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" id="lang_ax" class="form-control">
                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)

                    <option value="{{$key}}">{{$lang}}</option>

                                    @endforeach
                    </select>
                      <div class="form-group">
                            <label>{{_i('title')}}</label>
                          <input type="text" name="name" class="form-control" value="${name}" data-parsley-required="true">
                        </div>


                </div>

                </form>`;
                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang).change();


            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })

            $('body').on('submit','#formedit',function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        if (response.errors){
                            $('#masages_model').empty();
                            $.each(response.errors, function( index, value ) {

                                $('#masages_model').show();
                                $('#masages_model').append(value + "<br>");
                            });
                        }
                        if (response == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added is Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();
                            $('#masages_model').hide();
                            // $modal = $('#create');
                            // $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

            $('body').on('submit','#delform',function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                // alert(url);

                $.ajax({
                    url: url,
                    method: "delete",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {

                        table.ajax.reload();
                        if (response[0] === 'SUCCESS'){
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            // table.ajax.reload();
                        }
                        // console.log(response);
                        // window.location.reload();
                    }
                });
            })

        })
    </script>
@endpush
