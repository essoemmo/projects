<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->insert([
            [
                'code' => 'VerificationEmail'
            ],
            [
                'code' => 'UserResetPassword'
            ],
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

        DB::table('email_templates_data')->insert([
            [
                'from_email' => 'support@ashhrni.com',
                'email_template_id' => 1,
            ],[
                'from_email' => 'support@ashhrni.com',
                'email_template_id' => 2,
            ],[
                'from_email' => 'support@ashhrni.com',
                'email_template_id' => 3,
            ],[
                'from_email' => 'support@ashhrni.com',
                'email_template_id' => 4,
            ],[
                'from_email' => 'support@ashhrni.com',
                'email_template_id' => 5,
            ],
        ]);

        DB::table('email_templates_translations')->insert([
            [
                'title' => 'Verification Email',
                'description' => 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write code {code} to write site name {siteName} to write order {order}',
                'email_template_id' => 1,
                'locale' => 'en',
            ],[
                'title' => 'التحقق من البريد الإلكتروني',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة رمز {code} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'email_template_id' => 1,
                'locale' => 'ar',
            ],
            [
                'title' => 'User Forget Password',
                'description' => 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}',
                'email_template_id' => 2,
                'locale' => 'en',
            ],[
                'title' => 'نسيت كلمة المرور للمستخدم',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'email_template_id' => 2,
                'locale' => 'ar',
            ],[
                'title' => 'تم الموافقة ع الطلب',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'email_template_id' => 3,
                'locale' => 'ar',
            ],[
                'title' => 'Order Approved',
                'description' => 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}',
                'email_template_id' => 3,
                'locale' => 'en',
            ],[
                'title' => 'تم رفض الطلب',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'email_template_id' => 4,
                'locale' => 'ar',
            ],[
                'title' => 'order Refused',
                'description' => 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}',
                'email_template_id' => 4,
                'locale' => 'en',
            ],[
                'title' => 'جاري مراجعة طلبك',
                'description' => 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}',
                'email_template_id' => 5,
                'locale' => 'ar',
            ],[
                'title' => 'Your order is being reviewed',
                'description' => 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}',
                'email_template_id' => 5,
                'locale' => 'en',
            ]

        ]);

        DB::table('email_templates_data_translations')->insert([
            [
                'email_template_data_id' => 1,
                'subject' => 'التحقق من البريد الإلكتروني',
                'body' => '<p>مرحبًا بكم في الموقع {userFirstName} {userLastName} ،</p><p>معرف البريد الإلكتروني المسجل الخاص بك هو {userEmail} ، يرجى نسخ الكود أدناه للتحقق من حساب بريدك الإلكتروني</p><p>&nbsp;، رمز التحقق الخاص بك هو {code}</p>',
                'locale' => 'ar',
            ],[
                'email_template_data_id' => 1,
                'subject' => 'verfiy email',
                'body' => '<p>Welcome to the site {userFirstName} {userLastName},</p><p>Your registered email-id is {userEmail} , Please copy the below code to verify your email account,</p><p>Your verification Code is {code}</p>',
                'locale' => 'en',
            ],
            [
                'email_template_data_id' => 2,
                'subject' => 'استرجاع كلمة المرور',
                'body' => '<h2><strong>مرحبًا {userFirstName} {userLastName} ،</strong></h2></p>لقد طلبت مؤخرًا إعادة تعيين كلمة المرور لحساب {siteName} الخاص بك. استخدم الزر أدناه لإعادة ضبطه. إعادة تعيين كلمة المرور هذه صالحة فقط لمدة 24 ساعة.<p>',
                'locale' => 'ar',
            ],[
                'email_template_data_id' => 2,
                'subject' => 'reset your password',
                'body' => '<h2><strong>Hi {userFirstName} {userLastName},</strong></h2><p>You recently requested to reset your password for your {siteName} account. Use the button below to reset it. <strong>This password reset is only valid for the next 24 hours.</strong></p>',
                'locale' => 'en',
            ],[
                'email_template_data_id' => 3,
                'subject' => 'تمت الموافقة ع طلبك',
                'body' => '<p>تمت الموافقة ع طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'email_template_data_id' => 3,
                'subject' => 'order approved',
                'body' => '<p>order {order} approved</p>',
                'locale' => 'en',
            ],[
                'email_template_data_id' => 4,
                'subject' => 'تم رفض طلبك',
                'body' => '<p>تم رفض طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'email_template_data_id' => 4,
                'subject' => 'order refused',
                'body' => '<p>order {order} refused</p>',
                'locale' => 'en',
            ],[
                'email_template_data_id' => 5,
                'subject' => 'جاري مراجعة طلبك',
                'body' => '<p>جاري مراجعة طلبك {order}</p>',
                'locale' => 'ar',
            ],[
                'email_template_data_id' => 5,
                'subject' => 'Your order is being reviewed',
                'body' => '<p>Your order {order} is being reviewed</p>',
                'locale' => 'en',
            ],

        ]);
    }
}
