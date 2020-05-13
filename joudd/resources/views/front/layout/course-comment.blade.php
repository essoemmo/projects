
<div class="add-comment wide-title-box">
    <div class="title"> {{_i('Leave your comment')}} </div>

    <div class="wide-box-content-wrapper">
        <div class="course-register-form">
            <form action="{{url('/course_comment/'.$course_id)}}"  method="POST" data-parsley-validate="">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="field">
                            <input type="text" class="form-control" name="name" id="FirstName" required=""
                                   maxlength="150"	data-parsley-maxlength="150" minlength="3" data-parsley-minlength="3"
                                   placeholder="{{_i('Your Name')}}" value="{{auth()->user() ? auth()->user()->first_name ." ".auth()->user()->last_name : old('name') }}">
                            <label for="FirstName">{{_i('Name')}}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field">
                            <input type="text" class="form-control" name="email" id="Email" required=""
                                   data-parsley-type="email" maxlength="100" data-parsley-maxlength="100"
                                   placeholder="example@domain.com" value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                            <label for="Email"> {{_i('Email')}}</label>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="field">
                                  <textarea rows="6" class="form-control" name="message" id="comment_txt" required=""
                                            minlength="10" data-parsley-minlength="10"
                                            placeholder="{{_i('Write Your Comment Here')}}">{{old('message')}}</textarea>
                            <label for="comment_txt">{{_i('Comment')}}</label>
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    <input type="submit" class="btn register-btn" value="{{_i('Send Comment')}}">
                </div>
            </form>
        </div>

    </div>
</div>