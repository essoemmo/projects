<?php


namespace App\Bll;


use App\Models\GroupUser;
use App\Models\product\discount_code;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class Discount
{

    public static function checkDiscount($code, $store)
    {
        if ($code != null) {
            $discount = discount_code::leftJoin('discount_codes_data', 'discount_codes_data.discount_code_id', 'discount_codes.id')
                ->where('discount_codes_data.lang_id', getLang(session('lang')))
                ->where('discount_codes.store_id', $store)
                ->where('discount_codes.code', $code)
                ->where('discount_codes.count', '!=', 0)
                ->where('discount_codes.status', '!=', 0)
                ->where('discount_codes.expire_date', '>', Carbon::now())
                ->first();
            if ($discount != null) {
                $discount_items = self::getDiscountItems($discount->id);
//                dd(array_search(0, array_column($discount_items, 'response')) == false); // to check to fails
                if (array_search(0, array_column($discount_items, 'response')) !== false) {
                    return $discount_items;
                }
                return ['response' => 1, 'discount' => $discount];
            } else {
                return ['response' => 0, 'message' => _i('Discount Code Doesn\'t Exists')];
            }
        } else {
            return ['response' => 0, 'message' => _i('Please Enter Discount Code')];
        }
    }

    public static function getDiscount($code, $store)
    {
        $discount = discount_code::leftJoin('discount_codes_data', 'discount_codes_data.discount_code_id', 'discount_codes.id')
            ->where('discount_codes_data.lang_id', getLang(session('lang')))
            ->where('discount_codes.store_id', $store)
            ->where('discount_codes.code', $code)->first();
        if ($discount->count != 0 && $discount->status != 0) {
            $count = $discount->count - 1;
            $discount->update([
                'count' => $count,
            ]);
        }
        return $discount;
    }

    protected static function getDiscountItems($discount)
    {
        $categories = self::itemsCategory($discount);
        $products = self::itemsProduct($discount);
        $user_groups = self::itemsUserGroup($discount);
        return [$categories, $products, $user_groups];
    }

    protected static function itemsCategory($discount)
    {
        $items_category = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'category')
            ->get();

        $items_category_array = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'category')
            ->pluck('item_id')->toArray();

        $cart_array = Cart::content()->pluck('id')->toArray();
        foreach ($cart_array as $cart) {
            $product_category = self::getCategory($cart);
            if (count($items_category) == 1 && $items_category->contains('include_all', 1)) {
                $category = $items_category->contains('include_all', 1);
                if ($category == true) {
                    return ['response' => 1, 'message' => $category];
                }
            } else {
                foreach ($product_category as $product_cat) {
                    if (in_array($product_cat, $items_category_array)) {
                        return ['response' => 1, 'message' => true];
                    } else {
                        $message = _i('Cannot Use Discount Code Product Category not included');
                        return ['response' => 0, 'message' => $message];
                    }
                }
            }
        }
    }

    protected static function itemsProduct($discount)
    {
        $items_product = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'product')
            ->get();

        $items_product_array = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'product')
            ->pluck('item_id')->toArray();

        $cart_array = Cart::content()->pluck('id')->toArray();

        foreach ($cart_array as $cart) {
            if (count($items_product) == 1 && $items_product->contains('include_all', 1)) {
                $product = $items_product->contains('include_all', 1);
                if ($product == true) {
                    return ['response' => 1, 'message' => $product];
                }
            } else {
                if (in_array($cart, $items_product_array)) {
                    return ['response' => 1, 'message' => true];
                } else {
                    $message = _i('Cannot Use Discount Code Product Not included');
                    return ['response' => 0, 'message' => $message];
                }
            }
        }
    }

    protected static function itemsUserGroup($discount)
    {
        $items_user_group = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'user_group')
            ->get();

        $items_user_group_array = discount_code::leftJoin('discount_codes_items', 'discount_codes_items.discount_id', 'discount_codes.id')
            ->where('discount_codes_items.discount_id', $discount)
            ->where('discount_codes_items.type', 'user_group')
            ->pluck('item_id')->toArray();


        $user = auth()->user()->id;

        $user_groups = self::getUserGroup($user);
        if (count($items_user_group) == 1 && $items_user_group->contains('include_all', 1)) {
            $user_group = $items_user_group->contains('include_all', 1);
            if ($user_group == true) {
                return ['response' => 1, 'message' => $user_group];
            }
        } else {
            foreach ($user_groups as $group) {
//                dd(in_array($group, $items_user_group_array), $user_groups, $items_user_group_array);
                if (in_array($group, $items_user_group_array)) {
                    return ['response' => 1, 'message' => true];
                } else {
                    $message = _i('Cannot Use Discount Code (Limited For Custom Users)');
                    return ['response' => 0, 'message' => $message];
                }
            }
        }
    }

    protected static function getCategory($id)
    {
        $categories = DB::table('categories_products')->leftJoin('categories', 'categories.id', 'categories_products.category_id')
            ->where('categories_products.product_id', $id)->pluck('category_id')->toArray();
        return $categories;
    }

    protected static function getUserGroup($id)
    {
        $userGroups = GroupUser::leftJoin('users', 'users.id', 'groups_users.user_id')
            ->where('groups_users.user_id', $id)->pluck('group_id')->toArray();
        return $userGroups;
    }


}
