<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            ['id' => 1, 'name' => 'Permission-Add', 'guard_name' => 'admin', 'desc' => 'إضافة صلاحية'],
            ['id' => 2, 'name' => 'Permission-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل صلاحية'],
            ['id' => 3, 'name' => 'Permission-Delete', 'guard_name' => 'admin', 'desc' => 'حذف صلاحية'],
            ['id' => 4, 'name' => 'Role-Add', 'guard_name' => 'admin', 'desc' => 'اضافه مجموعه مستخدمين'],
            ['id' => 5, 'name' => 'Role-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مجموعه مستخدمين'],
            ['id' => 6, 'name' => 'Role-Delete', 'guard_name' => 'admin' , 'desc' => 'حذف مجموعه مستخدمين'],
            ['id' => 7, 'name' => 'Show-Adminpanel', 'guard_name' => 'admin', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 8, 'name' => 'AdminUser-Add', 'guard_name' => 'admin', 'desc' => 'اضافه ادمن'],
            ['id' => 9, 'name' => 'AdminUser-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل ادمن'],
            ['id' => 10, 'name' => 'AdminUser-Delete', 'guard_name' => 'admin', 'desc' => 'حذف ادمن'],
            ['id' => 11, 'name' => 'FrontUser-Add', 'guard_name' => 'admin', 'desc' => 'اضافه مستخدم'],
            ['id' => 12, 'name' => 'FrontUser-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مستخدم'],
            ['id' => 13, 'name' => 'FrontUser-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مستخدم'],
            ['id' => 14, 'name' => 'NewsLetter-Add', 'guard_name' => 'admin', 'desc' => 'إضافة مستخدم للنشرة الإخبارية'],

            ['id' => 15, 'name' => 'SiteSetting-Add', 'guard_name' => 'admin', 'desc' => 'إضافة إعدادات الموقع'],
            ['id' => 16, 'name' => 'SiteLanguage-Add', 'guard_name' => 'admin', 'desc' => 'إضافة لغة للموقع'],
            ['id' => 17, 'name' => 'SiteLanguage-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل لغة للموقع'],
            ['id' => 18, 'name' => 'SiteLanguage-Delete', 'guard_name' => 'admin', 'desc' => 'حذف لغة للموقع'],

            ['id' => 19, 'name' => 'Country-Add', 'guard_name' => 'admin', 'desc' => 'إضافة دولة'],
            ['id' => 20, 'name' => 'Country-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل دولة'],
            ['id' => 21, 'name' => 'Country-Delete', 'guard_name' => 'admin', 'desc' => 'حذف دولة'],

            ['id' => 22, 'name' => 'Currency-Add', 'guard_name' => 'admin', 'desc' => 'إضافة عملة'],
            ['id' => 23, 'name' => 'Currency-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل عملة'],
            ['id' => 24, 'name' => 'Currency-Delete', 'guard_name' => 'admin', 'desc' => 'حذف عملة'],

            ['id' => 25, 'name' => 'GameLanguage-Add', 'guard_name' => 'admin', 'desc' => 'إضافة لغة للعبة'],
            ['id' => 26, 'name' => 'GameLanguage-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل لغة للعبة'],
            ['id' => 27, 'name' => 'GameLanguage-Delete', 'guard_name' => 'admin', 'desc' => 'حذف لغة للعبة'],

            ['id' => 28, 'name' => 'GameDetails-Add', 'guard_name' => 'admin', 'desc' => 'إضافة تفاصيل للعبة'],
            ['id' => 29, 'name' => 'GameDetails-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل تفاصيل للعبة'],
            ['id' => 30, 'name' => 'GameDetails-Delete', 'guard_name' => 'admin', 'desc' => 'حذف تفاصيل للعبة'],

            ['id' => 31, 'name' => 'Slider-Add', 'guard_name' => 'admin', 'desc' => 'إضافة سليدر'],
            ['id' => 32, 'name' => 'Slider-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل سليدر'],
            ['id' => 33, 'name' => 'Slider-Delete', 'guard_name' => 'admin', 'desc' => 'حذف سليدر'],

            ['id' => 34, 'name' => 'Region-Add', 'guard_name' => 'admin', 'desc' => 'إضافة منطقة'],
            ['id' => 35, 'name' => 'Region-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل منطقة'],
            ['id' => 36, 'name' => 'Region-Delete', 'guard_name' => 'admin', 'desc' => 'حذف منطقة'],

            ['id' => 37, 'name' => 'Genres-Add', 'guard_name' => 'admin', 'desc' => 'إضافة نوع'],
            ['id' => 38, 'name' => 'Genres-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل نوع'],
            ['id' => 39, 'name' => 'Genres-Delete', 'guard_name' => 'admin', 'desc' => 'حذف نوع'],

            ['id' => 40, 'name' => 'PlatForm-Add', 'guard_name' => 'admin', 'desc' => 'إضافة منصة'],
            ['id' => 41, 'name' => 'PlatForm-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل منصة'],
            ['id' => 42, 'name' => 'PlatForm-Delete', 'guard_name' => 'admin', 'desc' => 'حذف منصة'],

            ['id' => 43, 'name' => 'ProductCategory-Add', 'guard_name' => 'admin', 'desc' => 'إضافة قسم للمنتجات'],
            ['id' => 44, 'name' => 'ProductCategory-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل قسم للمنتجات'],
            ['id' => 45, 'name' => 'ProductCategory-Delete', 'guard_name' => 'admin', 'desc' => 'حذف قسم للمنتجات'],

            ['id' => 46, 'name' => 'Product-Add', 'guard_name' => 'admin', 'desc' => 'إضافة منتج'],
            ['id' => 47, 'name' => 'Product-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل منتج'],
            ['id' => 48, 'name' => 'Product-Delete', 'guard_name' => 'admin', 'desc' => 'حذف منتج'],

            ['id' => 49, 'name' => 'WorkOn-Add', 'guard_name' => 'admin', 'desc' => 'إضافة العمل علي'],
            ['id' => 50, 'name' => 'WorkOn-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل العمل علي'],
            ['id' => 51, 'name' => 'WorkOn-Delete', 'guard_name' => 'admin', 'desc' => 'حذف العمل علي'],

            ['id' => 52, 'name' => 'Tag-Add', 'guard_name' => 'admin', 'desc' => 'إضافة تاج'],
            ['id' => 53, 'name' => 'Tag-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل تاج'],
            ['id' => 54, 'name' => 'Tag-Delete', 'guard_name' => 'admin', 'desc' => 'حذف تاج'],

            ['id' => 55, 'name' => 'BlogCategory-Add', 'guard_name' => 'admin', 'desc' => 'إضافة قسم للمدونة'],
            ['id' => 56, 'name' => 'BlogCategory-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل قسم للمدونة'],
            ['id' => 57, 'name' => 'BlogCategory-Delete', 'guard_name' => 'admin', 'desc' => 'حذف قسم للمدونة'],

            ['id' => 58, 'name' => 'Blog-Add', 'guard_name' => 'admin', 'desc' => 'إضافة مدونة'],
            ['id' => 59, 'name' => 'Blog-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مدونة'],
            ['id' => 60, 'name' => 'Blog-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مدونة'],

            ['id' => 61, 'name' => 'Payment-Add', 'guard_name' => 'admin', 'desc' => 'إضافة وسيلة دفع'],
            ['id' => 62, 'name' => 'Payment-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل وسيلة دفع'],
            ['id' => 63, 'name' => 'Payment-Delete', 'guard_name' => 'admin', 'desc' => 'حذف وسيلة دفع'],

            ['id' => 64, 'name' => 'Order-Show', 'guard_name' => 'admin', 'desc' => 'عرض اوردر'],
            ['id' => 65, 'name' => 'Order-Delete', 'guard_name' => 'admin', 'desc' => 'حذف اوردر'],

            ['id' => 66, 'name' => 'Report-Show', 'guard_name' => 'admin', 'desc' => 'عرض التقرير'],

            ['id' => 67, 'name' => 'Bank-Add', 'guard_name' => 'admin', 'desc' => 'إضافة بنك'],
            ['id' => 68, 'name' => 'Bank-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل بنك'],
            ['id' => 69, 'name' => 'Bank-Delete', 'guard_name' => 'admin', 'desc' => 'حذف بنك'],

            ['id' => 69, 'name' => 'Online-Payment', 'guard_name' => 'admin', 'desc' => 'الدفع الالكتروني'],

        ];

        foreach ($items as $item) {
            $permission = Permission::updateOrCreate(['id' => $item['id']], $item);
            $permission->save();
            $role = Role::where('name', 'super-admin')->first();

            if (!$role) {
                // Create a super-admin role for the admin users
                $role = Role::create(['guard_name' => 'admin', 'name' => 'super-admin']);
                $role->save();
            }
            $role->givePermissionTo($permission->name);

            $user = Admin::where('email', '=', 'admin@admin.com')->first();
            if (!$user) {
                $user = Admin::create(['email' => 'admin@admin.com', 'password' => '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC',
                             'first_name' => 'admin','last_name' => 'admin', 'guard' => 'admin']);
                $user->save();
            }
            $user->givePermissionTo($permission->id);
        }

        $user_role = Role::where('name', 'registered-users')->first();
        if (!$user_role) {
            // Create a registered-users role for the front users
            $user_role = Role::create(['guard_name' => 'web', 'name' => 'registered-users']);
            $user_role->save();
        }
    }

}
