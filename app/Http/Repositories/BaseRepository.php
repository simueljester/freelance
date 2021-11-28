<?php 
namespace App\Http\Repositories;
use DB;
use Auth;
use App\SystemLog;
use DateTime;

class BaseRepository {

    public $model;

    /**
     * Query model
     *
     * @return void
     */
    public function query() {
        $model = $this->model->query();
        return $model;
    }
    
    /**
     * Save model
     *
     * @param array $record
     * @return void
     */
    public function save(array $record) {

        DB::beginTransaction();

        try {

            $this->model->fill($record);
            $this->model->save();

            $this->saveLog($this->model,'create');
  
            DB::commit();
                
          
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return $this->model;

       
    }
    
    /**
     * Update model
     * 
     * @param int $id
     * @param array $record
     * @return void
     */
    public function update(int $id, array $record) {

        DB::beginTransaction();

        try {

            $model = $this->model->find($id);
            $model->fill($record);
            $model->save();

            $this->saveLog($model,'edit');
  
            DB::commit();
                
          
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

     
        return $model;
    }

    /**
     * Delete model
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) {

        $model = $this->model->find($id);

        $this->saveLog($model,'delete');

        $isDeleted = $model->delete();

        return $isDeleted;


    }

  
    /**
     * Find model
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id) {
        $model = $this->model->find($id);

        return $model;
    }


    public function saveLog($model,$function)
    {
        $dt = new DateTime();
        SystemLog::create([
            'date'      => $dt->format('Y-m-d'),
            'time'      =>  $dt->format('H:i:s'),
            'model'     => $model->getTable(),
            'function'  => $function,
            'data'      => $model,
            'details'   => null,
            'user_id'   => Auth::user()->id,
        ]);
    }

    public function customSaveLog($model,$function,$details,$data)
    {
        $dt = new DateTime();
        SystemLog::create([
            'date'      => $dt->format('Y-m-d'),
            'time'      =>  $dt->format('H:i:s'),
            'model'     => $model,
            'function'  => $function,
            'data'      => null,
            'details'   => $details,
            'user_id'   => Auth::user()->id,
        ]);
    }

}