<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Permission-Add', 'guard_name' => 'admin', 'desc' => 'إضافة صلاحية'],
            ['id' => 2, 'name' => 'Permission-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل صلاحية'],
            ['id' => 3, 'name' => 'Permission-Delete', 'guard_name' => 'admin', 'desc' => 'حذف صلاحية'],

            ['id' => 4, 'name' => 'Role-Add', 'guard_name' => 'admin', 'desc' => 'اضافه مجموعه مستخدمين'],
            ['id' => 5, 'name' => 'Role-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مجموعه مستخدمين'],
            ['id' => 6, 'name' => 'Role-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مجموعه مستخدمين'],
            ['id' => 7, 'name' => 'Show-Adminpanel', 'guard_name' => 'admin', 'desc' => 'عرض لوحة التحكم'],

            ['id' => 8, 'name' => 'AdminUser-Add', 'guard_name' => 'admin', 'desc' => 'اضافه ادمن'],
            ['id' => 9, 'name' => 'AdminUser-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل ادمن'],
            ['id' => 10, 'name' => 'AdminUser-Delete', 'guard_name' => 'admin', 'desc' => 'حذف ادمن'],

            ['id' => 11, 'name' => 'FrontUser-Create', 'guard_name' => 'admin', 'desc' => 'اضافه مستخدم'],
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

            ['id' => 22, 'name' => 'City-Add', 'guard_name' => 'admin', 'desc' => 'إضافة مدينة'],
            ['id' => 23, 'name' => 'City-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مدينة'],
            ['id' => 24, 'name' => 'City-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مدينة'],

            ['id' => 25, 'name' => 'Currency-Add', 'guard_name' => 'admin', 'desc' => 'إضافة عملة'],
            ['id' => 26, 'name' => 'Currency-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل عملة'],
            ['id' => 27, 'name' => 'Currency-Delete', 'guard_name' => 'admin', 'desc' => 'حذف عملة'],

            ['id' => 31, 'name' => 'Slider-Add', 'guard_name' => 'admin', 'desc' => 'إضافة سليدر'],
            ['id' => 32, 'name' => 'Slider-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل سليدر'],
            ['id' => 33, 'name' => 'Slider-Delete', 'guard_name' => 'admin', 'desc' => 'حذف سليدر'],

            ['id' => 34, 'name' => 'Tag-Add', 'guard_name' => 'admin', 'desc' => 'إضافة تاج'],
            ['id' => 35, 'name' => 'Tag-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل تاج'],
            ['id' => 36, 'name' => 'Tag-Delete', 'guard_name' => 'admin', 'desc' => 'حذف تاج'],

            ['id' => 37, 'name' => 'BlogCategory-Add', 'guard_name' => 'admin', 'desc' => 'إضافة قسم للمدونة'],
            ['id' => 38, 'name' => 'BlogCategory-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل قسم للمدونة'],
            ['id' => 39, 'name' => 'BlogCategory-Delete', 'guard_name' => 'admin', 'desc' => 'حذف قسم للمدونة'],

            ['id' => 40, 'name' => 'Blog-Add', 'guard_name' => 'admin', 'desc' => 'إضافة مدونة'],
            ['id' => 41, 'name' => 'Blog-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مدونة'],
            ['id' => 42, 'name' => 'Blog-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مدونة'],

            ['id' => 43, 'name' => 'Payment-Add', 'guard_name' => 'admin', 'desc' => 'إضافة وسيلة دفع'],
            ['id' => 44, 'name' => 'Payment-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل وسيلة دفع'],
            ['id' => 45, 'name' => 'Payment-Delete', 'guard_name' => 'admin', 'desc' => 'حذف وسيلة دفع'],

            ['id' => 46, 'name' => 'Order-Show', 'guard_name' => 'admin', 'desc' => 'عرض اوردر'],
            ['id' => 47, 'name' => 'Order-Delete', 'guard_name' => 'admin', 'desc' => 'حذف اوردر'],

            ['id' => 48, 'name' => 'Report-Show', 'guard_name' => 'admin', 'desc' => 'عرض التقرير'],

            ['id' => 49, 'name' => 'Bank-Add', 'guard_name' => 'admin', 'desc' => 'إضافة بنك'],
            ['id' => 50, 'name' => 'Bank-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل بنك'],
            ['id' => 51, 'name' => 'Bank-Delete', 'guard_name' => 'admin', 'desc' => 'حذف بنك'],

            ['id' => 52, 'name' => 'Online-Payment', 'guard_name' => 'admin', 'desc' => 'الدفع الالكتروني'],

            ['id' => 53, 'name' => 'ContentType-Add', 'guard_name' => 'admin', 'desc' => 'إضافة نوع محتوي'],
            ['id' => 54, 'name' => 'ContentType-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل نوع محتوي'],
            ['id' => 55, 'name' => 'ContentType-Delete', 'guard_name' => 'admin', 'desc' => 'حذف نوع محتوي'],

            ['id' => 56, 'name' => 'SocialLink-Add', 'guard_name' => 'admin', 'desc' => 'إضافة وسيلة إجتماعية'],
            ['id' => 57, 'name' => 'SocialLink-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل وسيلة إجتماعية'],
            ['id' => 58, 'name' => 'SocialLink-Delete', 'guard_name' => 'admin', 'desc' => 'حذف وسيلة إجتماعية'],

            ['id' => 59, 'name' => 'Point-Add', 'guard_name' => 'admin', 'desc' => 'إضافة نقاط'],
            ['id' => 60, 'name' => 'Point-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل نقاط'],
            ['id' => 61, 'name' => 'Point-Delete', 'guard_name' => 'admin', 'desc' => 'حذف نقاط'],

            ['id' => 62, 'name' => 'Slider-Add', 'guard_name' => 'admin', 'desc' => 'إضافة سلايدر'],
            ['id' => 63, 'name' => 'Slider-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل سلايدر'],
            ['id' => 64, 'name' => 'Slider-Delete', 'guard_name' => 'admin', 'desc' => 'حذف سلايدر'],

            ['id' => 65, 'name' => 'Banner-Add', 'guard_name' => 'admin', 'desc' => 'إضافة بانر'],
            ['id' => 66, 'name' => 'Banner-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل بانر'],
            ['id' => 67, 'name' => 'Banner-Delete', 'guard_name' => 'admin', 'desc' => 'حذف بانر'],

            ['id' => 68, 'name' => 'FeaturedAd-Add', 'guard_name' => 'admin', 'desc' => 'إضافة اعلان مميز'],
            ['id' => 69, 'name' => 'FeaturedAd-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل اعلان مميز'],
            ['id' => 70, 'name' => 'FeaturedAd-Delete', 'guard_name' => 'admin', 'desc' => 'حذف اعلان مميز'],

            ['id' => 72, 'name' => 'FeaturedUser-Show', 'guard_name' => 'admin', 'desc' => 'عرض الأعضاء المميزة'],
            ['id' => 73, 'name' => 'FeaturedUser-Delete', 'guard_name' => 'admin', 'desc' => 'حذف عضو مميز'],

            ['id' => 74, 'name' => 'SocialAdvert-Add', 'guard_name' => 'admin', 'desc' => 'إضافة اعلان سوشيال'],
            ['id' => 75, 'name' => 'SocialAdvert-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل اعلان سوشيال'],
            ['id' => 76, 'name' => 'SocialAdvert-Delete', 'guard_name' => 'admin', 'desc' => 'حذف اعلان سوشيال'],

            ['id' => 77, 'name' => 'RatingLevel-Add', 'guard_name' => 'admin', 'desc' => 'إضافة مستوي للتقييم'],
            ['id' => 78, 'name' => 'RatingLevel-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل مستوي للتقييم'],
            ['id' => 79, 'name' => 'RatingLevel-Delete', 'guard_name' => 'admin', 'desc' => 'حذف مستوي للتقييم'],

            ['id' => 80, 'name' => 'Footer-Add', 'guard_name' => 'admin', 'desc' => 'إضافة فوتر'],
            ['id' => 81, 'name' => 'Footer-Edit', 'guard_name' => 'admin', 'desc' => 'تعديل فوتر'],
            ['id' => 82, 'name' => 'Footer-Delete', 'guard_name' => 'admin', 'desc' => 'حذف فوتر'],

            ['id' => 83, 'name' => 'UserSetting-Add', 'guard_name' => 'admin', 'desc' => 'اعدادات المستخدمين'],
            ['id' => 84, 'name' => 'Contacts-Show', 'guard_name' => 'admin', 'desc' => 'الرسائل'],
            ['id' => 85, 'name' => 'EmailSetup-Add', 'guard_name' => 'admin', 'desc' => 'اعدادات الايميل'],
            ['id' => 86, 'name' => 'EmailSetup-Edit', 'guard_name' => 'admin', 'desc' => 'اعدادات الايميل'],
            ['id' => 87, 'name' => 'NotifySetup-Edit', 'guard_name' => 'admin', 'desc' => 'اعدادات الاشعارات'],
            ['id' => 88, 'name' => 'NotifySetup-Add', 'guard_name' => 'admin', 'desc' => 'اعدادات الاشعارات'],

            ['id' => 89, 'name' => 'FrontUser-Add', 'guard_name' => 'admin', 'desc' => 'اضافه مستخدم'],

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
                    'first_name' => 'admin', 'last_name' => 'admin', 'guard' => 'admin']);
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
