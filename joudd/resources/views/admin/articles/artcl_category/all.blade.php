@extends('admin.layout.layout')

@section('title')
    {{_i('Article Category')}}
@endsection

@section('box-title' )
    {{_i('Countries')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Article Category')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/artcle_category/create')}}">{{_i('Add')}}</a></li>
            <li ><a href="{{url('/admin/artcle_category/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')


    <div class="box box-info">

        <div class="box-header">

            <div class="dt-buttons" style="padding-right: 330px;">
                  @foreach($langs as $lang)
                <a href="{{ url('admin/translation/' . $translation->id . '?lang=' . $lang->id ) }}" target="_blank">
                    <button class="dt-button btn btn-default"  type="button">
                        <span><i class="fa fa-globe"></i> {{_("To")}} {{ $lang->title }}</span>
                    </button>
                </a>
                @endforeach
                <a href="{{url('admin/artcle_category/create')}}" target="_blank">
                    <button class="dt-button btn btn-default"  type="button"  >
                        <span><i class="fa fa-plus"></i> {{_i('create new article category')}} </span>
                    </button>
                </a>
                {{--                <button class="dt-button buttons-print btn btn-primary" tabindex="0" aria-controls="dataTableBuilder" type="button">--}}
                {{--                    <span><i class="fa fa-print"></i></span>--}}
                {{--                </button>--}}
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="article_cats_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting text-center"  > {{_i('ID')}}</th>
                                <th class="sorting_desc text-center" > {{_i('Title')}}</th>
                                <th class="sorting_desc text-center" > {{_i('Language')}}</th>
                                <th class="sorting_desc center"  > {{_i('Image')}}</th>
                                <th class="sorting_desc center"  > {{_i('Status')}}</th>
                                <th class="sorting_desc center"  > {{_i('Action')}}</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>



@endsection

@section('footer')
    <script  type="text/javascript">

        $(function() {
            $('#article_cats_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/artcle_category/datatable')}}',
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
@endsection
