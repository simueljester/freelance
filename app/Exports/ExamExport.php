<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExamExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($exam_assignment)
    {
        //
        $this->exam_assignment = $exam_assignment;
    }
    public function view(): View
    {
        return view('excel.exam', [
            'exam_assignment' => $this->exam_assignment,
        ]);
    }
}
