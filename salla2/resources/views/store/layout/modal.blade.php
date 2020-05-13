<!-- Login modal -->
<div class="modal fade" id="loginModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset('login.png')}}" style="width: 150px;
    position: relative;
    right: 160px;
    padding: 15px;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="    position: relative;
    top: 140px;
    right: 65px;">{{_i('Login')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store_login' ,app()->getLocale())}}" method="post" id="login_form"
                  data-parsley-validate="">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group">
                        <lable>{{_i('email')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" required="" class="form-control" name="email"
                                   placeholder="{{_i('Email@email.com')}}" aria-label="email"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('password')}}</lable>
                        <div class="input-group mb-3 myPassword">
                            <div class="input-group-prepend showPassword">
                                <span class="input-group-text" id="basic-addon1"
                                      title="{{_i('Click to show or hide Password')}}">
                                    <i class="fa fa-eye"></i></span>
                            </div>
                            <input type="password" required="" class="form-control pwd " name="password"
                                   placeholder="{{_i('password')}}" aria-label="email" aria-describedby="basic-addon1"
                                   style="width: 65%">
                        </div>
                        {{--                    <input type="email" class="form-control" name="email" placeholder="{{_i('Email@email.com')}}">--}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">{{_i('login')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Register form--}}

<!-- Login modal -->
<div class="modal fade" id="registerModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset('login.png')}}" style="width: 150px;
    position: relative;
    right: 160px;
    padding: 15px;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="    position: relative;
    top: 140px;
    right: 51px;">{{_i('Register')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store_register' ,app()->getLocale())}}" method="post" id="register_form"
                  data-parsley-validate="">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group">

                        <lable>{{_i('first name')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" required="" class="form-control" name="name"
                                   placeholder="{{_i('first name')}}" aria-label="first name"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('last name')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" required="" class="form-control" name="lastname"
                                   placeholder="{{_i('last name')}}" aria-label="first name"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('email')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend ">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" required="" class="form-control" name="email"
                                   placeholder="{{_i('Email@email.com')}}" aria-label="email"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('password')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend showPassword">
                                <span class="input-group-text" id="basic-addon1"
                                      title="{{_i('Click to show or hide Password')}}"><i class="fa fa-eye"></i></span>
                            </div>
                            <input type="password" required="" class="form-control pwd" name="password"
                                   placeholder="{{_i('password')}}" aria-label="passsword"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('password_confirmation')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend showPassword">
                                <span class="input-group-text" id="basic-addon1"
                                      title="{{_i('Click to show or hide Password')}}"><i class="fa fa-eye"></i></span>
                            </div>
                            <input type="password" required="" class="form-control pwd" name="password_confirmation"
                                   placeholder="{{_i('password_confirmation')}}" aria-label="password_confirmation"
                                   aria-describedby="basic-addon1" style="width: 65%">
                        </div>

                        <lable>{{_i('phone')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="number" required="" class="form-control" name="phone"
                                   placeholder="{{_i('phone')}}" aria-label="phone" aria-describedby="basic-addon1"
                                   style="width: 65%">
                        </div>

                        <label for="gender">{{_i('Gender')}}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <select name="gender" class="form-control" required id="gender">
                                <option value="0">{{ _i('Male') }}</option>
                                <option value="1">{{ _i('female') }}</option>
                            </select>
                        </div>

                        <lable>{{_i('address')}}</lable>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-text-width"></i></span>
                            </div>
                            <textarea type="text" required="" class="form-control" name="address"
                                      placeholder="{{_i('Enter Your Address...')}}" aria-label="phone"
                                      aria-describedby="basic-addon1" style="width: 65%"></textarea>
                        </div>
                        {{--                    <input type="email" class="form-control" name="email" placeholder="{{_i('Email@email.com')}}">--}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">{{_i('Register')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('js')
    <script>
        $('body').on('click', '.showPassword', function () {
            var $pwd = $(".pwd");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });
    </script>
@endpush
