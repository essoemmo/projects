@extends('admin.layout.master', [
'title' => _i('Article Category'),
'subtitle' => "Article Category",
'breadcrumb' => [_i('Article Category')]
])

@section('content')

    <div class="flash-message">
        @if(Session::has('danger'))
            <p class="alert alert-danger  text-center dangerMessage "> <b> {{ Session::get('danger') }} </b></p>
        @endif
    </div>


    <div class="row">
        <div class="col-sm-12 mbl">
            <span class="pull-left">
                 <a href="{{url('admin/panel/artcle_category/create')}}" target="_blank" class="btn btn-info">
                     <i class="fa fa-plus"></i>{{ _i('create new article category') }}
                 </a>

{{--                 @foreach($langs as $lang)--}}
{{--                    <a href="{{ url('admin/translation/' . $translation->id . '?lang=' . $lang->id ) }}" target="_blank">--}}
{{--                        <button class="dt-button btn btn-warning"  type="button">--}}
{{--                            <span><i class="fa fa-globe"></i> {{_("To")}} {{ $lang->name }}</span>--}}
{{--                        </button>--}}
{{--                    </a>--}}
{{--                 @endforeach--}}

            </span>
        </div>



    </div>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">{{ _i('Article Category List') }}</h3>
        </div>
        <div class="box-body">
            <table id="article_cats_table" class="table table-striped table-hover va-middle" >
                <thead>
                <tr>
                    <th > {{_i('ID')}}</th>
                    <th > {{_i('Title')}}</th>
                    <th > {{_i('Language')}}</th>
                    <th > {{_i('Image')}}</th>
                    <th > {{_i('Status')}}</th>
                    <th > {{_i('Action')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@push('js')
    <script  type="text/javascript">
        $(function() {
            $('#article_cats_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/artcle_category/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'lang_id', name: 'lang_id'},
                    {data: 'img_url', name: 'img_url'},
                    {data: 'published', name: 'published'},
                    {data: 'delete', name: 'delete'},
                ]
            });
        });

    </script>
@endpush
