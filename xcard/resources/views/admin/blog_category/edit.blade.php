@extends('admin.layout.index',[
'title' => _i('Edit Blog Categories'),
'activePageName' => _i('Edit Blog Categories'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit blog category') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::model($blog_category,['route' => ['blog_categories.update',$blog_category->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('edit blog category') }}</span>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-12">

                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                        <div class="slide"></div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content card-block">
                                @foreach($langs as $lang)
                                    <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}" role="tabpanel" aria-expanded="false">
                                        <div class="clone-leftside-btn-2 cloneya-wrap">
                                            <div class="unit toclone-widget-left toclone cloneya">
                                                <div class="input">
                                                    <input type="text" value="{{ $blog_category->translate($lang->locale)->title }}" placeholder="{{ $lang->title }} {{ _i('Title') }}" name="{{ $lang->locale }}_title" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-sm-12">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <span class="col-sm-3">{{_i('Main')}}</span>
                                        <span class="col-sm-2"></span>
                                        <input type="checkbox" name="main" value="1" {{$blog_category->main == 1 ? 'checked' : ''}} id="main_checked">
                                        <span class="cr float-right">
                                             <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                    </label>
                                </div>
                                <input type="hidden" id="row_id" value="{{$blog_category->id}}" > <!---- get id of row -->
                                <div class="error" style="display: none"  id="main_error">
                                    <br />
                                    <div class="alert alert-danger">
                                        {{ _i('Main is checked before if you want this make other not checked') }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

    <script>
        $(function () {
            'use strict';
            $("#main_checked").on('click', function () {
                var rowID = $("#row_id").val();
                //$('.error').css("display","none");
                // $('.empty').css("display","block");
                $.ajax({
                    url: "{{aUrl('mainChecked')}}",
                    type:'get',
                    DataType:'json',
                    data:{rowId: rowID},

                    success:function (res) {
                        if(res != 0) {
                            $('#main_error').css("display", "block");
                            $('#main_checked').prop("checked", false);
                        }
                    }
                })
            })
        });
    </script>

@endpush
