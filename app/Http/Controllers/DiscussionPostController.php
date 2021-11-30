<?php

namespace App\Http\Controllers;

use Auth;
use App\Discussion;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\UserActivityRepository;
use App\Http\Repositories\DiscussionPostRepository;

class DiscussionPostController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
    
        $request->validate([
            'post' => 'required'
        ]);

        $attachment = $request->attachment ? UploadHelper::uploadDiscussionPostAttachment($request->attachment) : null;
      
        $data = [
            'description'           => $request->post,
            'attachment'            => $attachment,
            'discussion_id'         => $request->discussion_id,
            'user_id'               => Auth::user()->id,
            'user_instance_id'      => Auth::user()->user_instance->id,
        ];

        $saved = app(DiscussionPostRepository::class)->save($data);

        //record activity
        $discussion = Discussion::find($request->discussion_id);
        $saved = app(UserActivityRepository::class)->save([
            'module_type'           => 'discussion',
            'details'               => Auth::user()->name.' participated in discussion '.$discussion->name,
            'group_id'              => $discussion->group_id,
            'user_id'               => Auth::user()->id,
        ]);
    
        return redirect()->back()->with('success', 'Post success!');

    }
}
