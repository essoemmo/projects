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
                'route' => 'admin/setting',
                'action' => 'all',
                'permission' => 'SiteSetting-Add'
            ],
            [
                'label' => _i("Email Setup Setting"),
                'route' => 'admin/email_setup',
                'action' => 'all',
                'permission' => 'EmailSetup-Add'
            ],
            [
                'label' => _i("Notification Setup Setting"),
                'route' => 'admin/notify_setup',
                'action' => 'all',
                'permission' => 'NotifySetup-Add'
            ],
            [
                'label' => _i("User Setting"),
                'route' => 'admin/userSetting',
                'action' => 'all',
                'permission' => 'UserSetting-Add'
            ],
            [
                'label' => _i("Site Languages"),
                'route' => 'admin/site_languages',
                'action' => 'all',
                'permission' => 'SiteLanguage-Add'
            ],
//            [
//
//                'label' => _i("Sliders"),
//                'route' => '/admin/sliders',
//                'action' => 'all',
//                'permission' => 'languages_all'
//            ],
//            [
//
//                'label' => _i("Banners"),
//                'route' => '/admin/banners',
//                'action' => 'all',
//                'permission' => 'Banner-Add'
//            ],
            [
                'label' => _i("Countries"),
                'route' => '/admin/countries',
                'action' => 'all',
                'permission' => 'Country-Add'
            ],
            [
                'label' => _i("Cities"),
                'route' => '/admin/cities',
                'action' => 'all',
                'permission' => 'City-Add'
            ],
//            [
//                'label' => _i("Currencies"),
//                'route' => '/admin/currency',
//                'action' => 'all',
//                'permission' => 'Currency-Add'
//            ],
            [
                'label' => _i("Footer"),
                'route' => '/admin/footer',
                'action' => 'all',
                'permission' => 'Footer-Add'
            ],
            [
                'label' => _i("Send Users Notifications Or Email"),
                'route' => '/admin/sendUsers',
                'action' => 'all',
                'permission' => 'SiteSetting-Add'
            ],
//            [
//                'label' => _i("Product Management"),
//                'route' => '/admin/section_products',
//                'action' => 'all',
//                'permission' => ''
//            ],
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
                'route' => '/admin/permission/all',
                //'action' => 'all',
                'permission' => 'Permission-Add'
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
                        'route' => '/admin/role/add',
                        //'action' => 'all',
                        'permission' => 'Role-Add'
                    ],
                    [
                        'label' => _i('All'),
                        'route' => '/admin/role/all',
                        'action' => 'all',
                        'permission' => 'Role-Edit'
                    ],
                ]
            ],
            /// admins
            [
                'label' => _i("Admins"),
                'route' => '/admin/admin/all',
                'permission' => 'AdminUser-Add'
            ],
            [   /// users
                'label' => _i("Famous"),
                'route' => '/admin/famous/all',
                'permission' => 'FrontUser-Add'
            ],
            [   /// users
                'label' => _i("Members"),
                'route' => '/admin/user/all',
                'permission' => 'FrontUser-Add'
            ],
        ]
    ], /// end security section

    // product
    [
        'type' => 'item',
        'label' => _i("Payment Managment"),
        'route' => "#",
        "icon" => "fa fa-money",
        'permission' => 'Payment-Add',
        'links' => [
            [
                'label' => _i("Banks"),
                'route' => '/admin/banks',
                'action' => 'all',
                'permission' => 'Payment-Add'
            ],
//            [
//                'label' => _i("Online Payment"),
//                'route' => '/admin/online_payment',
//                'action' => 'all',
//                'permission' => 'Online-Payment'
//            ],
        ]
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Social Links'),
        'route' => 'admin/social_links',
        'permission' => 'SocialLink-Add',
        'icon' => 'fa fa-gg-circle',
        'links' => []
    ],
//    [
//        'type' => 'none',
//        'label' => _i('Rate Levels'),
//        'route' => 'admin/rating_levels',
//        'permission' => 'RatingLevel-Add',
//        'icon' => 'fa fa-star',
//        'links' => []
//    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Account Type'),
        'route' => 'admin/account_content',
        'permission' => 'ContentType-Add',
        'icon' => 'fa fa-list-ul',
        'links' => []
    ], [
        //  main li
        'type' => 'none',
        'label' => _i('Featured Ads Price'),
        'route' => 'admin/featured_ad',
        'permission' => 'FeaturedAd-Add',
        'icon' => 'fa fa-money',
        'links' => []
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Social Advertisement Price'),
        'route' => 'admin/social_advert',
        'permission' => 'SocialAdvert-Add',
        'icon' => 'fa fa-money',
        'links' => []
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Points'),
        'route' => 'admin/points',
        'permission' => 'Point-Add',
        'icon' => 'fa fa-circle-o ',
        'links' => []
    ],
    [
        //  main li
        'type' => 'item',
        'label' => _i('Orders'),
        'route' => '#',
        'permission' => 'Order-Show',
        'icon' => 'fa fa-shopping-basket',
        'count' => ordersCount(),
        'links' => [
            [
                'label' => _i("Site Ads"),
                'route' => '/admin/site_ads',
                'action' => 'all',
                'permission' => 'Order-Show',
                'count' => featuredCount(),
            ], [
                'label' => _i("Famous Ads"),
                'route' => '/admin/famous_ads',
                'action' => 'all',
                'permission' => 'Order-Show',
                'count' => famousCount(),
            ], [
                'label' => _i("Our Accounts Ads"),
                'route' => '/admin/ourAccountsAds',
                'action' => 'all',
                'permission' => 'Order-Show',
                'count' => ourAdsCount(),
            ],
            [
                'label' => _i("Featured Members"),
                'route' => '/admin/featured_users',
                'action' => 'all',
                'permission' => 'FeaturedUser-Show',
                'count' => FeaturedAdUserCount(),
            ],
        ]
    ],
    [
        'type' => 'item',
        'label' => _i("Blog Management"),
        'route' => "#",
        "icon" => "ti-pencil-alt",
        'permission' => 'Blog-Add',
        'links' => [
            [
                'label' => _i("Blog"),
                'route' => '/admin/blog',
                'action' => 'all',
                'permission' => 'Blog-Add'
            ],
            [
                'label' => _i("Blog Category"),
                'route' => '/admin/blog_categories',
                'action' => 'all',
                'permission' => 'BlogCategory-Add'
            ],
            [
                'label' => _i("Tags"),
                'route' => '/admin/tags',
                'action' => 'all',
                'permission' => 'Tag-Add'
            ],

        ]
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('NewsLetter'),
        'route' => 'admin/newsLetter',
        'permission' => 'NewsLetter-Add',
        'icon' => 'ti-bell',
        'links' => []
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Contacts'),
        'route' => 'admin/contact/all',
        'permission' => 'Contacts-Show',
        'icon' => 'ti-email',
        'count' => contactsCount(),
        'links' => []
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Open Ticket'),
        'route' => 'admin/openTicket',
        'permission' => 'OpenTicket-Show',
        'icon' => 'ti-email',
        'links' => []
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Priority'),
        'route' => 'admin/priority',
        'permission' => 'Priority-Show',
        'icon' => 'ti-flag-alt-2',
        'links' => []
    ],

];
