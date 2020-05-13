<?php

namespace App\Imports;

use App\Models\Newletters;
use Maatwebsite\Excel\Concerns\ToModel;

class NewLetterImport implements ToModel
{

    public function model(array $row)
    {
//        return new Newletters([
//
//        ]);
    }
}
