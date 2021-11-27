<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\DiscussionPostRepository;
use Auth;

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
    
        return redirect()->back()->with('success', 'Post success!');

    }
}
