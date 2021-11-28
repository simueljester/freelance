<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadHelper {
   
    public static function uploadFile($att)
    {
        $name = 'question-attachment-'.time().'.'.$att->getClientOriginalExtension();
        $att->move(public_path('/attachments'), $name);
        return $name;
    }

    public static function uploadWebShot($att,$file_name)
    {
        $att->move(public_path('/shots'), $file_name);
        return $file_name;
    }

    public static function uploadDiscussionPostAttachment($att)
    {
        $name = 'discussion-post-attachment-'.time().'.'.$att->getClientOriginalExtension();
        $att->move(public_path('/attachments'), $name);
        return $name;
    }

    public static function uploadLearningMaterial($att)
    {
        $name = 'learning-material-attachment-'.time().'.'.$att->getClientOriginalExtension();
        $att->move(public_path('/attachments'), $name);
        return $name;
    }
}