<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Illuminate\Support\Facades\Validator;

class QuestionsImport implements ToCollection,WithHeadingRow
{
 
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        Validator::make($collection->toArray(), [
            '*.instruction' => 'required'
        ])->validate();
    }
}
