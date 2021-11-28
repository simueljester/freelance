@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('groups.user-group.user-group')}}">Groups</a> </li>
            <li class="breadcrumb-item"> {{$group->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <strong> {{$group->name}} </strong> </h5>
        <small> {{$group->description}} </small>
        <hr>
        <div> Creator: {{$group->user_creator->name}} </div>
        <div> Date Created: {{$group->created_at->format('Y-m-d')}} </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <strong> {{$group->name}} Modules </strong>
        <ul class="nav nav-tabs mt-3" role="tablist">
       
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-exam') ? 'active' : ''}}" href="{{route('groups.user-group.list-exam',$group)}}" > <i class="fas fa-copy text-primary"></i> Assessments </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-link') ? 'active' : ''}}" href="{{route('groups.user-group.list-link',$group)}}" > <i class="fas fa-link text-danger"></i> Links </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-learning-material') ? 'active' : ''}}" href="{{route('groups.user-group.list-learning-material',$group)}}" > <i class="fas fa-file-signature text-warning"></i> Learning Materials </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-discussion') ? 'active' : ''}}" href="{{route('groups.user-group.list-discussion',$group)}}" > <i class="fas fa-comment text-success"></i>  Discussions </a>
            </li>
          
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content border p-3 bg-light">
            @yield('sub_content')
          </div>
    </div>
</div>




{{-- <div class="row">
    <div class="col-sm-8">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
            @forelse ($my_exam_assignments as $assignment)
                <div class="card mt-3">
                    <div class="card-header">
                        <strong> <i class="fas fa-copy"></i> {{$assignment->exam->name}} </strong> 
                        - 
                        @if ($assignment->status == 1)
                            <span class="badge badge-success">Completed</span>
                        @elseif ($assignment->status == 2)
                            <span class="badge badge-danger">Late Submission</span>
                        @else
                            <span class="badge badge-secondary">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                        {{$assignment->exam->description}}
                        <hr>
                        @if ($assignment->status == 1 || $assignment->status == 2)
                            <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" class="btn btn-info btn-sm"> View Exam </a>   
                        @else
                            <a href="{{route('groups.user-group.start-exam',$assignment)}}" class="btn btn-success btn-sm"> Start Exam </a>
                        @endif
               
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-clock"></i> {{$assignment->exam->duration}} minutes
                        &nbsp&nbsp
                        <i class="fas fa-star text-warning"></i> {{$assignment->score }} / {{$assignment->exam->total_score}} points
                    </div>
                </div>
            @empty
                No exam assigned to you
            @endforelse
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <strong>  <i class="fas fa-users"></i> Group  Members </strong> 
                <br>
                <small> Users belong to this group </small>
                <div class="mt-3">
                    <ul>
                        @forelse ($assigned_users as $user)
                            <li> {{$user->user->name}} - {{$user->user->email}} </li>         
                        @empty
                            <li> No members found </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}





@endsection
