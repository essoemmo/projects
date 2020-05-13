<?php

return [

    [
        'type' => 'item',
        'label' => _i("Setting"),
        'route' => "#",
        "icon" => "ti-home",
        'permission' => 'Permission-Add',
        'links' => [
            [
                'label' => _i("Site Setting"),
                'route' => 'master/settings',
                'action' => 'all',
                'permission' => 'MasterSiteSetting-Add'
            ],
            [
                'label' => _i("Seo Setting"),
                'route' => 'master/seoMaster',
                'action' => 'all',
//                'permission' => 'MasterSeoSetting-Add'
            ],
//            [
//                'label' => _i("Sliders"),
//                'route' => '/admin/sliders',
//                'action' => 'all',
//                'permission' => 'languages_all'
//            ],
//            [
//                'label' => _i("Countries"),
//                'route' => '/admin/countries',
//                'action' => 'all',
//                'permission' => 'Country-Add'
//            ],
//            [
//                'label' => _i("Currencies"),
//                'route' => '/admin/currency',
//                'action' => 'all',
//                'permission' => 'Currency-Add'
//            ],
            [
                'label' => _i("Content Management"),
                'route' => '/master/content_management',
                'action' => 'all',
                'permission' => ''
            ],
            [
                'label' => _i("Country"),
                'route' => '/master/country/all',
                'action' => 'all',
                'permission' => ''
            ],
            [
                'label' => _i("City"),
                'route' => '/master/cities/all',
                'action' => 'all',
                'permission' => ''
            ],
//            [
//                'label' => _i("Default categories"),
//                'route' => '/master/cat',
//                'action' => 'all',
//                'permission' => ''
//            ],

            [
                'label' => _i("Blogs"),
                'route' => '/master/articles',
                'action' => 'all',
                'permission' => ''
            ],
            [
                'label' => _i("Blogs Category"),
                'route' => '/master/article_cat',
                'action' => 'all',
                'permission' => ''
            ],
            [
                'label' => _i("Chat Setting"),
                'route' => '/master/chat',
                'action' => 'all',
                'permission' => ''
            ],

        ]
    ],
    // security
    [
        'type' => 'item',
        'label' => _i("Security"),
        'route' => "#",
        "icon" => "ti-settings",
        'permission' => 'Permission-Add',
        'links' => [
            //permissions
            [
                'label' => _i("Permissions"),
                'route' => '/master/permission/all',
                //'action' => 'all',
                'permission' => 'MasterAll-Permission'
            ],
            [// li => ul {roles}
                'label' => _i("Roles"),
                'route' => '',
                "type" => "item",
                'permission' => 'Role-Add',
                "icon" => "ti-home",
                "links" => [
                    [
                        'label' => _i('Add'),
                        'route' => '/master/role/add',
                        //'action' => 'all',
                        'permission' => 'MasterAdd-Role'
                    ],
                    [
                        'label' => _i('All'),
                        'route' => '/master/role/all',
                        'action' => 'all',
                        'permission' => 'MasterAll-Role'
                    ],
                ]
            ],
            /// admins
            [
                'label' => _i("Admins"),
                'route' => '/master/admin/all',
                'permission' => 'MasterAll-User'
            ],
            [   /// users
                'label' => _i("Users"),
                'route' => '/master/user/all',
                'permission' => 'MasterAll-User'
            ],
        ]
    ], /// end security section

//fa-tasks
    /// membership
    [
        'type' => 'item',
        'label' => _i("Membership"),
        'route' => "#",
        "icon" => "ti-menu-alt",
        'permission' => 'MasterMembership-Add',
        'links' => [
            [
                'label' => _i("All"),
                'route' => '/master/membership',
                'action' => 'all',
                'permission' => 'MasterMembership-Add'
            ],
            [
                'label' => _i("Add"),
                'route' => '/master/membership/add',
                'action' => 'all',
                'permission' => 'MasterMembership-Add'
            ],


        ]
    ],
    [
        'type' => 'none',
        'label' => _i('Templates '),
        'route' => 'master/templates',
        'permission' => 'MasterTemplates-Controll',
        'icon' => 'ti-layout',
        'links' => []
    ], [
        'type' => 'none',
        'label' => _i('Stores '),
        'route' => 'master/store/all',
        'permission' => 'MasterStore-Show',
        'icon' => 'ti-package',
        'links' => []
    ],
    [
        'type' => 'none',
        'label' => _i('celebrates '),
        'route' => 'master/celebrates/all',
        'permission' => 'MasterStore-Show',
        'icon' => 'ti-package',
        'links' => []
    ],
    [
        'type' => 'none',
        'label' => _i('Sms Reservation '),
        'route' => 'master/sms_reservations',
//        'permission' => 'MasterStore-Show',
        'icon' => 'ti-email',
        'links' => []
    ],

    /// blog
//     [
//        'type' => 'item',
//        'label' => _i("Blog Managment"),
//        'route' => "#",
//        "icon" => "ti-pencil-alt",
//        'permission' => 'Blog-Add',
//        'links' => [
//            [
//                'label' => _i("Blog"),
//                'route' => '/admin/blog',
//                'action' => 'all',
//                'permission' => 'Blog-Add'
//            ],
//            [
//                'label' => _i("Blog Category"),
//                'route' => '/admin/blog_categories',
//                'action' => 'all',
//                'permission' => 'BlogCategory-Add'
//            ],
//
//
//        ]
//    ],


    [
        'type' => 'item',
        'label' => _i("Sample Managment"),
        'route' => "#",
        "icon" => "ti-pencil-alt",
        'permission' => '',
        'links' => [
            [
                'label' => _i("Samples"),
                'route' => '/master/samples/all',
                'action' => 'all',
                'permission' => ''
            ],

        ]
    ],

//    [
//        //  main li
//        'type' => 'none',
//        'label' => _i('NewsLetter'),
//        'route' => 'admin/newsLetter',
//        'permission' => 'NewsLetter-Add',
//        'icon' => 'ti-bell',
//        'links' => []
//    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Contacts'),
        'route' => 'master/contact/all',
        'permission' => 'MasterContact-Show',
        'icon' => 'ti-email',
        'links' => []
    ],


];
