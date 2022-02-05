<?php
namespace App\Http\Repositories;


use App\Subject;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\AcademicYearRepository;

class SubjectRepository extends BaseRepository 
{
    function __construct(Subject $model)
    {
        $this->model = $model;
    }

    public function saveBatch($data,$department){
        DB::beginTransaction();

        try {
        
            foreach($data as $subject){

                $new_subject = new Subject;
                $new_subject->name = $subject['name'];
                $new_subject->course_code =  Str::slug($subject['course_code']);
                $new_subject->description = $subject['description'];
                $new_subject->academic_year_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
                $new_subject->department_id = $department;
                $new_subject->save();
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // something went wrong
        }
    }
}