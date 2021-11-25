<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\WebshotRepository;

class WebshotController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
  
        $file_data = $request->input('image');
        $file_name = 'webcam_'.time().'.jpeg';

        if($file_data != ""){

            //maniuplate request to image
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data)      = explode(',', $file_data);

            //config image data
            $folderName = 'public/uploads/';
            $safeName = 'webcam_'.time().'.png';
            $destinationPath = public_path() . $folderName;
            $success = file_put_contents(public_path().'/uploads/'.$safeName, base64_decode($file_data));
     
            //save to database
            $data = [
                'filename'              => $safeName ?? null,
                'exam_id'               => $request->exam_id,
                'exam_assignment_id'    => $request->exam_assignment_id,
                'group_id'              => $request->group_id,
                'user_id'               =>  Auth::user()->id,
                'user_instance_id'      =>  Auth::user()->user_instance->id
            ];
    
            app(WebshotRepository::class)->save($data);
        }

    }
}
