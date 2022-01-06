@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('groups.user-group.user-group')}}">Class</a> </li>
            <li class="breadcrumb-item"> <a href="{{route('groups.show',$group->id)}}"> {{$group->name}} </a> </li>
            <li class="breadcrumb-item"> {{$user->name}} Exam Assignments </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        @forelse ($user_exam_assignments as $assignment)
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
                    <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" class="btn btn-primary btn-sm"> View Exam </a>   
                @endif

            </div>
            <div class="card-footer">
                <i class="fas fa-clock"></i> {{$assignment->exam->duration}} minutes
                &nbsp&nbsp
                <i class="fas fa-star text-warning"></i> {{$assignment->score }} / {{$assignment->exam->total_score}} points
            </div>
        </div>
        @empty
            No exam assigned to this user
        @endforelse
    </div>
</div>

 



@endsection
