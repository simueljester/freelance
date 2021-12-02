<?php

namespace App\Http\Controllers;

use DB;
use File;
use Response;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Repositories\UserActivityRepository;
use Auth;

class DownloadController extends Controller
{
    //
    public function questionAttachment($question_attachment){
        $filepath = public_path('attachments/'.$question_attachment);
        return Response::download($filepath); 
    }

    public function discussionAttachment($discussion_attachment){
        $filepath = public_path('attachments/'.$discussion_attachment);
        return Response::download($filepath); 
    }

    public function learningMaterialAttachment($learning_material_attachment, Group $group){
 
        $saved = app(UserActivityRepository::class)->save([
            'module_type'           => 'learning_material',
            'details'               => Auth::user()->name.' downloaded a learning material '.$learning_material_attachment,
            'group_id'              => $group->id,
            'user_id'               => Auth::user()->id,
        ]);
        
        $filepath = public_path('attachments/'.$learning_material_attachment);
        return Response::download($filepath); 
    }


    public function userTemplate($template){
   
        $filepath = public_path('attachments/'.$template);
        return Response::download($filepath); 
    }

    

    
}
