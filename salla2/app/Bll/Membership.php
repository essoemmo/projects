<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

use App\Models\settings\StoreOption;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Description of Membership
 *
 * @author fz
 */
class Membership
{

    //put your code here
    public static function getPackage()
    {
        if (session()->has('memebr_id')) {
            $memberships = \App\Models\Membership\Membership::
            where('is_active', '=', 1)
                ->where('id', session('memebr_id'))
                ->first();
            return $memberships;
        }

        $memberships = \App\Models\Membership\Membership::
        where('is_active', '=', 1)->
        where('price', 0)
            ->first();
        return $memberships;
    }

    private function saveSetting($request, $storeId)
    {
        $settings = new \App\Setting\Setting();
        $settings->email = $request["email"];
        $settings->phone1 = $request["phone"];
        $settings->store_id = $storeId;

        $settings->save();
        \App\Models\Settings\SettingsData::create([
            'title' => $request["title"],
            'setting_id' => $settings->id,
            'lang_id' => getLang(session('lang')),
        ]);
        //$settings->save();
    }

    private function CreateDefaults($storeId)
    {

        \Illuminate\Support\Facades\DB::insert("insert into categories(store_id,title,description,number,parent_id,lang_id) select {$storeId},title,description,number,parent_id,lang_id  from categories where store_id is null and parent_id is null");
        $codes = \App\Models\ProductTypeCodeData::all();
        foreach ($codes as $code) {
            $id = \App\Models\Product_type::create(['store_id' => $storeId,
                'type_code' => $code->product_types_cod_id])->id;
            \App\Models\ProductTypeData::create(["product_types_id" => $id,
                "lang_id" => $code->lang_id,
                "title" => $code->title,
                "description" => $code->description]);
        }
    }

    public function CreateStore($data, $memberships)
    {

        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $memberships) {
            $duration = $memberships->duration;
            $membership_expire = date('Y-m-d', strtotime("+" . $duration . " years"));
            $owner = \App\User::create([
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                //    'country_id' => $data['country_id'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'guard' => \App\Help\Utility::Store,
                'password' => Hash::make($data['password']),
            ]);

            $storeData = \App\StoreData::create([
                'owner_id' => $owner->id,
                'title' => $data['title'],
                'domain' => $data['domain'],
                'membership_id' => $memberships->id,
                'lang_id' => getLang(session('lang')),
            ]);

            \App\StoreUsers::create([
                'user_id' => $owner->id,
                'store_id' => $storeData->id,
            ]);

            StoreOption::create([
                'store_id' => $storeData->id
            ]);

            $this->CreateDefaults($storeData->id);


            \App\membershipUser::create([
                'user_id' => $owner->id,
                'membership_id' => $memberships->id,
                'price' => $memberships->price,
                'expire_at' => $membership_expire,
                'created' => date('Y-m-d')
            ]);

            $user = \App\StoreUser::find($owner->id);
//        $user->assignRole("super-store");

            $this->saveSetting($data, $storeData->id);

            //$membership_permissions = Membership_perm::where('membership_id',$memberships->id)->get();
            $membership_permissions = \App\Models\Membership\MembershipOptions::
            leftJoin('membership_option_perms', 'membership_option_perms.option_id', 'membership_options.option_id')
                ->select('membership_option_perms.perm_id as perm_id', 'membership_options.option_id as option_id')
                ->where('membership_options.membership_id', $memberships->id)->get();

            foreach ($membership_permissions as $permission) {
                $user->givePermissionTo($permission->perm_id);
            }
            //default perms
            $perms = ["Slider-Add", "Slider-Edit", "Slider-Delete",
                "Role-Add", "Role-Edit", "Role-Delete",
                "Settings-Add",
//                "Users-Group",
                "Brand-Add", "Brand-Edit", "Brand-Delete",
                "Contact-Show", "Contact-Add", "Contact-Edit", "Contact-Delete"];

            foreach ($perms as $item) {
                $permission = \Spatie\Permission\Models\Permission::where("name", $item)->first();
                if ($permission !== null)
                    $user->givePermissionTo($permission->id);
            }

            $dataa = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];
            if (config("app.env") != "local") {
                Mail::send('emails.verifyemail', $dataa, function ($message) use ($user) {
                    \App\sendemail::sendemail($message, $user);
                });
            }
            return $owner;
        });
    }

}
