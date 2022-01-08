<?php
namespace App\Http\Repositories;

use DB;
use App\User;
use App\AcademicYear;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\UserInstanceRepository;

class UserRepository extends BaseRepository 
{
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserWithInstance(){

        $users = User::with('user_instance.role')->orderBy('last_name','ASC')->get();
        return $users;
    }

    public function saveBatch($uploaded_users){

        foreach($uploaded_users as $user){

            DB::beginTransaction();

                try {

                    $save_user = new User;
                    $save_user->first_name = $user->first_name;
                    $save_user->last_name = $user->last_name;
                    $save_user->name = $user->first_name .' '.$user->last_name;
                    $save_user->email = $user->email;
                    $save_user->password = Hash::make('user1234');
                    $save_user->address = $user->address;
                    $save_user->birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user->birthday)->format('Y-m-d');
                    $save_user->save();
                    
                    
                    $user_instance_data = [
                        'user_id'           => $save_user->id,
                        'role_id'           => $user->role == 'teacher' ? 2 : 3,
                        'active'            => 1,
                        'academic_year_id'  => AcademicYear::whereActive(1)->first()->id
                    ];
                    $saved_user_instances_data = app(UserInstanceRepository::class)->save($user_instance_data);

                    DB::commit();
                    // all good
                } catch (\Exception $e) {
                    DB::rollback();

                    return $e;
                    // something went wrong
                }


        }
        return 1;
    }
}