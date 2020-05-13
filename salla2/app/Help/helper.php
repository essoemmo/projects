<?php


use App\Models\Settings\Setting;
use Illuminate\Support\Facades\Cookie;

function getGuard()
{
    $utility = new \App\Help\Utility();
    $guard_name = $utility->get_guard();
    return $guard_name;
}

// function getStoreId($id){
//     $store = App\Models\product\stores::where('id',$id)->first();
//     return $store['id'];
// }
function getCategoryHomepage($sort = null, $storeId = null)
{
    $homepage = \App\Models\Settings\homepage::where('sort', $sort)->where('store_id', $storeId)->first();
    if ($homepage != null) {
        return $homepage->category;
    } else {
        return null;
    }
}

// function checktemplate($category_id = null){
//     $homepage = \App\Models\Settings\homepage::whereHas('category',function ($query) use ($category_id){
//         $query->where('id',$category_id);
//     })->first();
//     return $homepage->template;
// }
function responseJson($status, $message, $data = null)
{
    $response =
        [
            'status' => $status,
            'msg' => $message,
            'data' => $data
        ];
    return response()->json($response, JSON_UNESCAPED_UNICODE);
}

if (!function_exists('membership_details')) {
    function membership_details($membership_id)
    {
        $permissions_data = [];
        $membership_perm = \App\Models\Membership\Membership_perm::where('membership_id', $membership_id)->get();
        foreach ($membership_perm as $single) {
            $permission = \Spatie\Permission\Models\Permission::where('id', $single->prm_id)->first();
            $permission_data = \App\Models\Membership\Permission_data::where('permission_id', $permission->id)->first();
            $permissions_data [] = $permission_data;
        }
        return $permissions_data;

    }
}


if (!function_exists('ticket_count')) {
    function ticket_count($sign = null)
    {
        return \App\ticket::where('status', $sign, '1')->count();
    }
}
if (!function_exists('categoryCount')) {
    function categoryCount($id)
    {
        $sub_categories = \App\Models\Category::where('parent_id', $id)->get();
        return count($sub_categories);
    }
}

if (!function_exists('setting')) {
    function setting($value = null)
    {
        return Setting::orderBy('id', 'desc')->where('store_id', session('StoreId'))->first();
    }
}
if (!function_exists('frontSetting')) {
    function frontSetting($value = null)
    {
        return Setting::orderBy('id', 'desc')->where('store_id', null)->first();
    }
}


//public function uploadFile($request , $path = '/public/uploads/finances/' )
//{
//    $fileName = $request->getClientOriginalName();
//    $request->move(
//        base_path().$path , $fileName
//    );
//
//    return $fileName ;
//
//}

if (!function_exists('ticket_count')) {
    function ticket_count($sign = null)
    {
        return \App\ticket::where('status', $sign, '1')->count();
    }
}
if (!function_exists('categoryCount')) {
    function categoryCount($id)
    {
        $sub_categories = \App\Models\Category::where('parent_id', $id)->get();
        return count($sub_categories);
    }
}
if (!function_exists('existRate')) {
    function existRate($id, $product_id)
    {
        $rating = App\Models\rating\rating::where('product_id', $product_id)->first();
        $exist = \App\Models\rating\userRating::where('user_id', $id)->where('rating_id', $rating['id'])->first();
        if ($exist['comment'] != null) {
            return true;
        }
        return false;
    }
}
if (!function_exists('Rate')) {
    function Rate($id, $product_id)
    {
        $rating = App\Models\rating\rating::where('product_id', $product_id)->first();
        $exist = \App\Models\rating\userRating::where('user_id', $id)->where('rating_id', $rating['id'])->first();
        if ($exist['rating'] != null) {
            return true;
        }
        return false;
    }
}

if (!function_exists('Rate2')) {
    function Rate2($product_id)
    {
        $rating = App\Models\rating\rating::where('product_id', $product_id)->first();
        $exist = \App\Models\rating\userRating::where('rating_id', $rating['id'])->first();
        if ($exist['rating'] != null) {
            return true;
        }
        return false;
    }
}

if (!function_exists('productRate')) {
    function productRate($product_id)
    {
        $rating = App\Models\rating\rating::where('product_id', $product_id)->first()['rating'];
        return $rating;
    }
}

if (!function_exists('banner')) {
    function banner($id, $store = null)
    {
        $banner = \App\Models\Settings\Banner::where('sort_order', $id)->where('store_id', $store)->first();
        return $banner;
    }
}


function deleteImage($deleteFileWithName)
{
    if (file_exists($deleteFileWithName)) {
        \Illuminate\Support\Facades\File::delete($deleteFileWithName);
    }

}

if (!function_exists('lang')) {
    function lang()
    {

        if (\Illuminate\Support\Facades\Cookie::get('lang') != null) {
            session()->put('lang', \Illuminate\Support\Facades\Cookie::get('lang'));
            return session('lang');
        } else {
            $firstLang = \App\Models\Language::first();
            \Illuminate\Support\Facades\Cookie::queue( \Illuminate\Support\Facades\Cookie::make('lang', $firstLang->code) , 525948);
            session()->put('lang',  $firstLang->code);
            return session('lang');
        }


//        if (session()->has('lang') ) {
//            return session('lang');
//        } else {
//            $firstLang = \App\Models\Language::first();
//            session()->put('lang', $firstLang->code);
//            return session('lang');
//        }
    }
}


if (!function_exists('adminlang')) {
    function adminlang()
    {

        if (\Illuminate\Support\Facades\Cookie::get('adminlang') != null) {
            session()->put('adminlang', \Illuminate\Support\Facades\Cookie::get('adminlang'));
            return session('adminlang');
        } else {
            $firstLang = \App\Models\Language::first();
            \Illuminate\Support\Facades\Cookie::queue( \Illuminate\Support\Facades\Cookie::make('adminlang', $firstLang->code) , 525948);
            session()->put('adminlang',  $firstLang->code);
            return session('adminlang');
        }

//        if (session()->has('adminlang')) {
//            return session('adminlang');
//        } else {
//            $firstLang = \App\Models\Language::first();
//            session()->put('adminlang', $firstLang->code);
//            return session('adminlang');
//        }
    }
}

if (!function_exists('getimage')) {
    function getimage($id)
    {
        $image = \App\Models\product\product_photos::where('product_id', $id)->where('main', 1)->first();
        return $image['photo'];
    }
}
if (!function_exists('getFeatureColor')) {
    function getFeatureColor($feature_id = null)
    {
        $letter = '#';
        $feature = \App\Models\product\features::where('id', $feature_id)->whereHas('options', function ($query) use ($letter) {
            $query->where('title', 'LIKE', '%' . $letter . '%');
        })->first();
        return $feature;
    }
}
if (!function_exists('ordernumber')) {
    function ordernumber($number)
    {
        $exists = \App\Models\product\orders::where('ordernumber', $number)->exists();
        if ($exists) {
            $number = rand(1111111, 9999999);
            ordernumber($number);
        } else {
            return $number;
        }
    }
}
if (!function_exists('cat_menu')) {
    function cat_menu()
    {
        // main categories
        $category = \App\Models\Category::where('lang_id', getLang(session('lang')))->where('parent_id', null)->get();
        return $category;
    }
}
if (!function_exists('checkDiscountPrice')) {

    function checkDiscountPrice($id)
    {
        $product = \App\Models\product\products::where('id', '=', $id)->first();
        if ($product['discount'] == null) {
            $discount = $product['price'];
            return $discount;
        } else {
            $discount = $product['price'] - ($product['price'] * $product['discount'] / 100);
            return $discount;
        }
    }

}


if (!function_exists('getLang')) {

    function getLang($session)
    {
        $language = \App\Models\Language::where('code', $session)->first();
        if ($language == null) {
            return;
        } else {
            return $language['id'];
        }
    }
}

if (!function_exists('catLangCheck')) {
    function catLangCheck($id)
    {
        $category = \App\Models\Category::where('id', $id)->first();
        if ($category['source_id'] == null) {
            return $id;
        } else {
            return $category['source_id'];
        }
    }
}
if (!function_exists('getChildrens')) {
    function getChildrens($id)
    {
        $category = \App\Models\Category::where('id', $id)->first();
        if ($category['source_id'] == null) {
            return $id;
        } else {
            return $category['source_id'];
        }
    }
}


if (!function_exists('artcle_categories')) {
    function artcle_categories()
    {
        // articles data section
        $categories = \App\Models\Article\Artcl_category::where('published', 1)->orderBy('id', 'desc')->take(3)->get();

        foreach ($categories as $category) {
            $articles_category = \App\Models\Article\Article_category::where('article_category.category_id', $category->id)
                ->join('articles', 'articles.id', '=', 'article_category.article_id')
                ->where('articles.published', 1)
                ->join('artcl_categories', 'artcl_categories.id', '=', 'article_category.category_id')
                ->join('article_data', 'article_data.source_id', 'articles.id')
                ->select('articles.id as artcl_id', 'articles.title as artcl_title', 'articles.content as artcl_content', 'articles.img_url as artcl_img',
                    'artcl_categories.title as cat_title', 'article_data.*')
                ->get();
            $articles[] = [$category, $articles_category];
        }

        return $articles;
    }
}

if (!function_exists('articles')) {
    function articles()
    {
        $articles = \App\Models\Article\Article::where('lang_id', getLang(session('lang')))->where('published', 1)->orderBy('id', 'desc')->take(3)->get();
        return $articles;
    }
}

if (!function_exists('article_data')) {
    function article_data($article_id)
    {
        $article_data = \App\Models\Article\Article_data::where('source_id', $article_id)->first();
        return $article_data;
    }
}

?>
