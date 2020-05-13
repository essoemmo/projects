<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            ['id' => 1, 'name' => 'Permission-Add', 'guard_name' => 'web', 'desc' => 'إضافة صلاحية'],
            ['id' => 2, 'name' => 'Permission-Edit', 'guard_name' => 'web', 'desc' => 'تعديل صلاحية'],
            ['id' => 3, 'name' => 'Permission-Delete', 'guard_name' => 'web', 'desc' => 'حذف صلاحية'],
            ['id' => 4, 'name' => 'Role-Add', 'guard_name' => 'web', 'desc' => 'اضافه مجموعه مستخدمين'],
            ['id' => 5, 'name' => 'Role-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مجموعه مستخدمين'],
            ['id' => 7, 'name' => 'Role-Delete', 'guard_name' => 'web' , 'desc' => 'حذف مجموعه مستخدمين'],
            ['id' => 8, 'name' => 'Show-Adminpanel', 'guard_name' => 'web', 'desc' => 'عرض لوحة التحكم'],
            ['id' => 9, 'name' => 'User-Add', 'guard_name' => 'web', 'desc' => 'اضافه مستخدم'],
            ['id' => 10, 'name' => 'User-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مستخدم'],
            ['id' => 11, 'name' => 'User-Delete', 'guard_name' => 'web', 'desc' => 'حذف مستخدم'],

            ['id' => 12, 'name' => 'Trainer-Add', 'guard_name' => 'web', 'desc' => 'اضافه مدرب'],
            ['id' => 13, 'name' => 'Trainer-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مدرب'],
            ['id' => 14, 'name' => 'Trainer-Delete', 'guard_name' => 'web', 'desc' => 'حذف مدرب'],

            ['id' => 15, 'name' => 'Course-Add', 'guard_name' => 'web', 'desc' => 'اضافه دورة تدريبيه'],
            ['id' => 16, 'name' => 'Course-Edit', 'guard_name' => 'web', 'desc' => 'تعديل دورة تدريبيه'],
            ['id' => 17, 'name' => 'Course-Delete', 'guard_name' => 'web', 'desc' => 'حذف دورة تدريبية'],
            ['id' => 18, 'name' => 'CourseCategory-Add', 'guard_name' => 'web', 'desc' => 'إضافة قسم للدورة التدريبية'],
            ['id' => 19, 'name' => 'CourseCategory-Edit', 'guard_name' => 'web', 'desc' => 'تعديل قسم للدورة التدريبية'],
            ['id' => 20, 'name' => 'CourseCategory-Delete', 'guard_name' => 'web', 'desc' => 'حذف قسم للدورة التدريبية'],
            ['id' => 21, 'name' => 'Course-Video', 'guard_name' => 'web', 'desc' => 'إضافة فديو'],

            ['id' => 22, 'name' => 'Applicant-Add', 'guard_name' => 'web', 'desc' => 'إضاف متدرب'],
            ['id' => 24, 'name' => 'Applicant-Edit', 'guard_name' => 'web', 'desc' => 'تعديل متدرب'],
            ['id' => 25, 'name' => 'Applicant-Delete', 'guard_name' => 'web', 'desc' => 'حذف متدرب'],

            ['id' => 26, 'name' => 'City-Add', 'guard_name' => 'web', 'desc' => 'إضافة مدينة'],
            ['id' => 27, 'name' => 'City-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مدينة'],
            ['id' => 28, 'name' => 'City-Delete', 'guard_name' => 'web', 'desc' => 'حذف مدينة'],

            ['id' => 29, 'name' => 'Country-Add', 'guard_name' => 'web', 'desc' => 'إضافة دولة'],
            ['id' => 30, 'name' => 'Country-Edit', 'guard_name' => 'web', 'desc' => 'تعديل دولة'],
            ['id' => 31, 'name' => 'Country-Delete', 'guard_name' => 'web', 'desc' => 'حذف دولة'],

            ['id' => 32, 'name' => 'ApplicantPending-Add', 'guard_name' => 'web', 'desc' => 'إضافة طلب متدرب لكورس'],
            ['id' => 33, 'name' => 'ApplicantPending-Delete', 'guard_name' => 'web', 'desc' => 'حذف طلب متدرب لكورس'],

            ['id' => 34, 'name' => 'Article-Add', 'guard_name' => 'web', 'desc' => 'إضافة مقال'],
            ['id' => 35, 'name' => 'Article-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مقال'],
            ['id' => 36, 'name' => 'Article-Delete', 'guard_name' => 'web', 'desc' => 'حذف مقال'],
            ['id' => 37, 'name' => 'ArticleCategory-Add', 'guard_name' => 'web', 'desc' => 'إضافة قسم للمقال'],
            ['id' => 38, 'name' => 'ArticleCategory-Edit', 'guard_name' => 'web', 'desc' => 'تعديل قسم للمقال'],
            ['id' => 39, 'name' => 'ArticleCategory-Delete', 'guard_name' => 'web', 'desc' => 'حذف قسم للمقال'],
            ['id' => 40, 'name' => 'NewsLetters-Add', 'guard_name' => 'web', 'desc' => 'إضافة عضو للنشرة الإخبارية'],
            ['id' => 41, 'name' => 'NewsLetters-Edit', 'guard_name' => 'web', 'desc' => 'تعديل عضو للنشرة الإخبارية'],
            ['id' => 42, 'name' => 'NewsLetters-Delete', 'guard_name' => 'web', 'desc' => 'حذف عضو للنشرة الإخبارية'],

            ['id' => 43, 'name' => 'CourseComments-Show', 'guard_name' => 'web', 'desc' => 'عرض تعليق للدورة التدريبية'],
            ['id' => 44, 'name' => 'CourseComments-Delete', 'guard_name' => 'web', 'desc' => 'حذف تعليق للدورة التدريبية'],
//BankTransfer
            ['id' => 45, 'name' => 'BankTransfer-Add', 'guard_name' => 'web', 'desc' => ' اضافه بنك '],
            ['id' => 46, 'name' => 'BankTransfer-Edit', 'guard_name' => 'web', 'desc' => 'تعديل  بنك '],
            ['id' => 47, 'name' => 'BankTransfer-Delete', 'guard_name' => 'web', 'desc' => 'حذف بنك '],
            //Gallery-Add
            ['id' => 48, 'name' => 'Gallery-Add', 'guard_name' => 'web', 'desc' => ' اضافه جاليري '],
            ['id' => 49, 'name' => 'Gallery-Edit', 'guard_name' => 'web', 'desc' => 'تعديل  جاليري '],
            ['id' => 50, 'name' => 'Gallery-Delete', 'guard_name' => 'web', 'desc' => 'حذف جاليري '],

            ['id' => 51, 'name' => 'TransactionType-Add', 'guard_name' => 'web', 'desc' => 'إضافة نوع معاملة'],
            ['id' => 52, 'name' => 'TransactionType-Edit', 'guard_name' => 'web', 'desc' => 'تعديل نوع معاملة'],
            ['id' => 53, 'name' => 'TransactionType-Delete', 'guard_name' => 'web', 'desc' => 'حذف نوع معاملة'],

            ['id' => 54, 'name' => 'Transactions-Show', 'guard_name' => 'web', 'desc' => 'إظهار العمليات المالية'],

            ['id' => 55, 'name' => 'Course-Exam-Add', 'guard_name' => 'web', 'desc' => 'إضافة إختبار للدورة'],
            ['id' => 56, 'name' => 'Course-Exam-Edit', 'guard_name' => 'web', 'desc' => 'تعديل إختبار للدورة'],
            ['id' => 57, 'name' => 'Course-Exam-Delete', 'guard_name' => 'web', 'desc' => 'حذف إختبار للدورة'],

            ['id' => 58, 'name' => 'Competition-Add', 'guard_name' => 'web', 'desc' => 'إضافة مسابقة'],
            ['id' => 59, 'name' => 'Competition-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مسابقة'],
            ['id' => 60, 'name' => 'Competition-Delete', 'guard_name' => 'web', 'desc' => 'حذف مسابقة'],

            ['id' => 61, 'name' => 'Bill-Add', 'guard_name' => 'web', 'desc' => 'إضافة فاتورة'],
            ['id' => 62, 'name' => 'Bill-Edit', 'guard_name' => 'web', 'desc' => 'تعديل فاتورة'],
            ['id' => 63, 'name' => 'Bill-Delete', 'guard_name' => 'web', 'desc' => 'حذف فاتورة'],

            ['id' => 64, 'name' => 'Settings-Add', 'guard_name' => 'web', 'desc' => 'إضافة إعدادات'],
            ['id' => 65, 'name' => 'Settings-Edit', 'guard_name' => 'web', 'desc' => 'تعديل إعدادات'],
            ['id' => 66, 'name' => 'Settings-Delete', 'guard_name' => 'web', 'desc' => 'حذف إعدادات'] ,

            ['id' => 67, 'name' => 'Rating-Show', 'guard_name' => 'web', 'desc' => 'عرض التقييم'],
            ['id' => 68, 'name' => 'Rating-Delete', 'guard_name' => 'web', 'desc' => 'حذف التقييم'],

            ['id' => 69, 'name' => 'EducationLevel-Add', 'guard_name' => 'web', 'desc' => 'إضافة مستوي تعليمي'],
            ['id' => 70, 'name' => 'EducationLevel-Edit', 'guard_name' => 'web', 'desc' => 'تعديل مستوي تعليمي'],
            ['id' => 71, 'name' => 'EducationLevel-Delete', 'guard_name' => 'web', 'desc' => 'حذف مستوي تعليمي'],

            ['id' => 72, 'name' => 'Contact-Show', 'guard_name' => 'web', 'desc' => 'إظهار الرسالة'],
            ['id' => 73, 'name' => 'Contact-Delete', 'guard_name' => 'web', 'desc' => 'حذف الرسالة'],

            ['id' => 74, 'name' => 'Currency-Add', 'guard_name' => 'web', 'desc' => 'إضافة عملة'],
            ['id' => 75, 'name' => 'Currency-Edit', 'guard_name' => 'web', 'desc' => 'تعديل عملة'],
            ['id' => 76, 'name' => 'Currency-Delete', 'guard_name' => 'web', 'desc' => 'حذف عملة'],

            ['id' => 77, 'name' => 'Language-Change', 'guard_name' => 'web', 'desc' => 'تغيير اللغة'],
            ['id' => 78, 'name' => 'Notification-Show', 'guard_name' => 'web', 'desc' => 'إظهار الإشعارات'],

            ['id' => 79, 'name' => 'UserMessage-Controll', 'guard_name' => 'web', 'desc' => 'التحكم في الرسائل المرسلة إلي الطلاب'],

            ['id' => 80, 'name' => 'AdminPanel-Show', 'guard_name' => 'web', 'desc' => 'عرض لوحة تحكم الادمن'],

            ['id' => 81, 'name' => 'CourseRequest-Controll', 'guard_name' => 'web', 'desc' => 'التحكم في طلب الدورة'],


        ];

        foreach ($items as $item) {
            $permission = Permission::updateOrCreate(['id' => $item['id']], $item);
            $permission->save();
            $role = Role::where('name', 'super-admin')->first();

            if (!$role) {
                // Create a super-admin role for the admin users
                $role = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);
                $role->save();
            }
            $role->givePermissionTo($permission->name);

            $user = User::where('email', '=', 'admin@admin.com')->first();
            if (!$user) {
                $user = User::create(['email' => 'admin@admin.com', 'password' => '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC',
                            'is_admin' => '1', 'name' => 'admin']);
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
