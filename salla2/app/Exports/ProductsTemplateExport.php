<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Photo',
            'Type',
            'Price',
            'Quantity',
            'Sku',
            'Discount',
        ];
    }

    public function title(): string
    {
        return 'Products';
    }

    public function collection()
    {
        return collect([
            [
                'name' => 'أسم المنتج المُراد إضافته',
                'description' => '',
                'photo' => '(https://s3-eu-central-1.amazonaws.com/salla-cdn/hs7xRKYaPd30vC0hAjHze3x4rnzLCsHP3UOYSHJb.jpg) يوضع رابط الصورة كمثال',
                'type' => 'أنواع المنتجات المتاحة حليا فى الصفحة التالية، إختر منها',
                'price' => '',
                'quantity' => '',
                'sku' => '',
                'discount' => '',
            ],
        ]);
    }
}
