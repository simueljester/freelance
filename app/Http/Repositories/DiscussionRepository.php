<?php
namespace App\Http\Repositories;


use App\Discussion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DiscussionRepository extends BaseRepository 
{
    function __construct(Discussion $model)
    {
        $this->model = $model;
    }
}