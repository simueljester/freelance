<?php
namespace App\Http\Repositories;

use App\ExamAssignmentWebShot;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WebshotRepository extends BaseRepository 
{
    function __construct(ExamAssignmentWebShot $model)
    {
        $this->model = $model;
    }

}