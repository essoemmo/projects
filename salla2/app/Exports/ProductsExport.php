<?php

namespace App\Exports;

use App\Models\product\products;
use App\Models\product\stores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{

    public function __construct($headings)
    {
        $this->headings = $headings;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function title(): string
    {
        return 'Products';
    }


    public function collection()
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        return products::leftJoin('product_details', 'product_details.product_id', 'products.id')
            ->leftJoin('product_photos', 'product_photos.product_id', 'products.id')
            ->leftJoin('product_types', 'product_types.id', 'products.product_type')
            ->leftJoin('product_types_data', 'product_types_data.product_types_id', 'product_types.id')
            ->where('products.store_id', $store->id)
            ->where('product_photos.main', 1)
            ->select(
                'product_details.title as title',
                'product_details.description as description',
                'product_photos.photo as photo',
                'product_types_data.title as type',
                'products.price as price',
                'products.max_count as quantity',
                'products.sku as sku',
                'products.discount as discount')
            ->get();
    }
}
