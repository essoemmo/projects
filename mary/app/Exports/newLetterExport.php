<?php

namespace App\Exports;

use App\Models\Newletters;
use Maatwebsite\Excel\Concerns\FromCollection;

class newLetterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Newletters::all();
    }
}
