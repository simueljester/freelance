<?php
namespace App\Http\Repositories;


use App\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuestionBankRepository extends BaseRepository 
{
    function __construct(Question $model)
    {
        $this->model = $model;
    }
}