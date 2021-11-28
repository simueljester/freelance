<?php
namespace App\Http\Repositories;


use App\Link;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LinkRepository extends BaseRepository 
{
    function __construct(Link $model)
    {
        $this->model = $model;
    }
}