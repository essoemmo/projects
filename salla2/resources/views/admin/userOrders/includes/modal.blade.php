<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="sendSms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ _i('Send SMS') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            @if($user->image != null)
                                <img class="media-object img-circle comment-img" style="width: 55px;height: 55px"
                                     src="{{ asset($user->image) }}" alt="{{ $user->name }}">
                            @else
                                <img class="media-object img-circle comment-img" style="width: 55px;height: 55px"
                                     src="{{ asset('images/articles/personal_NoImage.jpg') }}" alt="{{ $user->name }}">
                            @endif
                        </div>

                        @php

                            $number =  $user->phone;
                            $masked =  str_pad(substr($number, -4), strlen($number), '*', STR_PAD_LEFT);

                        @endphp
                        <div class="media-body">
                            <div class="user_name">
                                <h6 class="media-heading" style="font-weight: bold">{{ $user->name }}</h6>
                            </div>
                        </div>
                        <div class="media-right">
                            <div class="user_phone">
                                <a href="tel:+{{ $masked }}">
                                    {{ $masked }}
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>

                <hr>

                <form id="add_form" class="j-pro" enctype="multipart/form-data" data-parsley-validate=""
                      style="box-shadow:none; background: none">

                    @csrf
                    <div class="j-content">
                        <div class="j-unit">
                            <div class="j-input">
                                <label class="j-icon-left" for="message">
                                    <i class="icofont icofont-file-text"></i>
                                </label>
                                <textarea placeholder="{{ _i('Message Text') }}" spellcheck="false" id="message"
                                          name="message"></textarea>
                                <span
                                    class="j-tooltip j-tooltip-right-top">{{ _i('Describe your Message as detailed as possible') }}</span>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ _i('Close') }}</button>
                <button type="submit" form="add_form" class="btn btn-primary">{{ _i('Send') }}</button>
            </div>
        </div>
    </div>
</div>

@push('css')

    <link rel="stylesheet" href="{{asset('AdminFlatAble/pages/j-pro/css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('AdminFlatAble/pages/j-pro/css/j-pro-modern.css')}}">

    <style>

        .j-pro {
            border: none;
        }

        .j-pro input[type="text"]:focus, .j-pro input[type="password"]:focus, .j-pro input[type="email"]:focus, .j-pro input[type="search"]:focus, .j-pro input[type="url"]:focus, .j-pro textarea:focus, .j-pro select:focus {
            border: #1abc9c solid 2px !important;
        }

        .j-pro input[type="text"]:hover, .j-pro input[type="password"]:hover, .j-pro input[type="email"]:hover, .j-pro input[type="search"]:hover, .j-pro input[type="url"]:hover, .j-pro textarea:hover, .j-pro select:hover {
            border: #1abc9c solid 2px !important;
        }

        .card .card-header span {
            color: #fff;
        }

        .j-pro .j-tooltip, .j-pro .j-tooltip-image {
            background-color: #1abc9c;
        }

        .j-pro .j-tooltip-right-top:before {
            border-color: #1abc9c transparent;
        }
    </style>

    <script src="{{asset('AdminFlatAble/pages/j-pro/js/jquery.2.2.4.min.js')}}"></script>
    <script src="{{asset('AdminFlatAble/pages/j-pro/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('AdminFlatAble/pages/j-pro/js/jquery.j-pro.js')}}"></script>

@endpush
