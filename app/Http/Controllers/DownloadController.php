<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;
use DB;

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

    
}
