<?php

use Illuminate\Database\Seeder;

class NotifyTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notify_templates')->insert([
            [
                'code' => 'orderStatusApproved'
            ],
            [
                'code' => 'orderStatusRefused'
            ],
            [
                'code' => 'orderStatusWaiting'
            ],
        ]);

        DB::table('notify_templates_data')->insert([
            [
                'notify_template_id' => 1,
            ],[
                'notify_template_id' => 2,
            ],[
                'notify_template_id' => 3,
            ],
        ]);

        DB::table('notify_templates_translations')->insert([
            [
                'title' => 'تم الموافقة ع الطلب',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'notify_template_id' => 1,
                'locale' => 'ar',
            ],[
                'title' => 'Order Approved',
                'description' => 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}',
                'notify_template_id' => 1,
                'locale' => 'en',
            ],[
                'title' => 'تم رفض الطلب',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'notify_template_id' => 2,
                'locale' => 'ar',
            ],[
                'title' => 'order Refused',
                'description' => 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}',
                'notify_template_id' => 2,
                'locale' => 'en',
            ],[
                'title' => 'جاري مراجعة طلبك',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'notify_template_id' => 3,
                'locale' => 'ar',
            ],[
                'title' => 'Your order is being reviewed',
                'description' => 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}',
                'notify_template_id' => 3,
                'locale' => 'en',
            ]

        ]);

        DB::table('notify_templates_data_translations')->insert([
            [
                'notify_data_id' => 1,
                'subject' => 'تمت الموافقة ع طلبك',
                'body' => '<p>تمت الموافقة ع طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'notify_data_id' => 1,
                'subject' => 'order approved',
                'body' => '<p>order approved {order}</p>',
                'locale' => 'en',
            ],[
                'notify_data_id' => 2,
                'subject' => 'تم رفض طلبك',
                'body' => '<p>تم رفض طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'notify_data_id' => 2,
                'subject' => 'order refused',
                'body' => '<p>order refused {order}</p>',
                'locale' => 'en',
            ],[
                'notify_data_id' => 3,
                'subject' => 'جاري مراجعة طلبك',
                'body' => '<p>جاري مراجعة طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'notify_data_id' => 3,
                'subject' => 'Your order is being reviewed',
                'body' => '<p>Your order is being reviewed {order}</p>',
                'locale' => 'en',
            ],

        ]);
    }
}
