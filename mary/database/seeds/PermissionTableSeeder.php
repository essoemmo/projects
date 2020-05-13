<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Permission-Add' ,'guard_name' => 'web' ],
            ['id' => 2, 'name' => 'Permission-Edit' ,'guard_name' => 'web' ],
            ['id' => 3, 'name' => 'Permission-Delete' ,'guard_name' => 'web' ],

            ['id' => 4, 'name' => 'Role-Add' ,'guard_name' => 'web' ],
            ['id' => 5, 'name' => 'Role-Edit' ,'guard_name' => 'web' ],
            ['id' => 6, 'name' => 'Role-Delete' ,'guard_name' => 'web' ],

            ['id' => 7, 'name' => 'Membership-Add' ,'guard_name' => 'web' ],
            ['id' => 8, 'name' => 'Membership-Edit' ,'guard_name' => 'web' ],
            ['id' => 9, 'name' => 'Membership-Delete' ,'guard_name' => 'web' ],

//            ['id' => 10, 'name' => 'UserMembership-Add' ,'guard_name' => 'web' ],
//            ['id' => 11, 'name' => 'UserMembership-Edit' ,'guard_name' => 'web' ],
//            ['id' => 12, 'name' => 'UserMembership-Delete' ,'guard_name' => 'web' ],
//
//            ['id' => 13, 'name' => 'MembershipPermissions-Add' ,'guard_name' => 'web' ],
//            ['id' => 14, 'name' => 'MembershipPermissions-Edit' ,'guard_name' => 'web' ],
//            ['id' => 15, 'name' => 'MembershipPermissions-Delete' ,'guard_name' => 'web' ],
//
//            ['id' => 16, 'name' => 'Language-Add' ,'guard_name' => 'web' ],
//            ['id' => 17, 'name' => 'Language-Edit' ,'guard_name' => 'web' ],
//            ['id' => 18, 'name' => 'Language-Delete' ,'guard_name' => 'web' ],
//
//            ['id' => 19, 'name' => 'Article-Add' ,'guard_name' => 'web' ],
//            ['id' => 20, 'name' => 'Article-Edit' ,'guard_name' => 'web' ],
//            ['id' => 21, 'name' => 'Article-Delete' ,'guard_name' => 'web' ],
//
//            ['id' => 22, 'name' => 'ArticleCategory-Add' ,'guard_name' => 'web' ],
//            ['id' => 23, 'name' => 'ArticleCategory-Edit' ,'guard_name' => 'web' ],
//            ['id' => 24, 'name' => 'ArticleCategory-Delete' ,'guard_name' => 'web' ],

            ['id' => 25, 'name' => 'Feature-Add' ,'guard_name' => 'web' ],
            ['id' => 26, 'name' => 'Feature-Edit' ,'guard_name' => 'web' ],
            ['id' => 27, 'name' => 'Feature-Delete' ,'guard_name' => 'web' ],

            ['id' => 28, 'name' => 'Country-Add' ,'guard_name' => 'web' ],
            ['id' => 29, 'name' => 'Country-Edit' ,'guard_name' => 'web' ],
            ['id' => 30, 'name' => 'Country-Delete' ,'guard_name' => 'web' ],

            ['id' => 31, 'name' => 'City-Add' ,'guard_name' => 'web' ],
            ['id' => 32, 'name' => 'City-Edit' ,'guard_name' => 'web' ],
            ['id' => 33, 'name' => 'City-Delete' ,'guard_name' => 'web' ],

            ['id' => 34, 'name' => 'category-add' ,'guard_name' => 'web' ],
            ['id' => 35, 'name' => 'category-edit' ,'guard_name' => 'web' ],
            ['id' => 36, 'name' => 'category-delete' ,'guard_name' => 'web' ],


            ['id' => 37, 'name' => 'materialStatus-Add' ,'guard_name' => 'web' ],
            ['id' => 38, 'name' => 'materialStatus-Edit' ,'guard_name' => 'web' ],
            ['id' => 39, 'name' => 'materialStatus-Delete' ,'guard_name' => 'web' ],

            ['id' => 40, 'name' => 'option-add' ,'guard_name' => 'web' ],
            ['id' => 41, 'name' => 'option-edit' ,'guard_name' => 'web' ],
            ['id' => 42, 'name' => 'option-delete' ,'guard_name' => 'web' ],

            ['id' => 43, 'name' => 'member-Add' ,'guard_name' => 'web' ],
            ['id' => 44, 'name' => 'member-Edit' ,'guard_name' => 'web' ],
            ['id' => 45, 'name' => 'member-Delete' ,'guard_name' => 'web' ],

        ];

        foreach ($items as $item) {
            $permission= Permission::updateOrCreate(['id' => $item['id']], $item);
            $permission->save();
            $role = Role::where('name','super-admin')->first();

            if(!$role)
            {
                // Create a super-admin role for the admin users
                $role = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);
                $role->save();
            }
            $role->givePermissionTo($permission->name);

            $user = User::where('email','=' ,'admin@admin.com')->first();
            if(!$user)
            {
                $user = User::create(['email'=> 'admin@admin.com', 'password' => bcrypt('15963'),
                    'guard' => 'admin' , 'username' => 'admin','fullname' => 'admin','mobile'=>'00000','address' => 'admin.com']);
                $user->save();
            }
            $user->givePermissionTo($permission->id);


        }
    }

}
