@extends('admin.layout.master', [
'title' => _i('Articles'),
'subtitle' => "Articles",
'breadcrumb' => [_i('Articles')]
])

@section('content')
    <div class="row">
        <div class="col-sm-12 mbl">
            <span class="pull-left">
                 <a href="{{ url("admin/panel/article/create") }}" target="_blank" class="btn btn-info">
                     <i class="fa fa-plus"></i>{{ _i('create new article') }}
                 </a>
            </span>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">{{ _i('Articles List') }}</h3>
        </div>
        <div class="box-body">
            <table id="article_table" class="table table-striped table-hover va-middle" >
                <thead>
                <tr>
                    <th> {{_i('ID')}}</th>
                    <th> {{_i('Title')}}</th>
                    <th> {{_i('Category')}}</th>
                    <th> {{_i('Language')}}</th>
                    <th> {{_i('Image')}}</th>
                    <th> {{_i('Status')}}</th>
                    <th> {{_i('Action')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script  type="text/javascript">
        $(function() {
            $('#article_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/article/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'lang_id', name: 'lang_id'},
                    {data: 'img_url', name: 'img_url'},
                    {data: 'published', name: 'published'},
                    {data: 'delete', name: 'delete'},
                ]
            });
        });
    </script>
@endpush