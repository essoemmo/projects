@extends('web.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Account settings')}}</li>
            </ol>
        </div>
    </nav>

    <div class="my-account-top-panel pt-5">
        <div class="container">
            <div class="text-center">

                <div class="black-head-title">{{_i('Welcome to your account management page')}}</div>
                @if ($errors->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <ul class="my-account-top-panel-nav list-inline">
                    <li><a href="" id="notifcation">{{_i('notifaction')}}<span class="badge badge-pill badge-danger">{{$user->notifications->count()}}</span></a></li>
                    <li><a href="#" id="massege">{{_i('message')}}</a></li>
                    <li><a href="#" id="like">{{_i('likeList')}}</a></li>
                    <li><a href="#" id="blocklist">{{_i('dislikeList')}}</a></li>
                    <li><a href="#" id="like_me">{{_i('who like me')}}</a></li>
                    <li><a href="#" id="my_massege">{{_i('my massege')}}</a></li>
                    <li><a href="#" id="My_favorite_partner">{{_i('My favorite partner')}}</a></li>
                    <li><a href="#" id="online-user">{{_i('online now')}}</a></li>
{{--                    <li><a href="{{route('get-onlineUser')}}" id="online-user">{{_i('online now')}}</a></li>--}}
{{--                    <li><a href="">الباحث الآلي</a></li>--}}
                    <li><a href="#">{{_i('settings')}}</a></li>
                    <li><a href="#" id="editProfile">{{_i('edit details')}}</a></li>
                    <li><a href="#" id="contactAdmin">{{_i('contact mangment')}}</a></li>
                    <li class="" id="logout"><a href="">{{_i('logout')}}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="my_account_massege  common-wrapper" style="display: none" id="tables">
        <div class="container" id="show">

            <div class="table-responsive" id="notifactions">
                <table class="table table-bordered table-striped dataTable text-center" id="notifaction_table">
                </table>
            </div>

            <div class="table-responsive" id="massegeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="massegs_table">
                </table>
            </div>

            <div class="table-responsive" id="likeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="like_table">
                </table>
            </div>

            <div class="table-responsive" id="blockTable">
                <table class="table table-bordered table-striped dataTable text-center" id="block_table">
                </table>
            </div>

            <div class="table-responsive" id="likeMeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="likeMe_table">
                </table>
            </div>

            <div class="table-responsive" id="massegeMeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="massegeMe_table">
                </table>
            </div>
        </div>
    </section>

    <section class="register-form common-wrapper" id="formEdit">
        <section class="my_account_home  common-wrapper my-3">

            <div class="bg-light-pink p-5">
                <div class="container">
                    <div class="my_account_links white-notice-box notice-box">
                        <ul class="list-unstyled">
                            <li> {{_i('You have been with us since')}}{{$user->created_at->diffForHumans()}} , {{_i('Your membership number is')}} : " {{$user->id}} "</li>
                            <li>{{_i('Your data page is at the following address')}} : <a href="{{url('details/user/'.$user->id)}}">{{url('details/user/'.$user->id)}}</a> </li>

                            <li class="text-black-50 m-0 pl-10 pr-10">
                                {{_i('The time in the site is GMT')}}
                                <div class="col-md-4 sa_date" style="display: contents;"><p id="current_date" style="text-align: center"></p></div></li>

                            <li>{{_i('  You can control your account properties with special settings')}} , <a href="">{{_i('click here')}}
                                </a>
                            </li>
                            <li>{{_i('  Change the status of your appearance from connected to hidden or vice versa')}} <a href="">{{_i('click here')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="pink-box  my-4 text-center">

                    <h5>{{_i('Important notice to all members of the site')}}</h5>
                    <p>
                        {{_i('When a member is added to the ignore list he  she will not be able to email you anymore Please do not forget to help us and alert us to any member abusing the site, to take the necessary action against him')}}
                    </p>
                    <p>{{_i('We ask that we ask you and please not to give your e-mail to any young man no matter what the request Whatever the reasons.Giving e-mail to a young person for quicker understanding and conversation on Messenger is a violation of the terms of correspondence The only way to get in touch with a young man who wants to marry is through internal messaging Site It is the safest way and under the umbrella of site management')}}</p>

                    <h5>{{_i('Reason for prohibition')}}</h5>
                    <p>{{_i('Through research,scrutiny and follow-up of the members who request to chat outside the site do not want marriage, but dating and friendship only Most of the requests for e - mail and Messenger does not want to be under the cover of the site for fear of ban, so requests that the conversation takes place outside the site When a member offends the girl off site (via email or messenger), we do not see him and we have no concrete evidence of his ban Therefore, my sister registered on the site is prohibited to give e-mail information to the member There are hundreds of people who have been blessed by God through the site have used only internal messages')}}</p>

                    <h5>{{_i('Bad script on site')}}</h5>
                    <p>{{_i('The young person registers the site with good data (false), and corresponds with the girl through internal messages, and ask her e-mail to identify Better on messenger and via email, so the poor girl believes him and gives him the email and messenger And then the young man reveals what he really is and asks to talk about things outside marriage and ask for illegal things. The girl will then tell the administration She has discovered a bad guy and asks him to ban him from the site. The supervisor enters and searches for the young man and sees his data Interior sent there is no And there is no directory inside the site, and the directory only on the messenger that is outside the appointed and powers of the site That is, when the girl violated the conditions of correspondence and the safe way set by the site and exited the young man outside the site I was insulted by the bad guy')}}
                    </p>
                </div>
            </div>

        </section>
    </section>



@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('get_City_profile') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        if (response.status){
                            $('.city').empty();
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{_i('Sorry not found city to this country')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }

                        $('.city').empty();

                        for (var i = 0; i < response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                            $('.city').val({{$user->city_id}});
                        }



                    }
                });

            });


            // $('.gender').trigger('click');

            $('body').on('click','input[type=radio]',function (e) {
                // e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '{{ route('statue-user') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        console.log(response.data);
                        $('.status').empty();
                        for (var i = 0; i < response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });

            });

                    /*action massege [like-block-delete]*/
            $('body').on('click','.add-to-fav',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('You should login in the web to send the like')}}",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '{{ route('add-heart') }}',
                        method: "post",
                        data: {_token: '{{ csrf_token() }}',
                            f:f,
                            t:t,
                            id:id,

                        },
                        success: function (response) {
                            if (response === "true"){

                                $('.add-'+id+' i').attr('class','fa fa-heart');
                            }else{
                                $('.add-'+id+' i').attr('class','fa fa-heart-o');

                            }
                        }
                    });
                }


            });

            $('body').on('click','#block',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('You should login in the web to send the blocked')}}",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '{{ route('add-block') }}',
                        method: "post",
                        data: {_token: '{{ csrf_token() }}',
                            f:f,
                            t:t,
                            id:id,

                        },
                        success: function (response) {
                            if (response === "true"){
                                $('.add-'+id+' i').attr('class','fa fa-heart-o');
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{_i('Done the user is blocked')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }else{
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{_i('Done the user is disliked')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        }
                    });
                }
            })

            $('body').on('click','#delete',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var fav = $(this).data('favid');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-massege') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                            fav: fav,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            });
                 /*end action massege [like-block-delete]*/

                   /*notfaction tabels*/

            $('body').on('click','#notifcation',function (e) {
                e.preventDefault();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#massegeTable').hide();
                $('#tables').show();
                $('#notifactions').show();
                $('#massegeMeTable').hide();


                $(this).parent().addClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#massege" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');




                // $('#show').load('massege/all');
                if($.fn.DataTable.isDataTable( '#notifaction_table' ))
                    tableNotify.destroy();
                 tableNotify=  $('#notifaction_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('notifaction/get_datatable')}}',
                    columns: [
                        {{--{data: 'from_id', title: '{{_i('form')}}'},--}}
                        {data: 'massege', title: '{{_i('message')}}'},
                        {data: 'created_at', title: 'created_at'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });

                // var table = $('#notifaction_table').DataTable();
                // table.destroy();
            });
            $('body').on('click','#del',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-notify') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });

            /*get datatable massge*/
            $('body').on('click','#massege',function (e) {
                e.preventDefault();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#massegeTable').show();
                $('#notifactions').hide();
                $('#massegeMeTable').hide();


                $(this).parent().addClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');



                // $('#show').load('massege/all');
                if($.fn.DataTable.isDataTable( '#massegs_table' ))
                tableMass.destroy();
                tableMass = $('#massegs_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('massege/get_datatable')}}',
                    columns: [
                        {data: 'from_id', title: '{{_i('form')}}'},
                        {data: 'message', title: '{{_i('message')}}'},
                        {data: 'created_at', title: 'created_at'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });

                // var table = $('#massegs_table').DataTable();
                // table.destroy();



            });
                        /*like list*/
            $('body').on('click','#like',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#blockTable').hide();
                $('#likeMeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#likeTable').show();
                $('#notifactions').hide();
                $('#massegeMeTable').hide();



                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');


                if($.fn.DataTable.isDataTable( '#like_table' ))
                    tablelike.destroy();
                tablelike = $('#like_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('like/get_datatable')}}',
                    columns: [
                        {data: 'to_id', title: '{{_i('numberId')}}'},
                        {data: 'username', title: '{{_i('name')}}'},
                        {data: 'age', title: '{{_i('age')}}'},
                        {data: 'nationalty_id', title: '{{_i('nationalty')}}'},
                        {data: 'resident_country_id', title: '{{_i('country')}}'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });
                // var table = $('#like_table').DataTable();
                // table.destroy();

            });
            $('body').on('click','#deleteLike',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-like') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })
                        /*end like list*/

                        /*block list*/
            $('body').on('click','#blocklist',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#blockTable').show();
                $('#notifactions').hide();
                $('#massegeMeTable').hide();



                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifactions" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');




                if($.fn.DataTable.isDataTable( '#block_table' ))
                tableblock.destroy();
                tableblock = $('#block_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('block/get_datatable')}}',
                    columns: [
                        {data: 'to_id', title: '{{_i('numberId')}}'},
                        {data: 'username', title: '{{_i('name')}}'},
                        {data: 'age', title: '{{_i('age')}}'},
                        {data: 'nationalty_id', title: '{{_i('nationalty')}}'},
                        {data: 'resident_country_id', title: '{{_i('country')}}'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });


                // var table = $('#block_table').DataTable();
                // table.destroy();
            });
            $('body').on('click','#deleteblock',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-like') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })

                        /*like me*/
            $('body').on('click','#like_me',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#likeMeTable').show();
                $('#notifactions').hide();
                $('#massegeMeTable').hide();



                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');




                if($.fn.DataTable.isDataTable( '#likeMe_table' ))
                    tableLikeMe.destroy();
               tableLikeMe = $('#likeMe_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('likeMe/get_datatable')}}',
                    columns: [
                        {data: 'from_id', title: '{{_i('numberId')}}'},
                        {data: 'username', title: '{{_i('name')}}'},
                        {data: 'age', title: '{{_i('age')}}'},
                        {data: 'nationalty_id', title: '{{_i('nationalty')}}'},
                        {data: 'resident_country_id', title: '{{_i('country')}}'},
                        {data: 'created', title: '{{_i('created')}}'},
                        // {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });
                // var table = $('#likeMe_table').DataTable();
                // table.destroy();
            });
                        /*likeme*/

                    /*getEdit profiel*/
            $('body').on('click','#editProfile',function (e) {
                e.preventDefault();
                  $('#tables').hide();
                  $('#formEdit').show();

                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');




                $( "#formEdit" ).load( "new/profile" );
                setTimeout(
                            function()
                            {
                                $('.country').trigger('change');
                            }, 500);



            })

                    //edit password
            $('body').on('click','#editPassword',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var password = $('#password').val();
                var passwordcon = $('#password_confirmation').val();


                if (password.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('password is null please write new password')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                } else{
                    $.ajax({
                        url: '{{ route('update-password') }}',
                        method: "patch",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                            pass:password,
                            passCon:passwordcon,
                        },
                        success: function (response) {
                            // window.location.reload();
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{_i('password changed')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    });
                }


            })
                    //edit email
            $('body').on('click','#editemail',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var email = $('#email').val();
                    $.ajax({
                        url: '{{ route('update-email') }}',
                        method: "patch",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                            email:email,
                        },
                        success: function (response) {
                            // window.location.reload();
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{_i('email changed')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    });

            })
                    //delete member
            $('body').on('click','#deleteMember',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('delete-member') }}',
                        method: "delete",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            window.location.replace("{{route('home')}}");
                        }
                    });

            });
            // contact admin
            $('body').on('click','#contactAdmin',function (e) {
                e.preventDefault();
                // $('#formEdit').empty();
                $('#tables').hide();
                $('#formEdit').show();

                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');



                $( "#formEdit" ).load( "contact/Adminstator" );

            })
            // logout
            $('body').on('click','#logout',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('logout') }}',
                    method: "post",
                    data: {_token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        window.location.replace("{{route('home')}}");
                    }
                });
            })
                    /*get my massege*/
            $('body').on('click','#my_massege',function (e) {
                e.preventDefault();

                $('#massegeTable').hide();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#likeMeTable').hide();
                $('#notifactions').hide();
                $('#massegeMeTable').show();


                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');
                $( "#My_favorite_partner" ).parent().removeClass('active');

                // $( "#formEdit" ).load( "my/massege" );

                if($.fn.DataTable.isDataTable( '#massegeMe_table' ))
                    massegeMe.destroy();
                massegeMe = $('#massegeMe_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route('get-datatable-my-massege')}}',
                    columns: [
                        {data: 'to_id', title: '{{_i('to')}}'},
                        {data: 'message', title: '{{_i('massege')}}'},
                        {{--{data: 'age', title: '{{_i('age')}}'},--}}
                        {{--{data: 'nationalty_id', title: '{{_i('nationalty')}}'},--}}
                        {{--{data: 'resident_country_id', title: '{{_i('country')}}'},--}}
                        {data: 'created_at', title: '{{_i('created')}}'},
                        {data: 'action', title: '{{_i('action')}}', orderable: true, searchable: true}

                    ]
                });
            })
            $('body').on('click','#deletemass',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-massege') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            });

                    /*my favrouite partiner*/
            $('body').on('click','#My_favorite_partner',function (e) {
                e.preventDefault();
                $('#tables').hide();
                $('#formEdit').show();

                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#my_massege" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                $( "#formEdit" ).load( "fav/partener" );

            })
            $('body').on('click','#saveform',function (e) {
                e.preventDefault();

               var form = $('#favform').serialize();
               var url = $('#favform').attr('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: url,
                    type: "POST",
                    data: form,
                    success: function( response ) {
                           if (response === 'true'){
                               new Noty({
                                   type: 'success',
                                   layout: 'topRight',
                                   text: "{{_i('Succesffly values sended')}}",
                                   timeout: 2000,
                                   killer: true
                               }).show();
                           }
                    }
                });
            })

            /*Online user*/


                $('body').on('click','#online-user',function (e) {
                    e.preventDefault();
                    $('#tables').hide();
                    $('#formEdit').show();

                    $(this).parent().addClass('active');
                    $('#massege').parent().removeClass('active');
                    $('#like').parent().removeClass('active');
                    $('#blocklist').parent().removeClass('active');
                    $( "#like_me" ).parent().removeClass('active');
                    $( "#notifcation" ).parent().removeClass('active');
                    $( "#editProfile" ).parent().removeClass('active');
                    $( "#my_massege" ).parent().removeClass('active');
                    $( "#contactAdmin" ).parent().removeClass('active');
                    $( "#My_favorite_partner" ).parent().removeClass('active');

                    $( "#formEdit" ).load( "onlineUser" );


                })
        /*online user*/
            $('body').on('change', '#country', function (e) {
                e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '{{ route('get-onlineUser-country') }}',
                    method: "get",
                    data: {val: val},
                    success: function (response) {
                        $('#data').html(response)
                    }
                });
            })

            $('body').on('click','#filter',function (e) {
                e.preventDefault();
                var filter = $(this).data('filter');
                $.ajax({
                    url: '{{ route('get-onlineUser-filter') }}',
                    method: "get",
                    data: {filter:filter},
                    success: function (response) {
                        $('#data').html(response)
                    }
                });

            });

            $('body').on('click','#comment',function (e) {
                e.preventDefault();

                var to = $(this).data('to');
                var fro = $(this).data('fro');


                        @if(\Illuminate\Support\Facades\Auth::check())
                var html = ` <form action="{{route('send-messageUser')}}" method="post" id="mass">
                                    {{csrf_field()}}
                                {{method_field('post')}}
                        <input type="hidden" name="from" value="${fro}">
            <input type="hidden" name="to" value="${to}">

                        <textarea rows="5"  name="messge" class="form-control"></textarea>

                            </form>`;

                @else
                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: "{{_i('Sorry you should Login')}}",
                    timeout: 2000,
                    killer: true
                }).show();

                @endif

                $('#modeldata').empty();
                $('#modeldata').append(html);



            });

            $('body').on('click','.add-to-fav-online',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('You should login in the web to send the like')}}",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '{{ route('add-heart') }}',
                        method: "post",
                        data: {_token: '{{ csrf_token() }}',
                            f:f,
                            t:t,


                        },
                        success: function (response) {
                            if (response === "true"){
                                $('#like-'+id+' i').attr('class','fa fa-heart');
                                new Noty({
                                    type: 'success',
                                    layout: 'topRight',
                                    text: "{{_i('done like !!')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }else{
                                $('#like-'+id+' i').attr('class','fa fa-heart-o');
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{_i('done dislike !!')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();

                            }
                        }
                    });
                }

            });

            $('body').on('click','#submit',function () {

                $('#mass').submit();
            })

        });
    </script>
    <script>
        $(document).on('click','.pagination a' ,function(e){
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            $.ajax({
                url:"/paginate/fetch/online?page="+page,
                success:function (data) {
                    $('#data').html(data)
                }
            });

        });
    </script>
    <script>
        function doDate()
        {
            var str = "";
                    {{--@if (\Illuminate\Support\Facades\Lang::getLocale()=='ar')--}}
                    {{--var days = new Array("الاحد", "الاثنين", "الثلاثاء", "الاربعاء", "الخميس", "الجمعه", "السبت");--}}
                    {{--var months = new Array("يناير", "فبراير", "مارس", "ابريل", "مايو", "يونية", "يوليو", "اغسطس", "سبتمير", "اكتوبر", "نوفمبر", "ديسمبر");--}}
                    {{--@else--}}
            var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
            var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    {{--@endif--}}



            var now = new Date();

            str += days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " " + now.getHours() +":" + now.getMinutes() + ":" + now.getSeconds();
            document.getElementById("current_date").innerHTML = str;
        }

        setInterval(doDate, 1000);

    </script>



@endpush

