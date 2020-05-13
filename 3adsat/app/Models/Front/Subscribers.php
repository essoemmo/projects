<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 12/06/2019
 * Time: 04:50 �
 */

namespace App\Models\Front;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;


class Subscribers  implements FromCollection
{
    use Exportable;
//    private $fileName = 'subscriber.xlsx';


    public function collection()
    {
        return Newsletter::all();
    }
}