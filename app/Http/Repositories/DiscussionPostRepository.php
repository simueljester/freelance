<?php
namespace App\Http\Repositories;


use App\DiscussionPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DiscussionPostRepository extends BaseRepository 
{
    function __construct(DiscussionPost $model)
    {
        $this->model = $model;
    }
}