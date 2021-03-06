@extends('groups.show')

@section('folder')

<div class="card shadow-sm mt-3">
    <div class="card-header"> 
        <a href="{{route('groups.show',$group->id)}}"> Main </a>
        @if ($this_folder)
            &nbsp
            @if ($this_folder)
                @foreach ($get_depth as $depth)
                    &nbsp <i class="fas fa-caret-right"></i> &nbsp <a href="{{route('groups.show-folder',$depth->id)}}"> {{$depth->name}} </a></li>
                @endforeach
                    &nbsp <i class="fas fa-caret-right"></i> &nbsp {{$this_folder->name}}</li>
            @endif
        @endif
    </div>
    <div class="card-body">
        
        <div class="mt-1">

        
            {{-- Folder Child folders  --}}
            <div class="row">
                @if ($this_folder)
                    @foreach ($this_folder->recursiveChildFolders as $child_folder)
                    <div class="col-sm-2">
                        <a style="text-decoration: none;"  href="{{route('groups.show-folder',$child_folder)}}"> 
                            <div class="card bg-light" style="cursor:pointer">
                                <div class="card-body">
                                <i class="fas fa-folder text-warning"></i> <i class="text-muted"> {{$child_folder->name}} </i>  
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @else
                    @foreach ($folders as $folder)
                    <div class="col-sm-2">
                        <a style="text-decoration: none;" href="{{route('groups.show-folder',$folder)}}"> 
                            <div class="card bg-light" style="cursor:pointer">
                                <div class="card-body">
                                <i class="fas fa-folder text-warning"></i> <i class="text-muted"> {{$folder->name}} </i>  
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif

                @if ($group->creator_id == Auth::user()->id)
                    <div class="col-sm-2">
                        <div class="card bg-light" style="cursor:pointer" data-toggle="modal" data-target="#createFolder">
                            <div class="card-body">
                                <i class="fas fa-plus"></i> <small> <i> New folder  </i>  </small> 
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3 p-3 " >
            @if ($group->creator_id == Auth::user()->id)
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addResource"> <i class="fas fa-plus"></i> Add New Module </button>
            <hr>
            @endif
       

            @forelse ($group_modules as $module)
                @switch($module->module_type)
                    @case('exam')
                        <div class="card mt-3">
                            <div class="card-header bg-light text-dark p-2">
                                <i class="fas fa-copy text-primary fa-2x m-1"></i> 
                                 <a href="{{route('groups.exam.show',$module->exam)}}" class="text-primary" style="  text-decoration: none;"> 
                                    <strong > {{$module->exam->name}}  </strong> 
                                </a> 
                            </div>
                            <div class="card-body">
                                {{$module->exam->description ?? 'No description provided'}} 
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-calendar-alt"></i> {{$module->exam->created_at->format('Y-m-d')}}
                                &nbsp&nbsp
                                <i class="fas fa-hourglass-half"></i> {{$module->exam->duration}} minutes
                                &nbsp&nbsp
                                <i class="fas fa-star text-warning"></i> {{$module->exam->total_score}} Total score
                             
                            </div>
                        </div>
                        @break

                    @case('discussion')
                        <div class="card mt-3">
                            <div class="card-header bg-light text-dark p-2">
                                <i class="fas fa-comments fa-2x text-success m-1"></i> 
                                 <a href="{{route('groups.discussion.show',$module->discussion)}}" class="text-primary" style="  text-decoration: none;"> 
                                    <strong > {{$module->discussion->name}}  </strong> 
                                </a> 
                            </div>
                            <div class="card-body">
                                {!! $module->discussion->description ?? 'No description provided'!!} 
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-calendar-alt"></i> {{$module->discussion->created_at->format('Y-m-d')}}
                                &nbsp&nbsp
                                <i class="fas fa-star text-warning"></i> {{$module->discussion->total_score}} Total score
                            </div>
                        </div>
                        @break

                    @case('learning_material')
                        <div class="card mt-3">
                            <div class="card-header bg-light text-dark p-2">
                                <i class="fas fa-file-signature fa-2x text-warning m-1"></i>
                                 <a href="{{route('groups.learning-material.show',$module->learning_material)}}" class="text-primary" style="  text-decoration: none;"> 
                                    <strong > {{$module->learning_material->name}}  </strong> 
                                </a> 
                            </div>
                            <div class="card-body">
                                {!! $module->learning_material->description ?? 'No description provided'!!} 
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-calendar-alt"></i> {{$module->learning_material->created_at->format('Y-m-d')}}
                            </div>
                        </div>
                        @break

                    @case('link')
                        <div class="card mt-3">
                            <div class="card-header bg-light text-dark p-2">
                                <i class="fas fa-link fa-2x text-danger"></i>
                                 <a href="{{route('groups.link.show',$module->link)}}" class="text-primary" style="  text-decoration: none;"> 
                                    <strong > {{$module->link->name}}  </strong> 
                                </a> 
                            </div>
                            <div class="card-body">
                                {!! $module->link->description ?? 'No description provided'!!} 
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-calendar-alt"></i> {{$module->link->created_at->format('Y-m-d')}}
                            </div>
                        </div>
                        @break
                
                @endswitch
        
            @empty
                No resource found 
            @endforelse
      
        </div>

    </div>
</div>



<!-- Modal Create Folder-->
<form action="{{route('folders.save')}}" method="POST">
    @csrf
    @method("POST")
    <div class="modal fade" id="createFolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <strong> <i class="fas fa-folder-plus"></i> Create New Folder </strong> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Folder Name </span>
                    <input type="text" name="folder_name" id="folder_name" class="form-control" required>
                    <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
                    <input type="hidden" name="parent_id" id="parent_id" value="{{$this_folder->id ?? 0}}">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info btn-sm"> Create </button>
            </div>
          </div>
        </div>
      </div>
</form>


<!-- Modal Add Resource-->

<div class="modal fade" id="addResource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Create New Module </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-copy fa-2x text-primary"></i>
                    <br>
                    <small> Create new examination / quiz for users </small>
                    <a href="{{route('groups.exam.create',[$group,$this_folder ?? 0])}}" class="btn btn-info btn-sm btn-block mt-3"> Assessment </a>
                </div>
            </div>
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-link fa-2x text-danger"></i>
                    <br>
                    <small> Create a link file </small>
                    <a href="{{route('groups.link.create',[$group,$this_folder ?? 0])}}" class="btn btn-info btn-sm btn-block mt-3"> Link </a>
                </div>
            </div>
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-file-signature fa-2x text-warning"></i>
                    <br>
                    <small> Upload learning materials such as docx, ppt, pdf or excel </small>
                    <a href="{{route('groups.learning-material.create',[$group,$this_folder ?? 0])}}" class="btn btn-info btn-sm btn-block mt-3"> Learning Materials </a>
                </div>
            </div>
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-comments fa-2x text-success"></i> 
                    <br>
                    <small> Start a discussion with users </small>
                    <a href="{{route('groups.discussion.create',[$group,$this_folder ?? 0])}}" class="btn btn-info btn-sm btn-block mt-3"> Discussion </a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
      </div>
    </div>
  </div>


 @include('layouts.card-style')
@endsection
