<?php

namespace App\Imports;

use App\Bll\Constants;
use App\Models\product\product_details;
use App\Models\product\product_photos;
use App\Models\product\products;
use App\Models\product\stores;
use App\Models\Product_type;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows->toArray() as $array) {
            $validator = Validator::make($array, [
                'name' => ['string', function ($attribute, $value, $fail) {
                    if ($value === 'أسم المنتج المُراد إضافته') {
                        $fail($attribute . ' is invalid.');
                    }
                },],
                'photo' => ['url', function ($attribute, $value, $fail) {
                    if ($value === 'https://s3-eu-central-1.amazonaws.com/salla-cdn/hs7xRKYaPd30vC0hAjHze3x4rnzLCsHP3UOYSHJb.jpg') {
                        $fail($attribute . ' is invalid.');
                    }
                },],
                'type' => ['string', function ($attribute, $value, $fail) {
                    if ($value === 'أنواع المنتجات المتاحة حليا فى الصفحة التالية، إختر منها') {
                        $fail($attribute . ' is invalid.');
                    }
                },],
                'price' => ['numeric'],
                'quantity' => ['numeric'],
            ])->validate();
        }

        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        foreach ($rows as $row) {
            $product_type = Product_type::leftJoin('product_types_data', 'product_types_data.product_types_id', 'product_types.id')
                ->where('product_types_data.title', $row['type'])->select('product_types.*')->first();
            $product = products::create([
                'product_type' => $product_type->id,
                'price' => $row['price'],
                'max_count' => $row['quantity'],
                'sku' => $row['sku'],
                'discount' => $row['discount'],
                'currency_code' => Constants::defaultCurrency,
                'store_id' => $store->id,
            ]);

            product_details::create([
                'title' => $row['name'],
                'description' => $row['description'],
                'product_id' => $product->id,
                'lang_id' => Constants::defaultLanguage,
            ]);

            if ($row['photo'] != null) {
                $image_url = $row['photo'];

                $path = parse_url($image_url, PHP_URL_PATH);       // get path from url
                $extension = pathinfo($path, PATHINFO_EXTENSION); // get ext from path
                $filename = pathinfo($path, PATHINFO_FILENAME); // get name from path
                $imageName = $filename . '.' . $extension;

                if (!is_dir(public_path('uploads/products/' . $product->id))) {
                    mkdir(public_path('uploads/products/' . $product->id), 755, true);
                }

                Image::make($image_url)->save(public_path('/uploads/products/' . $product->id . '/' . $imageName));

                product_photos::create([
                    'product_id' => $product->id,
                    'photo' => '/uploads/products/' . $product->id . '/' . $imageName,
                    'description' => $filename,
                    'tag' => $filename,
                    'main' => 1,
                ]);
            }
        }
    }

}
