<?php
namespace App\Http\Repositories;


use App\Exam;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExamRepository extends BaseRepository 
{
    function __construct(Exam $model)
    {
        $this->model = $model;
    }
}