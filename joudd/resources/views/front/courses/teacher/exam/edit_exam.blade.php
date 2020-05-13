@extends('front.layout.app')


@section('content')
    <div class="flash-message text-center">
        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-info" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>

    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">
            <div class="box box-info">

                    <div class="box-header with-border">
                        <h3 class="box-title"> {{_i('Course Information')}} </h3>
                        <br>
                        <br>
                        <div>
                            <label class="col-md-2 control-label">{{$course->title}}</label>

                            <label class="col-md-1 control-label">{{_i('Start :')}}</label>
                            <label class="col-md-2 control-label">{{$course->start_date}}</label>

                            <label class="col-md-1 control-label">{{_i('End :')}}</label>
                            <label class="col-md-3 control-label">{{$course->end_date}}</label>

                            <label class="col-md-1 control-label">{{_i('Duration')}}</label>
                            <label class="col-md-2 control-label">{{$course->duration}}</label>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form method="POST" action="{{ url('/user/course/course_exam/' . $exam->id . '/update') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf


                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#en"  data-toggle="tab" >
                                                <button type="button" class="btn  btn-blue btn-lg " >{{_i('EN')}}</button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#ar"  data-toggle="tab" >
                                                <button type="button" class="btn  btn-blue btn-lg " >{{_i('AR')}}</button>
                                            </a>
                                        </li>

                                    </ul>
                                </div>


                                <div class="tab-content">

                                    <div class="tab-pane active" id="en">
                                        <br />

                                        <!-- ============================================= Title ============================= -->
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 control-label">{{ _i('Title') }}</label>

                                            <div class="col-md-10">

                                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="en_title" value="{{ $exam_data_en->title }}" placeholder="{{ _i('Title') }}" required="">
                                                @if ($errors->has('title'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('title') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- ============================================= Description ============================= -->
                                        <div class="form-group row">
                                            <label for="name" class="col-md-2 control-label">{{ _i('Description') }}</label>

                                            <div class="col-md-10">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="en_description" placeholder="{{ _i('Description') }}" required=""
                                    >{{ $exam_data_en->description }}</textarea>
                                                @if ($errors->has('description'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('description') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <!-- ============================================= arabic section ============================= -->

                                    <div class="tab-pane" id="ar">
<br />
                                        <!-- ============================================= Title ============================= -->
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 control-label">{{ _i('Title') }}</label>

                                            <div class="col-md-10">

                                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="ar_title" value="{{ $exam_data_ar->title }}" placeholder="{{ _i('Title') }}" required="">
                                                @if ($errors->has('title'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('title') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- ============================================= Description ============================= -->
                                        <div class="form-group row">
                                            <label for="name" class="col-md-2 control-label">{{ _i('Description') }}</label>

                                            <div class="col-md-10">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="ar_description" placeholder="{{ _i('Description') }}" required=""
                                    >{{ $exam_data_ar->description }}</textarea>
                                                @if ($errors->has('description'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('description') }}</strong>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            <!-- ============================================= duration ============================= -->
                            <div class="form-group row">
                                <label for="name" class="col-md-2 control-label">{{ _i(' Duration :') }}</label>

                                <div class="col-md-10">
                                    <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ $exam->duration }}" placeholder=" Duration" required="">

                                    @if ($errors->has('duration'))
                        <strong  style="color: #db1b4c;">{{ $errors->first('duration') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <!-- ============================================= sart date ============================= -->
                            <div class="form-group row">
                                <label for="name" class="col-md-2 control-label"> {{_i(' Start Date :')}} </label>

                                <div class="col-md-10">
                                    <input type="date" name="start" class="form-control" value="{{ $exam->start }}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                                    @if($errors->has('start_date'))
                                        <strong  style="color: #db1b4c;">{{$errors->first('start_date')}}</strong>
                                    @endif
                                </div>
                            </div>

                            <!--========================================== end Date =======================================-->
                            <div class="form-group row">

                                <label for="name" class="col-md-2 control-label"> {{_i(' End Date :')}} </label>

                                <div class="col-md-10">
                                    <input type="date" name="end" class="form-control" value="{{ $exam->end }}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                                    @if($errors->has('end_date'))
                                        <strong  style="color: #db1b4c;">{{$errors->first('end_date')}}</strong>
                                    @endif
                                </div>
                            </div>

                            <!----==========================  published ==========================--->
                            <!-- iCheck -->

                            <!-- checkbox -->
                            <div class="form-group row" >

                                <label class="col-md-1 col-form-label" for="checkbox">
                                    {{_i('Publish')}}
                                </label>
                                <div class="col-md-6 col-form-label">

                                    <label>
                                        <input @if($exam->is_active == 1) checked @endif  type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1">
                                    </label>

                                </div>

                            </div>

                            <hr>

                            <div id="two-row" class="{{(count($question_check) == 0) ? '':'hidden'}}">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="question_en">{{ _i('English Question') }}</label>
                                        <input type="text" name="question_en[]" id="question_en" class="form-control" value="" @if(count($question_check) == 0) required="" @else disabled @endif>
                                        @if($errors->has('question_en'))
                                            <strong  style="color: #db1b4c;">{{$errors->first('question_en')}}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="question_ar">{{ _i('Arabic Question') }}</label>
                                        <input type="text" name="question_ar[]" id="question_ar" class="form-control" value="" @if(count($question_check) == 0) required="" @else disabled @endif>
                                        @if($errors->has('question_ar'))
                                            <strong  style="color: #db1b4c;">{{$errors->first('question_ar')}}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="score">{{ _i('Score') }}</label>
                                        <input type="text" name="score[]" id="score" class="form-control" value="" @if(count($question_check) == 0) required="" @else disabled @endif>
                                        @if($errors->has('score'))
                                            <strong  style="color: #db1b4c;">{{$errors->first('score')}}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="score">{{ _i('Answer') }}</label>
                                        <select data-live-search="true" title="Choose one of the following..." class="choice form-control{{ $errors->has('is_answer') ? ' is-invalid' : '' }}" name="is_answer[]">
                                            <option selected disabled>{{ _i('Choose one of the following...') }}</option>
                                            <option value="1"> {{ _i('True') }}</option>
                                            <option value="2"> {{ _i('False') }}</option>

                                            @if ($errors->has('is_answer'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('is_answer') }}</strong>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @if(count($question_check) > 0)

                                @foreach($exam_questions as $item)

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="question_en">{{ _i('English Question') }}</label>
                                            <input type="text" name="question_en[]" class="form-control" value="{{ $item->en_title }}" required="">
                                            @if($errors->has('question_en'))
                                                <strong  style="color: #db1b4c;">{{$errors->first('question_en')}}</strong>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_ar">{{ _i('Arabic Question') }}</label>
                                            <input type="text" name="question_ar[]" class="form-control" value="{{ $item->ar_title }}" required="">
                                            @if($errors->has('question_ar'))
                                                <strong  style="color: #db1b4c;">{{$errors->first('question_ar')}}</strong>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label for="score">{{ _i('Score') }}</label>
                                            <input type="text" name="score[]" class="form-control" value="{{ $item->score }}" required="">
                                            @if($errors->has('score'))
                                                <strong  style="color: #db1b4c;">{{$errors->first('score')}}</strong>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label for="answer">{{ _i('Answer') }}</label>
                                            <select data-live-search="true" title="Choose one of the following..." class="choice form-control{{ $errors->has('is_answer') ? ' is-invalid' : '' }}" name="is_answer[]">
                                                <option selected disabled>{{ _i('Choose one of the following...') }}</option>
                                                <option hidden value="{{ $item->id }}" class="question_id">{{ _i('Choose one of the following...') }}</option>
                                                @if($question_choice == null)
                                                    <option class="title" value="1"> {{ _i('True') }}</option>
                                                    <option class="title" value="2"> {{ _i('False') }}</option>
                                                @else
                                                    <option class="title" @if($question_choice->is_answer == 1) selected @endif value="1"> {{ _i('True') }}</option>
                                                    <option class="title" @if($question_choice->is_answer == 2) selected @endif value="2"> {{ _i('False') }}</option>
                                                @endif

                                                @if ($errors->has('is_answer'))
                                            <strong  style="color: #db1b4c;">{{ $errors->first('is_answer') }}</strong>
                                                @endif
                                            </select>
                                        </div>
                                        {{--                            <input id="question_id" type="hidden" value="{{ $item->id }}" name="question_id">--}}
                                    </div>

                                @endforeach

                            @endif

                            <div class="new-two">

                            </div>

                            <div style="margin-bottom: 15px">
                                <a href="javascript:void(0)" onclick="myJsFunc();" class="btn btn-success data-click">{{ _i('Add More') }}</a>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">{{ _i('Save') }}</button>
                            </div>
                            <!-- /.box-footer -->

                        </form>

                </div>

            </div>

        </div>

    </div>
    </div>

@endsection

@push('js')

    <script>
        function myJsFunc() {

            var newInput = $('#two-row').clone(false).removeAttr('class');
            $(newInput).find('#question_en').removeAttr('disabled');
            $(newInput).find('#question_ar').removeAttr('disabled');
            $(newInput).find('#score').removeAttr('disabled');
            $('.new-two').append(newInput);
        }

        $(function () {
            $('.choice').on('change', function () {
                var choice = $(this).val();
                var question_id = $(this).children('.question_id').val();
                console.log(question_id);
                if(choice == 1) {
                    title = "true"
                } else {
                    title = "false"
                }
                // console.log(choice,title,question_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url('/admin/choice_change') }}',
                    type: 'post',
                    data: {choice: choice,title: title,question_id: question_id},
                    success:function (res) {
                        console.log(res);
                        if(res == true) {
                            Swal.fire({
                                position: 'top-end',
                                type: 'error',
                                title: "{{ _i('Already Checked') }}",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } if (res == false) {
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: "{{ _i('Added Successfully') }}",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                })
            });
        })

    </script>


@endpush