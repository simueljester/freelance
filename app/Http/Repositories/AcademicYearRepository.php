<?php
namespace App\Http\Repositories;


use App\AcademicYear;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AcademicYearRepository extends BaseRepository 
{
    function __construct(AcademicYear $model)
    {
        $this->model = $model;
    }

    public function getActiveAcademicYear(){
        $active = AcademicYear::whereActive(1)->first();
        return $active;
    }
}