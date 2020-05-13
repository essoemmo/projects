<?php

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
            ['id' => 1, 'name' => 'Permission-Add', 'guard_name' => 'store', 'desc' => 'إضافة صلاحية'],
            ['id' => 2, 'name' => 'Permission-Edit', 'guard_name' => 'store', 'desc' => 'تعديل صلاحية'],
            ['id' => 3, 'name' => 'Permission-Delete', 'guard_name' => 'store', 'desc' => 'حذف صلاحية'],

            ['id' => 4, 'name' => 'Role-Add', 'guard_name' => 'store', 'desc' => 'إضافه مجموعه مستخدمين'],
            ['id' => 5, 'name' => 'Role-Edit', 'guard_name' => 'store', 'desc' => 'تعديل مجموعه مستخدمين'],
            ['id' => 6, 'name' => 'Role-Delete', 'guard_name' => 'store', 'desc' => 'حذف مجموعه مستخدمين'],

            ['id' => 7, 'name' => 'AdminUser-Add', 'guard_name' => 'store', 'desc' => 'إضافة ادمن'],
            ['id' => 8, 'name' => 'AdminUser-Edit', 'guard_name' => 'store', 'desc' => 'تعديل ادمن'],
            ['id' => 9, 'name' => 'AdminUser-Delete', 'guard_name' => 'store', 'desc' => 'حذف ادمن'],

            ['id' => 10, 'name' => 'Content-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 11, 'name' => 'Content-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 12, 'name' => 'Content-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 13, 'name' => 'Article-Add', 'guard_name' => 'store', 'desc' => 'إضافة مقال'],
            ['id' => 14, 'name' => 'Article-Edit', 'guard_name' => 'store', 'desc' => 'تعديل مقال'],
            ['id' => 15, 'name' => 'Article-Delete', 'guard_name' => 'store', 'desc' => 'حذف مقال'],

            ['id' => 16, 'name' => 'ArticleCategory-Add', 'guard_name' => 'store', 'desc' => 'إضافة قسم للمقال'],
            ['id' => 17, 'name' => 'ArticleCategory-Edit', 'guard_name' => 'store', 'desc' => 'تعديل قسم للمقال'],
            ['id' => 18, 'name' => 'ArticleCategory-Delete', 'guard_name' => 'store', 'desc' => 'حذف قسم للمقال'],

            ['id' => 19, 'name' => 'Language-Add', 'guard_name' => 'store', 'desc' => 'إضافة لغة'],
            ['id' => 20, 'name' => 'Language-Edit', 'guard_name' => 'store', 'desc' => 'تعديل لغة'],
            ['id' => 21, 'name' => 'Language-Delete', 'guard_name' => 'store', 'desc' => 'حذف لغة'],

            ['id' => 22, 'name' => 'Country-Add', 'guard_name' => 'store', 'desc' => 'إضافة دولة'],
            ['id' => 23, 'name' => 'Country-Edit', 'guard_name' => 'store', 'desc' => 'تعديل دولة'],
            ['id' => 24, 'name' => 'Country-Delete', 'guard_name' => 'store', 'desc' => 'حذف دولة'],

            ['id' => 25, 'name' => 'City-Add', 'guard_name' => 'store', 'desc' => 'إضافة مدينة'],
            ['id' => 26, 'name' => 'City-Edit', 'guard_name' => 'store', 'desc' => 'تعديل مدينة'],
            ['id' => 27, 'name' => 'City-Delete', 'guard_name' => 'store', 'desc' => 'حذف مدينة'],

            ['id' => 28, 'name' => 'Currency-Add', 'guard_name' => 'store', 'desc' => 'إضافة عملة'],
            ['id' => 29, 'name' => 'Currency-Edit', 'guard_name' => 'store', 'desc' => 'تعديل عملة'],
            ['id' => 30, 'name' => 'Currency-Delete', 'guard_name' => 'store', 'desc' => 'حذف عملة'],

            ['id' => 31, 'name' => 'Slider-Add', 'guard_name' => 'store', 'desc' => 'إضافة سلايدر'],
            ['id' => 32, 'name' => 'Slider-Edit', 'guard_name' => 'store', 'desc' => 'تعديل سلايدر'],
            ['id' => 33, 'name' => 'Slider-Delete', 'guard_name' => 'store', 'desc' => 'حذف سلايدر'],

            ['id' => 34, 'name' => 'Banner-Add', 'guard_name' => 'store', 'desc' => 'إضافة بانر'],
            ['id' => 35, 'name' => 'Banner-Edit', 'guard_name' => 'store', 'desc' => 'تعديل بانر'],
            ['id' => 36, 'name' => 'Banner-Delete', 'guard_name' => 'store', 'desc' => 'حذف بانر'],

            ['id' => 37, 'name' => 'translation-Add', 'guard_name' => 'store', 'desc' => 'إضافة ترجمة'],
            ['id' => 38, 'name' => 'translation-Edit', 'guard_name' => 'store', 'desc' => 'تعديل ترجمة'],
            ['id' => 39, 'name' => 'translation-Delete', 'guard_name' => 'store', 'desc' => 'حذف ترجمة'],

            ['id' => 40, 'name' => 'BankTransfer-Add', 'guard_name' => 'store', 'desc' => 'إضافة تحويلات بنكية'],
            ['id' => 41, 'name' => 'BankTransfer-Edit', 'guard_name' => 'store', 'desc' => 'تعديل تحويلات بنكية'],
            ['id' => 42, 'name' => 'BankTransfer-Delete', 'guard_name' => 'store', 'desc' => 'حذف تحويلات بنكية'],

            ['id' => 43, 'name' => 'Feature-Add', 'guard_name' => 'store', 'desc' => 'إضافة سمات'],
            ['id' => 44, 'name' => 'Feature-Edit', 'guard_name' => 'store', 'desc' => 'تعديل سمات'],
            ['id' => 45, 'name' => 'Feature-Delete', 'guard_name' => 'store', 'desc' => 'حذف سمات'],

            ['id' => 46, 'name' => 'Product-Add', 'guard_name' => 'store', 'desc' => 'إضافة منتج'],
            ['id' => 47, 'name' => 'Product-Edit', 'guard_name' => 'store', 'desc' => 'تعديل منتج'],
            ['id' => 48, 'name' => 'Product-Delete', 'guard_name' => 'store', 'desc' => 'حذف منتج'],

            ['id' => 49, 'name' => 'ProductType-Add', 'guard_name' => 'store', 'desc' => 'إضافة نوع منتج'],
            ['id' => 50, 'name' => 'ProductType-Edit', 'guard_name' => 'store', 'desc' => 'تعديل نوع منتج'],
            ['id' => 51, 'name' => 'ProductType-Delete', 'guard_name' => 'store', 'desc' => 'حذف نوع منتج'],

            ['id' => 52, 'name' => 'ProductCategory-Add', 'guard_name' => 'store', 'desc' => 'إضافة قسم للمنتج'],
            ['id' => 53, 'name' => 'ProductCategory-Edit', 'guard_name' => 'store', 'desc' => 'تعديل قسم للمنتج'],
            ['id' => 54, 'name' => 'ProductCategory-Delete', 'guard_name' => 'store', 'desc' => 'حذف قسم للمنتج'],

            ['id' => 55, 'name' => 'ShippingOption-Add', 'guard_name' => 'store', 'desc' => 'إضافة خيارات للشحن'],
            ['id' => 56, 'name' => 'ShippingOption-Edit', 'guard_name' => 'store', 'desc' => 'تعديل خيارات للشحن'],
            ['id' => 57, 'name' => 'ShippingOption-Delete', 'guard_name' => 'store', 'desc' => 'حذف خيارات للشحن'],

            ['id' => 58, 'name' => 'TransactionType-Add', 'guard_name' => 'store', 'desc' => 'إضافة نوع معاملة'],
            ['id' => 59, 'name' => 'TransactionType-Edit', 'guard_name' => 'store', 'desc' => 'تعديل نوع معاملة'],
            ['id' => 60, 'name' => 'TransactionType-Delete', 'guard_name' => 'store', 'desc' => 'حذف نوع معاملة'],

            ['id' => 61, 'name' => 'ShippingCompany-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 62, 'name' => 'ShippingCompany-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 63, 'name' => 'ShippingCompany-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 64, 'name' => 'Order-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 65, 'name' => 'Order-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 66, 'name' => 'Order-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 67, 'name' => 'Ticket-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 68, 'name' => 'Ticket-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 69, 'name' => 'Ticket-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 70, 'name' => 'TicketCategory-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 71, 'name' => 'TicketCategory-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 72, 'name' => 'TicketCategory-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 73, 'name' => 'TicketPriority-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 74, 'name' => 'TicketPriority-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 75, 'name' => 'TicketPriority-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],

            ['id' => 76, 'name' => 'TicketAgent-Add', 'guard_name' => 'store', 'desc' => 'إضافة محتوي'],
            ['id' => 77, 'name' => 'TicketAgent-Edit', 'guard_name' => 'store', 'desc' => 'تعديل محتوي'],
            ['id' => 78, 'name' => 'TicketAgent-Delete', 'guard_name' => 'store', 'desc' => 'حذف محتوي'],


            ['id' => 79, 'name' => 'Show-Adminpanel', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 80, 'name' => 'Settings-Add', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 81, 'name' => 'Stores-Show', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 82, 'name' => 'Comment-Show', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 83, 'name' => 'Contact-Show', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 84, 'name' => 'Chat-Show', 'guard_name' => 'store', 'desc' => 'عرض لوحة التحكم'],


        ];

        foreach ($items as $item) {
            $permission = Permission::updateOrCreate(['id' => $item['id']], $item);
            $permission->save();
            $store_role = Role::where('name', 'super-store')->first();
            if (!$store_role) {
                // Create a super-admin role for the admin users
                $store_role = Role::create(['guard_name' => 'store', 'name' => 'super-store']);
                $store_role->save();
            }
            $store_role->givePermissionTo($permission->name);

            $store_user = \App\StoreUser::where('email', '=', 'user_one@user.com')->first();
            if (!$store_user) {
                $store_user = \App\StoreUser::create(['email' => 'fz@yahoo.com', 'password' => '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC',
                    "guard" => "store", 'name' => 'store']);
                $store_user->save();
            }
            $store_user->givePermissionTo($permission->id);

        }

        /// admin permissions
//        $admin_items = [
//            ['id' => 85, 'name' => 'MasterPermission-Add', 'guard_name' => 'admin'],
//            ['id' => 86, 'name' => 'MasterPermission-Edit', 'guard_name' => 'admin'],
//            ['id' => 87, 'name' => 'MasterPermission-Delete', 'guard_name' => 'admin'],
//
//            ['id' => 88, 'name' => 'MasterRole-Add', 'guard_name' => 'admin'],
//            ['id' => 89, 'name' => 'MasterRole-Edit', 'guard_name' => 'admin'],
//            ['id' => 90, 'name' => 'MasterRole-Delete', 'guard_name' => 'admin'],
//
//            ['id' => 91, 'name' => 'MasterUser-Add', 'guard_name' => 'admin'],
//            ['id' => 92, 'name' => 'MasterUser-Edit', 'guard_name' => 'admin'],
//            ['id' => 93, 'name' => 'MasterUser-Delete', 'guard_name' => 'admin'],
//
//            ['id' => 94, 'name' => 'MasterStore-Show', 'guard_name' => 'admin'],
//        ];
//        foreach ($admin_items as $item) {
//            $permission = Permission::updateOrCreate(['id' => $item['id']], $item);
//            $permission->save();
//            $admin_role = Role::where('name', 'Master')->first();
//            if (!$admin_role) {
//                // Create a super-admin role for the admin users
//                $admin_role = Role::create(['guard_name' => 'admin', 'name' => 'Master']);
//                $admin_role->save();
//            }
//            $admin_role->givePermissionTo($permission->name);
//
//            $admin_user = \App\Admin::where('email', '=', 'admin@admin.com')->first();
//            if (!$admin_user) {
//                $admin_user = \App\Admin::create(['email' => 'admin@admin.com', 'password' => '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC',
//                    "guard" => "admin", 'name' => 'admin']);
//                $admin_user->save();
//            }
//            $admin_user->givePermissionTo($permission->id);
//
//        }

    } //  commend used => php artisan db:seed --class="PermissionsTableSeeder"
}
