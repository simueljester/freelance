<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QuestionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function  __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('excel.questions', [
            'data' => $this->data,
        ]);
    }
}
