@extends('admin.AdminLayout.index')
@section('title')
    {{_i('Import New Products')}}
@endsection

@section('page_header_name')
    {{_i('Import New Products')}}
@endsection



@section('content')


    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="text-center text-primary">{{ _i('Import new products') }}</h2>
                    <p class="txt-highlight text-center m-t-20">
                        {{ _i('Follow the steps below to import your products to the store') }}
                    </p>
                </div>
            </div>
            <form action="{{ route('productsImportSave') }}" id="upload_form" method="post" data-parsley-validate=""
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="alert alert-primary row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-round">
                                    1
                                </button>
                            </div>
                            <div class="col-md-8 text-center">
                                <p>{{ _i('Product Import by following form') }}
                                </p>
                                <a href="{{ route('productsImportDownload') }}"
                                   class="btn btn-primary">
                                    <i class="ti-import"></i>
                                    {{ _i('Download the form') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="alert alert-primary row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-round">
                                    2
                                </button>
                            </div>
                            <div class="col-md-8 text-center">
                                <p>{{ _i('Upload form') }}
                                </p>
                                <input type="file" required form="upload_form" name="file_name"
                                       class="btn btn-outline-primary btn-blog">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="alert alert-primary row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-round">
                                    3
                                </button>
                            </div>
                            <div class="col-md-8 text-center">
                                <p>{{ _i('Save') }}
                                </p>
                                <button type="submit" form="upload_form"
                                        class="btn btn-primary">{{ _i('Submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection


