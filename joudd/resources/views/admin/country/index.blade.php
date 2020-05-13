@extends('admin.layout.layout')

@section('title')

    {{_i('Countries')}}

@endsection


@section('box-title' )
    {{_i('Countries')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Countries')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/country/create')}}">{{_i('Add')}}</a></li>
            <li ><a href="{{url('/admin/country/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')



    <div class="box box-info">

          <div class="box-header">

              <div class="dt-buttons" style="padding-right: 330px;">
                  <?php 
                  $langs = App\Language::all();
                  $translation = App\Model\Translation::where("table_name","countries")->first();
                  if($translation !=null){
                  ?>
                  @foreach($langs as $lang)
                <a href="{{ url('admin/translation/' . $translation->id . '?lang=' . $lang->id ) }}" target="_blank">
                    <button class=" btn btn-default"  type="button">
                        <span><i class="fa fa-globe"></i> {{_("To")}} {{ $lang->title }}</span>
                    </button>
                </a>
                @endforeach
               
                  <?php } ?>
                 <a href="{{url('admin/country/create')}}" target="_blank">
                    <button class=" btn btn-success"  type="button"  >
                        <span><i class="fa fa-plus"></i> {{_i('create new country')}} </span>
                    </button>
                </a>
            </div>
       

          
        </div>

        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="country_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting text-center"  > {{_i('ID')}}</th>
                                <th class="sorting_desc text-center" > {{_i('Title')}}</th>
                                <th class="sorting_desc text-center" > {{_i('Language')}}</th>
                                <th class="sorting_desc center"  > {{_i('Logo')}}</th>
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
            $('#country_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/country/datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'lang_id', name: 'lang_id'},
                    {data: 'logo', name: 'logo'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
        
        {{--function newCountry() {--}}
        {{--    window.location.assign("{{url('admin/country/create')}}");--}}
        {{--}--}}

    </script>

@endsection