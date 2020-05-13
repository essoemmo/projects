<?php

namespace App\Exports;

use App\Models\product\stores;
use App\Models\Product_type;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TypesTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{

    public function headings(): array
    {
        return [
            'انواع المنتجات المتاحه حاليا',
        ];
    }

    public function title(): string
    {
        return 'product types';
    }

    public function collection()
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        return Product_type::leftJoin('product_types_data', 'product_types_data.product_types_id', 'product_types.id')
            ->where('product_types.store_id', $store->id)
            ->select('product_types_data.title')
            ->get();
    }
}
