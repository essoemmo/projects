<div class="col-md-4">
    <div class="card user">
        <div class="card-header">
            <h5>{{_i('Client')}} </h5>

            <button class="btn btn-tiffany f-right" data-toggle="modal" data-target="#userorder" type="button">
                <i class="fa fa-edit large"></i> {{_i('Add')}}</button>
        </div>
        <div class="clearfix"></div>
        <div class="card-body position-relative">

                <span class="userIcon">
                    <i class="ti-user"></i>
                </span>

        </div>
    </div>


    <div class="modal fade" ref="userorder" id="userorder" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('clients')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="javascript:void(0)" onclick="addUser()"><i
                                    class="ti-plus"></i> {{_i('Adding new client')}}</a>
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            <input onkeyup="getusersearch(value)" id="search-user" type="text" class="form-control"
                                   placeholder="{{_i('Searching in clients list')}}....">

                            <ul class="list-unstyled search-menu" style="display: none"></ul>

                        </div>
                    </div>
                    <br>

                    <div class="row userdetails">


                    </div>
                    <br/>

                    <div class="row my-4 mx-2">
                        <button class="btn btn-tiffany text-center col-md-4" id="cancel" type="button"
                                onclick="cancelNewUser()" style="display:none;">{{_i('cancel')}}</button>
                        <div class="col-md-4"></div>
                        <button class="btn btn-tiffany text-center col-md-4" id="save-new-user" type="button"
                                onclick="saveNewUser()" style="display:none;">{{_i('save client data')}}</button>
                    </div>

                    <button class="btn btn-tiffany col-md-12" type="button" onclick="saveuser()">{{_i('save')}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

@push('js')
    <script language="javascript">
        {{--        {!! dd(($users)) !!}--}}
            window.allUsers = {!! json_encode($users) !!}

        function getusersearch(value) {
            if (value) {

                window.usersfilters = allUsers.filter(user => {
                    return user.name.match(value);
                });
                var users = $('.search-menu').empty();
                for ($i = 0; $i < usersfilters.length; $i++) {
                    users.append('<li onclick="getuser(' + $i + ')">' + usersfilters[$i].name + ' ' + usersfilters[$i].lastname + '</li>');
                }
                $('.search-menu').show();
            } else {
                $('.search-menu').empty();
                $('.search-menu').hide();
            }

        };


        function getuser(index) {
            window.user = {
                id: usersfilters[index].id,
                name: usersfilters[index].name,
                email: usersfilters[index].email,
                phone: usersfilters[index].phone,
                lastname: usersfilters[index].lastname
            };
            $('.user_myfatoorah').val(JSON.stringify(user));
            $('.userdetails').empty();
            $('.userdetails').append('<input type="hidden" name="user_id" id="user_id" class="form-control" value="' + this.user.id + '">');
            $('.userdetails').append('<div class="col-md-4"><input type="email" name="email" id="email" class="form-control" value="' + this.user.email + '" placeholder="' + this.user.email + '"></div>');
            $('.userdetails').append('<div class="col-md-4"><input type="number" name="phone" id="phone" class="form-control" value="' + this.user.phone + '" placeholder="' + this.user.phone + '"></div>');
            $('.userdetails').append('<div class="col-md-4"><input type="text" name="name" id="name" class="form-control" value="' + this.user.name + ' ' + this.user.lastname + '" placeholder="' + this.user.name + ' ' + this.user.lastname + '"></div>'
            )
        }

        function saveuser() {
            if ($('#search-user').val()) {
                $('#userorder').modal('toggle');
                $('#userorder').removeClass('show');
                $('.userIcon').empty();
                $('.userIcon').append('<div><i class="ti-user" style="color:#5dd5c4"></i> ' + this.user.name + ' ' + this.user.lastname + '</div>');
                $('.userIcon').append('<div><i class="ti-mobile" style="color:#5dd5c4"></i> ' + this.user.phone + '</div>');
                $('.search-menu').empty();
            } else {
                Swal.fire({
                    title: '{{_i("Notiy")}}',
                    text: '{{_i("please select name")}}',
                    type: 'warning',
                });
            }
        }


        function addUser() {

            $('.userdetails').empty();
            $('.userdetails').append('<div class="col-md-4"><input type="email" id="email" class="form-control" placeholder="{{_i("email")}}"></div>')
            $('.userdetails').append('<div class="col-md-4"><input type="number" id="phone" class="form-control" placeholder="{{_i("phone")}}"></div>')
            $('.userdetails').append('<div class="col-md-4"><input type="text" id="name" class="form-control" placeholder="{{_i("name")}}"></div>')
            $('#save-new-user').css('display', 'block');
            $('#cancel').css('display', 'block');
            $('#save-new-user').css('padding', '10px');
            $('#cancel').css('padding', '10px');
        }

        function cancelNewUser() {

            $('.userdetails').empty();
            $('#save-new-user').css('display', 'none');
            $('#cancel').css('display', 'none');
        }

        function saveNewUser() {

            axios.post('../../adminpanel/orders/savenewuser', {
                id: null,
                name: $('#name').val(),
                phone: $('#phone').val(),
                email: $('#email').val()
            }).then((data) => {
                this.allUsers.push(data.data)
                $('.userdetails').empty();
                $('#save-new-user').css('display', 'none');
                $('#cancel').css('display', 'none');
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: '{{_i("Saved Successfuly")}}',
                    showConfirmButton: false,
                    timer: 2000
                })
            }).catch(function (error) {
                var errors = error.response.data.errors;
                var errormessage = []
                if (errors.name != null) {
                    errormessage.push(errors.name[0])
                }
                if (errors.email != null) {
                    errormessage.push(errors.email[0])
                }

                Swal.fire({
                    title: '{{_i("Notify")}}',
                    text: errormessage,
                    type: 'warning',
                })

            });
        }
    </script>
@endpush
