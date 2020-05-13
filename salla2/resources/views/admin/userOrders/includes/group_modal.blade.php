<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addGroup" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ _i('Add Group') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="add_form" class="j-pro" enctype="multipart/form-data" data-parsley-validate=""
                      style="box-shadow:none; background: none">

                    @csrf

                    <div class="j-unit">
                        <div class="j-input">
                            <label class="j-icon-left" for="title">
                                <i class="icofont icofont-ui-check"></i>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Title" required>
                        </div>
                        <span class="text-danger">
                                <strong id="title-error"></strong>
                            </span>
                    </div>

                    <div class="j-unit">
                        <div class="j-input j-append-big-btn">
                            <label class="j-icon-left" for="file_input">
                                <i class="icofont icofont-download"></i>
                            </label>
                            <div class="j-file-button">
                                {{ _i('Browse') }}
                                <input type="file" name="icon"
                                       onchange="document.getElementById('file_input').value = this.value;">
                            </div>
                            <input type="text" id="file_input" readonly="" placeholder="no file selected">
                            <span class="j-hint">{{ _i('Only: jpg / png / doc, less 1Mb') }}</span>
                        </div>
                    </div>

                    <div>
                        <label for="users"></label>
                        <select name="users[]" multiple class="selectpicker form-control" id="users" required>
                            <option disabled>{{ _i('Select') }}</option>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                                @endforeach
                            @else
                                {{ _i('NO Users') }}
                            @endif
                        </select>
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

        .j-pro .j-primary-btn, .j-pro .j-file-button, .j-pro .j-secondary-btn {
            background: #1abc9c;
        }

        .j-pro .j-primary-btn:hover, .j-pro .j-file-button:hover, .j-pro .j-secondary-btn:hover {
            background: #1abc9c;
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
