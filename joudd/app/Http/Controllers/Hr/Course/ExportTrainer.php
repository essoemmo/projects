<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 10/07/2019
 * Time: 05:13 ã
 */

namespace App\Http\Controllers\Hr\Course;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportTrainer implements FromCollection, WithHeadings
{

    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {

        return collect($this->data);

    }

    public function headings(): array
    {
        return [
            _i('ID'),
            _i('First Name'),
            _i('Last Name'),
            _i('Skills'),
            _i('Status'),
            _i('Gender'),
            _i('Hiring Date'),
        ];
    }
}