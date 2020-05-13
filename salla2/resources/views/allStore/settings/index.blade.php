@extends('admin.AdminLayout.index')

@section('title')
    {{_i('index')}}
@endsection


@section('content')


    <form action="{{url('/adminpanel/settings/store')}}" method="post" class="form-horizontal"
          id="fileupload" enctype="multipart/form-data" data-parsley-validate="">

        @csrf

        <div class="row">
            <div class="card col-md-12">
                <div class="card-header"><h5>{{ _i('store link') }}</h5></div>
                <div class="card-block">
                    <!-- Custom Tabs -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="domain">
                            {{_i('Store Domain')}} </label>
                        <div class="col-sm-6">
                            <input name="domain" value="{{ $store_settings->domain }}" id="domain" class="form-control"
                                   placeholder="{{_i('Store Domain')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('domain'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('domain') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        @if(Auth::guard('store')->user()->hasPermissionTo('domain'))
                            {{--                @if(Auth::user()->hasPermissionTo('domain','store'))--}}
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">{{_i('Edit')}}</button>
                        @endif
                        <button>{{_i('copy')}}</button>
                    </div>

                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>


        <div class="row">
            <div class="card col-md-12">
                <div class="card-header"><h5>{{ _i('store data') }}</h5></div>
                <div class="card-block">
                    <!-- Custom Tabs -->

                    <img class="img-fluid" onclick="document.getElementById('image').click()"
                         src="{{ asset($site_settings->logo) }}" style="width:100px;height:100px;margin: 19px 423px;">
                    <input onchange="document.getElementById('fileupload').submit()" style="display: none;" id="image"
                           type="file" name="logo">


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="title">
                            {{_i('Store Name')}} </label>
                        <div class="col-sm-6">
                            <input name="title" value="{{ $store_settings->title }}" id="title" class="form-control"
                                   placeholder="{{_i('Store Name')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="description">
                            {{_i('Store Description')}} </label>
                        <div class="col-sm-6">
                            <input name="description" value="{{ $site_settings->description }}" id="description"
                                   class="form-control"
                                   placeholder="{{_i('Store Description')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('decription') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="worktime">
                            {{_i('Store Worktime')}} </label>
                        <div class="col-sm-6">
                            <input name="work_time" value="{{ $site_settings->work_time }}" id="work_time"
                                   class="form-control"
                                   placeholder="{{_i('Store Worktime')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('work_time'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('work_time') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>


        <div class="row">
            <div class="card col-md-12">
                <div class="card-header"><h5>{{ _i('technical support') }}</h5></div>
                <div class="card-block">
                    <!-- Custom Tabs -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="phone1">
                            {{_i('phone 1')}} </label>
                        <div class="col-sm-6">
                            <input name="phone1" value="{{ $site_settings->phone1 }}" id="phone1" class="form-control"
                                   placeholder="{{_i('phone 1')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('phone1'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('phone1') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="phone2">
                            {{_i('Phone 2')}} </label>
                        <div class="col-sm-6">
                            <input name="phone2" value="{{ $site_settings->phone2 }}" id="phone2" class="form-control"
                                   placeholder="{{_i('Phone 2')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('phone2'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('phone2') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="email">
                            {{_i('Email')}} </label>
                        <div class="col-sm-6">
                            <input name="email" value="{{ $site_settings->email }}" id="email" class="form-control"
                                   placeholder="{{_i('Website Email')}}" type="email"
                                   data-parsley-type="email">
                            @if ($errors->has('email'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>


        <div class="row">
            <div class="card col-md-12">
                <div class="card-header"><h5>{{ _i('socialmedia sites') }}</h5></div>
                <div class="card-block">
                    <!-- Custom Tabs -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="facebook">
                            {{_i('Facebook')}} </label>
                        <div class="col-sm-6">
                            <input name="facebook_url" value="{{ $site_settings->facebook_url }}" id="facebook"
                                   class="form-control"
                                   placeholder="{{_i('Facebook')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('facebook'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('facebook') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="instagram">
                            {{_i('Instagram')}} </label>
                        <div class="col-sm-6">
                            <input name="instagram_url" value="{{ $site_settings->instagram_url }}" id="instagram"
                                   class="form-control"
                                   placeholder="{{_i('instagram')}}" type="text"
                                   data-parsley-type="text">
                            @if ($errors->has('instagram'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('instagram') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="twitter">
                            {{_i('Twitter')}} </label>
                        <div class="col-sm-6">
                            <input name="twitter_url" value="{{ $site_settings->twitter_url }}" id="twitter"
                                   class="form-control"
                                   placeholder="{{_i('Twtter')}}" type="twitter"
                                   data-parsley-type="twitter">
                            @if ($errors->has('twitter'))
                                <span class="text-danger invalid-feedback">
                        <strong>{{ $errors->first('twitter') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>


        <button type="submit" class="btn btn-info col-md-12">
            {{_i('Save')}}
        </button>

    </form>


    <!-- Modal -->
    <form action="{{url('adminpanel/settings/domain/store')}}" method="post">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{_i('Edit store link')}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab" aria-controls="pills-home"
                                   aria-selected="true">{{ _i('main domain') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                   role="tab" aria-controls="pills-profile"
                                   aria-selected="false">{{ _i('special domain') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                   role="tab" aria-controls="pills-contact"
                                   aria-selected="false">{{ _i('suspend domain') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label " for="domain">
                                        {{_i('Store Domain')}} </label>
                                    <div class="col-sm-6">
                                        <input name="domain" value="{{ $store_settings->domain }}" id="domain"
                                               class="form-control"
                                               placeholder="{{_i('Store Domain')}}" type="text"
                                               data-parsley-type="text">
                                        @if ($errors->has('domain'))
                                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('domain') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit">{{ _i('check availability') }}</button>

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                 aria-labelledby="pills-profile-tab">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label " for="domain">
                                        {{_i('Store Domain')}} </label>
                                    <div class="col-sm-6">
                                        <input name="domain" value="{{ $store_settings->domain }}" id="domain"
                                               class="form-control"
                                               placeholder="{{_i('Store Domain')}}" type="text"
                                               data-parsley-type="text">
                                        @if ($errors->has('domain'))
                                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('domain') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit">{{ _i('check availability') }}</button>

                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                 aria-labelledby="pills-contact-tab">


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label " for="domain">
                                        {{_i('Store Domain')}} </label>
                                    <div class="col-sm-6">
                                        <input name="domain" value="{{ $store_settings->domain }}" id="domain"
                                               class="form-control"
                                               placeholder="{{_i('Store Domain')}}" type="text"
                                               data-parsley-type="text">
                                        @if ($errors->has('domain'))
                                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('domain') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="alert alert-info no-border">
                                        <span
                                            class="text-danger">{{ _i('domain-connect-should-be-to-nameserver') }}</span>
                                        <div class="input-group mt-15">
                                            <input id="nameserver1" type="text" class="form-control right-border"
                                                   value="donald.ns.cloudflare.com" readonly="true">
                                            <span class="input-group-btn">
                        <button class="btn btn-default btn-copy-nameserver" type="button"
                                data-clipboard-target="#nameserver1">{{ _i('copy') }}</button>
                        </span>
                                        </div>
                                        <div class="input-group mt-15 mb-20">
                                            <input id="nameserver2" type="text" class="form-control right-border"
                                                   value="leia.ns.cloudflare.com" readonly="true">
                                            <span class="input-group-btn">
                        <button class="btn btn-default btn-copy-nameserver" type="button"
                                data-clipboard-target="#nameserver2">{{ _i('copy') }}</button>
                        </span>
                                        </div>
                                        <span class="text-grey">{{ _i('change server according to provider') }}:</span>
                                        <ul class="mt-10">
                                            <li><a target="_blank"
                                                   href="http://www.nic.sa/ar/view/sapr110">{{ _i('center') }}
                                                    {{ _i('network info') }}</a></li>
                                            <li><a target="_blank"
                                                   href="https://www.godaddy.com/help/change-nameservers-for-your-domain-names-664">Goddady</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://www.name.com/support/articles/205934547-Changing-Your-Name-Servers">Name.com</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://help.shopify.com/en/manual/domains/add-a-domain/using-existing-domains/transferring-domains">Shopify</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://support.wix.com/en/article/transferring-your-wix-domain-away-from-wix-2477749">Wix</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://support.google.com/domains/answer/3290309?hl=en">Google
                                                    Domains</a></li>
                                            <li><a target="_blank" href="https://my.hostmonster.com/cgi/help/222">HostMonster</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://support.hostgator.com/articles/hosting-guide/lets-get-started/dns-name-servers/how-do-i-change-my-dns-or-name-servers">HostGator</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://my.bluehost.com/cgi/help/222">BlueHost</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://www.namecheap.com/support/knowledgebase/article.aspx/767/10/how-can-i-change-the-nameservers-for-my-domain">NameCheap</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://help.dreamhost.com/hc/en-us/articles/216385417">DreamHost</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://www.enom.com/kb/kb/kb_0086_how-to-change-dns.htm">Enom</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://kb.site5.com/web-hosting/what-are-the-site5-dns-servers/">Site5</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://www.ipage.com/help/article/domain-management-how-to-update-nameservers">iPage</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://mediatemple.net/community/products/dv/204643220/how-do-i-edit-my-domain's-nameservers">MediaTemple</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="http://www.tucowsdomains.com/name-server-dns-changes/how-do-i-change-my-name-servers-dns/">Tucows</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://console.bluemix.net/docs/infrastructure/dns/add-edit-custom-name-servers.html#add-edit-or-delete-custom-name-servers-for-a-domain">Softlayer</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://my.freenom.com/knowledgebase.php?action=displayarticle&amp;id=3">Freenom</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://support.rackspace.com/how-to/rackspace-name-servers/">Rackspace</a>
                                            </li>
                                            <li><a target="_blank"
                                                   href="https://help.1and1.com/domains-c36931/manage-domains-c79822/dns-c37586/use-your-own-name-server-for-a-1and1-domain-a594904.html">1and1</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ _i('close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ _i('Save Changes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(Session::has('flash_message'))
        @push('js')
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "{{Session::get('flash_message')}}",
                    showConfirmButton: false,
                    timer: 2000
                });

            </script>
        @endpush

    @endif
@endsection



@push('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    {{--<script>--}}
    {{--    $(document).ready(function() {--}}
    {{--        $('#example').DataTable();--}}
    {{--    } );--}}
    {{--</script>--}}




    <script>
        $(document).ready(function () {
            $('#sliders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url("/adminpanel/settings/slider/datatable")}}',
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    // {data: 'action', name: 'action', orderable: false, searchable: false}
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });


        $("#sort_order").bind('keyup', function () {
            // console.log($('#sort_order').val() == 5)
            if ($('#sort_order').val() == 5) {
                $('#category').css('display', 'block');
            } else {
                $('#category').css('display', 'none');
            }
        });

        // show slider image
        function showSliderImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#slider_img').attr('src', e.target.result).width(180).height(120);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

        //show slider logo
        function showSliderLogo(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#slider_logo').attr('src', e.target.result).width(180).height(120);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }


        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#setting_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function showOldImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(300).height(250);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#new_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        $(document).ready(function () {
            // For A Delete Record Popup
            $('.remove-record').click(function () {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                $(".remove-record-model").attr("action", url);
                $('body').find('.remove-record-model').append(
                    '<input name="_token" type="hidden" value="' + token + '">');
                $('body').find('.remove-record-model').append(
                    '<input name="_method" type="hidden" value="DELETE">');
                $('body').find('.remove-record-model').append(
                    '<input name="id" type="hidden" value="' + id + '">');
            });
            $('.remove-data-from-delete-form').click(function () {
                $('body').find('.remove-record-model').find("input").remove();
            });
            $('.modal').click(function () {
                // $('body').find('.remove-record-model').find( "input" ).remove();
            });
        });

        $(document).ready(function () {
            // For A Delete Record Popup
            $('.remove-edit').click(function () {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                console.log(id, url, token);
                $(".remove-edit-model").attr("action", url);
                $('body').find('.remove-edit-model').append(
                    '<input name="_token" type="hidden" value="' + token + '">');
                $('body').find('.remove-edit-model').append(
                    '<input name="_method" type="hidden" value="DELETE">');
                $('body').find('.remove-edit-model').append(
                    '<input name="id" type="hidden" value="' + id + '">');
            });
            $('.remove-data-from-delete-form').click(function () {
                $('body').find('.remove-edit-model').find("input").remove();
            });
            $('.modal').click(function () {
                // $('body').find('.remove-edit-model').find( "input" ).remove();
            });
        });

    </script>

    <script>
        $(function () {
            'use strict'
            $('#sliders-table_wrapper').removeClass('form-inline');
        });

    </script>
@endpush
