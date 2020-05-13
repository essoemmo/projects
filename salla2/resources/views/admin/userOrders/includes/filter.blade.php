<ul class="top-level-menu">
    <li>
        <a href="#" class="first_link">{{ _i('Options') }}</a>
        <ul class="second-level-menu">
            <li>
                <a href="#" data-toggle="modal" data-target="#sendSms"><i
                        class="ti-email"></i> {{ _i('Send Sms') }}</a>
            </li>
            <li>
                <a href="{{ url('/adminpanel/store_user/' . $user->id . '/edit') }}"><i
                        class="ti-pencil-alt"></i> {{ _i('Edit Customer') }}</a>
            </li>
            <li>
                <a href="#">{{ _i('Block Customer') }}</a>
            </li>
        </ul>
    </li>
</ul>

@include('admin.userOrders.includes.modal')


@push('css')

    <style>
        .first_link:after {
            content: "\e64b";
            font-family: themify;
            margin-left: 10px;
        }

        .third-level-menu {
            position: absolute;
            top: 0;
            left: -250px;
            width: 150px;
            list-style: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        .third-level-menu > li {
            height: 30px;
            width: 250px;
            background: #5dd5c4;
        }

        .third-level-menu > li:hover {
            background: #CCCCCC;
        }

        .second-level-menu {
            position: absolute;
            top: 30px;
            right: 0;
            width: 150px;
            list-style: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        .second-level-menu > li {
            position: relative;
            height: 30px;
            background: #5dd5c4;
        }

        .second-level-menu > li:hover {
            background: #CCCCCC;
        }

        .top-level-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: ;
        }

        .top-level-menu > li {
            position: relative;
            float: left;
            height: 30px;
            width: 100px;
            margin-right: 15px;
            background: #5dd5c4;
            border-radius: 50px;
        }

        .top-level-menu > li:hover {
            background: #CCCCCC;
        }

        .top-level-menu li:hover > ul {
            /* On hover, display the next level's menu */
            display: inline-block;
            z-index: 99999;
        }


        /* Menu Link Styles */

        .top-level-menu a /* Apply to all links inside the multi-level menu */
        {
            font: bold 14px Arial, Helvetica, sans-serif;
            color: #FFFFFF;
            text-decoration: none;
            padding: 0 0 0 10px;

            /* Make the link cover the entire list item-container */
            display: block;
            line-height: 30px;
        }

        .top-level-menu a:hover {
            color: #000000;
        }

    </style>

@endpush


