@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Seo Setting')}}
@endsection


@section('content')

    @php

        $input = route('storeSiteMap',app()->getLocale());

        // remove www
        $domain = preg_replace('#^https?://#', '', rtrim($input,'/'));

    @endphp

    {{--    Store settings--}}
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Seo Settings')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Settings')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h5>{{ _i('Seo Settings') }}</h5>
                    </div>
                    <div class="card-block">
                        <div class="wrapper">
                            <form action="{{ route('seo.storeSetting') }}" method="post" class="j-forms" id="j-forms"
                                  novalidate="">

                                @csrf

                                <div class="content">
                                    <div class="divider-text gap-top-20 gap-bottom-45">
                                        <span>{{ _i('SEO') }}</span>
                                    </div>

                                    <input type="hidden" name="item_id"
                                           value="{{ \App\Bll\Utility::getSetting()->id }}">

                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label" for="title">{{ _i('Title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="title" name="meta_title" class="form-control"
                                                   placeholder="{{ _i('HomePage Title') }}"
                                                   value="{{ \App\Bll\Utility::storeSeo(session()->get('StoreId'),\App\Bll\Utility::getSetting()->id,get_class(\App\Bll\Utility::getSetting()))->meta_title ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label"
                                            for="description">{{ _i('Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea name="meta_description" id="description" cols="30"
                                                      rows="30" style="height: 100px"
                                                      placeholder="{{ _i('HomePage Description') }}">{{ \App\Bll\Utility::storeSeo(session()->get('StoreId'),\App\Bll\Utility::getSetting()->id,get_class(\App\Bll\Utility::getSetting()))->meta_description ?? '' }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="divider-text gap-top-45 gap-bottom-45">
                                        <span>{{ _i('Sitemap') }}</span>
                                    </div>
                                    <div class="j-row">
                                        <div class="span9 unit" style="width: 100% !important;">
                                            <div class="input row">
                                                <a href="#" class="copy" title="{{ _i('Copy SiteMap URL') }}"
                                                   data-clipboard-action="copy"
                                                   data-clipboard-text="{{ request()->getScheme()}}://{{\App\Bll\Utility::getStoreDomain()}}.{{ $domain }}">
                                                    <label class="icon-right" for="input">
                                                        <i class="fa fa-edit"></i>
                                                    </label>
                                                </a>
                                                <input type="text" disabled id="input"
                                                       placeholder="placeholder text"
                                                       value="{{ request()->getScheme()}}://{{\App\Bll\Utility::getStoreDomain()}}.{{ $domain }}">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="footer">
                                    <button type="submit"
                                            class="btn btn-primary text-center m-b-0">{{ _i('Save') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--Store settings--}}

@endsection


@push('js')

    <script>
        //copy url of product
        var clipboard = new ClipboardJS('.copy');

        // console.log(ClipboardJS.isSupported());

        clipboard.on('success', function (e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{_i("Copied Url Successfully")}}',
                showConfirmButton: false,
                timer: 5000
            });

            e.clearSelection();
        });
    </script>

@endpush


