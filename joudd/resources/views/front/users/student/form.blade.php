  
      <form action="{{url('signUp/store')}}" method="post" data-parsley-validate="" class="register-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="applicant" name="type">
                          
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"  name="firstName" id="firstName" placeholder="{{_i('First Name')}}" maxlength="191"	data-parsley-maxlength="191" required="" value="{{old('firstName')}}">
                                            @if ($errors->has('firstName'))
                                                <span class="text-danger invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('firstName') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control{{ $errors->has('LastName') ? ' is-invalid' : '' }}" name="LastName" id="LastName" placeholder="{{_i('Last Name')}}"
                                               maxlength="100"	data-parsley-maxlength="100" required="" value="{{old('LastName')}}">
                                        @if ($errors->has('LastName'))
                                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('LastName') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1" placeholder="{{_i('E-mail')}}"
                                               name="email" data-parsley-type="email"  data-parsley-maxlength="191" required="" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="password" name="password" type="password" placeholder="{{ _i('Password') }}" class="form-control password"
                                               data-parsley-minlength="8"
                                               data-parsley-errors-container=".errorspannewpassinput"
                                               data-parsley-required-message="Please enter your new password."
                                               data-parsley-uppercase="1"
                                               data-parsley-lowercase="1"
                                               data-parsley-number="1"
                                               data-parsley-special="1"
                                               data-parsley-required />
                                        <span class="errorspannewpassinput"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input name="password_confirmation" id="password2" type="password" placeholder="{{ _i('Password Confirmation') }}" class="form-control password"
                                               data-parsley-minlength="8"
                                               data-parsley-errors-container=".errorspanconfirmnewpassinput"
                                               data-parsley-required-message="Please re-enter your new password."
                                               data-parsley-equalto="#password"
                                               data-parsley-required />
                                        <span class="errorspanconfirmnewpassinput"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <select  class="form-control" name="country_id" required="" style="width:100%" aria-hidden="true" id="Country">
                                            <option value selected disabled>{{_i('Choose Country')}}</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ''}}> {{$country->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address" placeholder="{{_i('Address')}}"
                                               value="{{old('address')}}" data-parsley-equalto="#address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"  placeholder="{{_i('Mobile')}}"
                                               value="{{old('mobile')}}" data-parsley-maxlength="15" required="">
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">{{_i('Upload Personal Image')}}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01" >{{_i('Choose File')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="grade" class="form-control" placeholder="{{_i('Degree')}}">
                                    </div>
                                    <div class="col-md-12">
                                        <select  class="form-control" name="edu_level" style="width:100%" id="educationLevel">
                                            <option value selected disabled>{{_i('Choose Education Level')}}</option>
{{--                                            @foreach($edu_levels as $edu_level)--}}
{{--                                                <option value="{{$edu_level->id}}" {{old('edu_level') == $edu_level->id ? 'selected' : ''}}> {{$edu_level->title}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>

                                    </div>

                                    <div class="login-btn my-3">
                                        <input type="submit" class="btn btn-blue d-block w-100" value="{{_i('Register')}}">
                                        <a href="{{ url('user/login') }}" class="w-100 text-muted small">{{_i('Already have an account?')}}  </a>
                                    </div>


                                </div>
                        


                        </form>
      @push('js')

          <script>

              //loop for education level when click on country
              $('#Country').click(function(){
                  var countryID = $(this).val();
                  //console.log(countryID);
                  if(countryID){
                      $.ajax({
                          type:"GET",
                          url:"{{url('/educationlevel/list')}}?country_id="+countryID,
                          dataType:'json',
                          success:function(res){
                              if(res){
                                  $("#educationLevel").empty();
                                  $("#educationLevel").append('<option disabled>{{ _i('Choose') }}</option>');
                                  $.each(res,function(key,value){
                                      $("#educationLevel").append('<option value="'+key+'">'+value+'</option>');
                                  });

                              }else{
                                  $("#educationLevel").empty();
                              }
                          }
                      });
                  }else{
                      $("#educationLevel").empty();
                  }
              });
          </script>

      @endpush