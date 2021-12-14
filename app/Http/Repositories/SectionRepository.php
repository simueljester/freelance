<?php
namespace App\Http\Repositories;


use App\Section;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SectionRepository extends BaseRepository 
{
    function __construct(Section $model)
    {
        $this->model = $model;
    }
}