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
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$exam->group)}}"> {{$exam->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$exam->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <i class="fas fa-copy text-primary fa-2x m-1"></i>  <strong> {{$exam->name}} </strong> &nbsp&nbsp   </h5>
        <small> {{$exam->description ?? 'No details provided'}} </small>
        <hr>
        <div>
            <i class="fas fa-clock"></i> {{$exam->duration}} Minutes
            &nbsp&nbsp
            <i class="fas fa-star text-warning"></i> {{$exam->total_score}} Maximum Score
            &nbsp&nbsp
            <a href="{{route('groups.show',$exam->group_id)}}" class="text-info"> <i class="fas fa-cube"></i> {{$exam->group->name}} </a>
            &nbsp&nbsp
            <a href="{{route('groups.exam.edit',$exam)}}" class="text-info"> <i class="fas fa-edit "></i> Edit Exam </a>
            &nbsp&nbsp
            <a href="{{route('groups.exam.delete',$exam)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this exam? All exam assignments to users will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Exam </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <strong> <i class="fas fa-users"></i> User Exam Assignments </strong>
                <table class="table table-hover mt-3">
                    <thead>
                        <th> User </th>
                        <th> Score </th>
                        <th> Status </th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($exam_assignments as $assignment)
                            <tr>
                                <td> <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" target="_blank"> {{$assignment->user->name}} </a> </td>
                                <td> {{$assignment->score}} / {{$assignment->exam->total_score}} </td>
                                <td> 
                                    @if ($assignment->status == 0)
                                        <h6> <span class="badge badge-secondary"> Pending </span></h6>
                                    @endif
                                    @if ($assignment->status == 1)
                                        <h6> <span class="badge badge-success"> Completed </span></h6>
                                    @endif
                                    @if ($assignment->status == 2)
                                         <h6> <span class="badge badge-danger"> Late Submission </span></h6>
                                    @endif
                                </td>
                                <td> 
                                    @if ($assignment->status != 0)
                                        <a href="{{route('groups.exam.generate-pdf',$assignment)}}" target="_blank" class="btn btn-info btn-sm"> <i class="fas fa-download"></i> Download Result </a> 
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No users found in this exam. To assign users, Click <strong> Edit Exam </strong> then save changes </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <form action="{{route('groups.exam.examination-assignment.unassign-questions')}}" method="POST" >
            @csrf
            @method("POST")
            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <strong> <i class="fas fa-question-circle"></i> Questions </strong>
                    <div class="alert alert-info" role="alert">
                         Examination questions will be ordered by level of difficulty 
                      </div>
                    <div class="mt-3">
                        <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
                        <a href="{{route('groups.exam.examination-assignment.index',$exam)}}" class="btn btn-info btn-sm"> <i class="fas fa-question-circle"></i> Assign Questions </a>
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected questions?')"> Unassign Questions </button>
                        <a href="{{route('groups.show',$exam->group_id)}}" class="btn btn-outline-secondary btn-sm"> Go to Group </a>
                    </div>
                    <table class="table table-hover mt-3 table-bordered">
                        <thead>
                            <th> Question </th>
                            <th> Type </th>
                            <th> Difficulty </th>
                            <th> Points </th>
                            <th>  </th>
                        </thead>
                        <tbody>
                            @forelse ($questions_assigned as $assignment)
                                <tr>
                                    <td> <a href="{{route('question-bank.show',$assignment->question_id)}}" class="text-info"> {!!$assignment->question->instruction!!} </a>  </td>
                                    <td class="text-uppercase"> <small> {{$assignment->question->question_type}} </small></td>
                                    <td>
                                        @if ($assignment->question->level == 1)
                                            <span class="text-success"> Easy </span>
                                        @endif
                                        @if ($assignment->question->level == 2)
                                            <span class="text-primary"> Medium </span>
                                        @endif
                                        @if ($assignment->question->level == 3)
                                            <span class="text-danger"> Hard </span>
                                    @endif
                                    </td>
                                    <td> {{$assignment->question->max_points}} </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_assignment_ids[]" value="{{$assignment->id}}" id="defaultCheck1">
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"> No questions assigned </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection
