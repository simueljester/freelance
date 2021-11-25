<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\FolderRepository;

class FolderController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function save(Request $request){
        
        $request->validate([
            'folder_name' => 'required'
        ]);

        $data = [
            'name'        => $request->folder_name,
            'parent_id'   => $request->parent_id,
            'group_id'    =>  $request->group_id
        ];

        app(FolderRepository::class)->save($data);
    
        return redirect()->back()->with('success', 'Folder successfully created');
    }

  

}
