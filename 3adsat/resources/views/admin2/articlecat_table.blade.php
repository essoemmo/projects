@extends('admin2.layout.index')

@section('content')

    <div class="row">

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5> Article Categories </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>

                <div class="card-block">
                    <div class="dt-responsive table-responsive text-center">
                        <table id="article_cats_table" class="table table-striped table-bordered nowrap text-center">
                            <thead >
                            <tr>
                                <th class="text-center"> {{_i('ID')}}</th>
                                <th class="text-center"> {{_i('Title')}}</th>
                                <th class="text-center"> {{_i('Language')}}</th>
                                <th class="text-center"> {{_i('Image')}}</th>
                                <th class="text-center"> {{_i('Status')}}</th>
                                <th class="text-center"> {{_i('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>




                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- Zero config.table end -->
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
