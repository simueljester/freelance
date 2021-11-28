<?php
namespace App\Http\Repositories;


use App\LearningMaterial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LearningMaterialRepository extends BaseRepository 
{
    function __construct(LearningMaterial $model)
    {
        $this->model = $model;
    }
}