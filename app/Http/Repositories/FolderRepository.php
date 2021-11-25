<?php
namespace App\Http\Repositories;



use App\Folder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FolderRepository extends BaseRepository 
{
    function __construct(Folder $model)
    {
        $this->model = $model;
    }

 
}