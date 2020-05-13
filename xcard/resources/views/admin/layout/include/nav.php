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
                'label' => _i("Site Languages"),
                'route' => 'admin/site_languages',
                'action' => 'all',
                'permission' => 'SiteLanguage-Add'
            ],
            [

                'label' => _i("Sliders"),
                'route' => '/admin/sliders',
                'action' => 'all',
                'permission' => 'languages_all'
            ],
            [
                'label' => _i("Countries"),
                'route' => '/admin/countries',
                'action' => 'all',
                'permission' => 'Country-Add'
            ],
            [
                'label' => _i("Currencies"),
                'route' => '/admin/currency',
                'action' => 'all',
                'permission' => 'Currency-Add'
            ],
            [
                'label' => _i("Content Management"),
                'route' => '/admin/content_management',
                'action' => 'all',
                'permission' => ''
            ],
            [
                'label' => _i("Product Management"),
                'route' => '/admin/section_products',
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
                'label' => _i("Users"),
                'route' => '/admin/user/all',
                'permission' => 'FrontUser-Add'
            ],
        ]
    ], /// end security section

    // product
    [
        'type' => 'item',
        'label' => _i("Product Managment"),
        'route' => "#",
        "icon" => "ti-view-list-alt",
        'permission' => 'Product-Add',
        'links' => [
            [
                'label' => _i("Products"),
                'route' => 'admin/products',
                'permission' => 'Product-Add'
            ],
            [
                'label' => _i("Categories"),
                'route' => '/admin/categories',
                'permission' => 'ProductCategory-Add'
            ],
            [
                'label' => _i("Genres"),
                'route' => '/admin/genres',
                'permission' => 'Genres-Add'
            ],
            [
                'label' => _i("PlatForms"),
                'route' => '/admin/platforms',
                'permission' => 'PlatForm-Add'
            ],
            [
                'label' => _i("Regions"),
                'route' => '/admin/regions',
                'permission' => 'Region-Add'
            ],
            [
                'label' => _i("Game details"),
                'route' => '/admin/game_details',
                'permission' => 'GameDetails-Add'
            ],
            [
                'label' => _i("Game languages"),
                'route' => '/admin/game_languages',
                'permission' => 'GameLanguage-Add'
            ],
            [
                'label' => _i("Works on"),
                'route' => '/admin/works_on',
                'permission' => 'WorkOn-Add'
            ],
        ]
    ], /// end product section
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
            ],[
                'label' => _i("Online Payment"),
                'route' => '/admin/online_payment',
                'action' => 'all',
                'permission' => 'Online-Payment'
            ],
        ]
    ],
    [
        //  main li
        'type' => 'none',
        'label' => _i('Orders'),
        'route' => 'admin/orders',
        'permission' => 'Order-show',
        'icon' => 'fa fa-shopping-basket',
        'links' => []
    ],
     [
        'type' => 'item',
        'label' => _i("Blog Managment"),
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


        ]
    ],
    [
        'type' => 'item',
        'label' => _i("Reports"),
        'route' => "#",
        "icon" => "fa fa-newspaper-o",
        'permission' => 'Report-Show',
        'links' => [
            [
                'label' => _i("Order Report"),
                'route' => '/admin/orderReport',
                'action' => 'all',
                'permission' => 'Report-Show'
            ],
            [
                'label' => _i("Purchased Products Report"),
                'route' => '/admin/purchasedProductsReport',
                'action' => 'all',
                'permission' => 'Report-Show'
            ],[
                'label' => _i("Customer Order Report"),
                'route' => '/admin/customerOrderReport',
                'action' => 'all',
                'permission' => 'Report-Show'
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

];
