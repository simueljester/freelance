@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-paste text-white text-info"></i>  Discussion  </h4>
        <small class="text-muted"> <i> Manages discussion details </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$discussion->group)}}"> {{$discussion->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$discussion->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <i class="fas fa-copy"></i>  <strong> {{$discussion->name}} </strong> &nbsp&nbsp   </h5>
        <small> {!! $discussion->description ?? 'No details provided' !!} </small>
        <hr>
        <div>
            <i class="fas fa-star text-warning"></i> {{$discussion->total_score}} Total Score
            &nbsp&nbsp
            <a href="{{route('groups.show',$discussion->group_id)}}" class="text-info"> <i class="fas fa-cube"></i> {{$discussion->group->name}} </a>
            &nbsp&nbsp
            <a href="{{route('groups.discussion.edit',$discussion)}}" class="text-info"> <i class="fas fa-edit "></i> Edit Discussion </a>
            &nbsp&nbsp
            <a href="{{route('groups.discussion.delete',$discussion)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this discussion? All discussion assignments, participation posts and user scores will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Discussion </a>
            &nbsp&nbsp
            @if ($discussion->attachment)
                <i class="fas fa-paperclip"></i> <a href="{{route('downloads.question-attachment',$discussion->attachment)}}" class="text-info"> {{$discussion->attachment}} </a>
            @endif
                {{--&nbsp&nbsp
            <a href="{{route('groups.exam.delete',$discussion)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this exam? All exam assignments to users will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Exam </a> --}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <a href="{{route('groups.user-group.start-discussion',$discussion)}}" class="btn btn-info btn-block"> <i class="fas fa-comment-dots"></i> Open Discussion </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <strong> <i class="fas fa-users"></i> User Discussion Assignments </strong> - <a href="{{route('groups.discussion.generate-pdf',$discussion)}}" target="_blank" class="text-info" style="text-decoration:none"> Generate scores </a>
                <table class="table table-hover mt-3">
                    <thead>
                        <th> User </th>
                        <th> Score </th>
                    </thead>
                    <tbody>
                        @forelse ($discussion_assignments as $assignment)
                            <tr>
                                <td> <i class="fas fa-user"></i> {{$assignment->user->name}} </td>
                                <td> {{$assignment->score}} / {{$assignment->discussion->total_score}} </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No users found in this discussion. To assign users, Click <strong> Edit Exam </strong> then save changes </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
     
    </div>
</div>



@endsection
