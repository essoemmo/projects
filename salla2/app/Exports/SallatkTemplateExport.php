<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SallatkTemplateExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new ProductsTemplateExport(),
            new TypesTemplateExport(),
        ];

        return $sheets;
    }
}
