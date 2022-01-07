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
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Class</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$exam->group)}}"> {{$exam->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$exam->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <span class="float-right">
            <a href="{{route('groups.toogle-visibility',$exam->groupModule)}}"> 
                <i class="{{$exam->groupModule->visibility == 1 ? 'fas fa-eye text-success' : 'fas fa-eye-slash text-secondary'}}"></i>
                <small>  {{$exam->groupModule->visibility == 1 ? 'Visible to student' : 'Hidden to student'}} </small>
            </a>
          
        </span>
        <h5 class="text-muted"> <i class="fas fa-copy text-primary fa-2x m-1"></i>  <strong> {{$exam->name}} </strong> &nbsp&nbsp   </h5>
        <small> {{$exam->description ?? 'No details provided'}} </small>
        
        <hr>
        <div>
            <i class="fas fa-clock"></i> Duration: <strong> {{$exam->duration}} Minutes </strong> 
            &nbsp&nbsp <br>
            <i class="fas fa-star text-warning"></i> Maximum Score: <strong> {{$exam->total_score}}  </strong> 
            &nbsp&nbsp <br>
            <i class="far fa-calendar-check"></i> Date Start: <strong> {{Carbon\Carbon::parse($exam->accessible_at)->format('M d, Y | h:i a')}}  </strong> 
            &nbsp&nbsp <br>
            <i class="far fa-calendar-times"></i> Date End: <strong> {{Carbon\Carbon::parse($exam->expired_at)->format('M d, Y | h:i a')}} </strong> 
            &nbsp&nbsp <br>
           
        </div>
        <hr>
        <div>
            <a href="{{route('groups.show',$exam->group_id)}}" class="text-primary"> <i class="fas fa-cube"></i> {{$exam->group->name}} </a>
            &nbsp&nbsp
            @if ($exam_answers == 0)
                <span class="float-right">
                    <a href="{{route('groups.exam.edit',$exam)}}" class="text-primary"> <i class="fas fa-edit "></i> Edit Exam </a>
                    &nbsp&nbsp
                    <a href="{{route('groups.exam.delete',$exam)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this exam? All exam assignments to users will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Exam </a>
                    &nbsp&nbsp
                </span>
            @else
                <strong class="text-danger float-right"> <i class="fas fa-exclamation-circle"></i> Students already answered in this exam. Modification of this exam is unavailable </strong> 
            @endif
            
          
           
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
                        <th></th>
                        <th> User </th>
                        <th> Score </th>
                        <th> Attempt No. </th>
                        <th> Status </th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($exam_assignments as $assignment)
                            <tr>
                                <td> <img  width="30" height="30" style="border-radius: 50%;" src="{{ url('/uploads/' . $assignment->user->avatar) ?? url('/uploads/default-avatar.png')}}" /></td>
                                <td> <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" target="_blank"> {{$assignment->user->name}} </a> </td>
                                <td> {{$assignment->score}} / {{$assignment->exam->total_score}} </td>
                                <td> {{$assignment->attempt}} </td>
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
                                        <a href="{{route('groups.exam.generate-pdf',$assignment)}}" target="_blank" class="btn btn-primary btn-sm"> <i class="fas fa-download"></i> Download Result </a> 
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
                    @if ($exam_answers == 0)
                    <div class="mt-3">
                        <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
                        <a href="{{route('groups.exam.examination-assignment.index',$exam)}}" class="btn btn-primary btn-sm"> <i class="fas fa-question-circle"></i> Assign Questions </a>
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected questions?')"> Unassign Questions </button>
                    </div>
                    @endif
                
                    <table class="table table-hover mt-3 table-bordered">
                        <thead>
                            <th> Question </th>
                            <th> Type </th>
                            {{-- <th> Difficulty </th> --}}
                            <th> Points </th>
                            <th> Remove </th>
                        </thead>
                        <tbody>
                            @forelse ($questions_assigned as $assignment)
                                <tr style="height:100px;">
                                    <td> 
                                        {{-- <a href="{{route('question-bank.show',$assignment->question_id)}}" class="text-primary"> {!!$assignment->question->instruction!!} </a>   --}}
                                        <div id="q_instruction{{$assignment->question->id}}" class="q_instruction"> {!! $assignment->question->instruction !!}  </div>
                                        <div id="full_q_instruction{{$assignment->question->id}}" class="full_q_instruction"></div> 
                    
                                        @if (strlen($assignment->question->instruction) >= 250)
                                        <strong class="text-primary" id="btn-see-more{{$assignment->question->id}}" class="btn-see-more" style="cursor:pointer" onclick="showFullDescription({{$assignment->question}})"> See more </strong>
                                        <strong class="text-primary" id="btn-see-less{{$assignment->question->id}}" class="btn-see-less" style="cursor:pointer;display:none" onclick="showLessDescription({{$assignment->question}})"> See Less </strong>
                                        @endif
                                    </td>
                                    <td class="text-uppercase"> <small> {{$assignment->question->question_type}} </small></td>
                                    {{-- <td>
                                        @if ($assignment->question->level == 1)
                                            <span class="text-success"> Easy </span>
                                        @endif
                                        @if ($assignment->question->level == 2)
                                            <span class="text-primary"> Medium </span>
                                        @endif
                                        @if ($assignment->question->level == 3)
                                            <span class="text-danger"> Hard </span>
                                    @endif
                                    </td> --}}
                                    <td> {{$assignment->question->max_points}} </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_assignment_ids[]" value="{{$assignment->id}}" id="defaultCheck1">
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> No questions assigned </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
    $(".q_instruction").text(function(index, currentText) {
        if(currentText.length >= 250){
            return currentText.substr(0, 250)+"...";
        }
    });

    function showFullDescription(question){
        $( "#btn-see-more"+question.id).hide();
        $( "#btn-see-less"+question.id).show();
        $( "#q_instruction"+question.id).empty();
        $('#full_q_instruction'+question.id).html(question.instruction)
    }

    function showLessDescription(question){
        $( "#btn-see-more"+question.id).show();
        $( "#btn-see-less"+question.id).hide();
        $("#q_instruction"+question.id).html(question.instruction)
        $("#q_instruction"+question.id).text(function(index, currentText) {
            return currentText.substr(0, 250)+"...";
        });
        $('#full_q_instruction'+question.id).empty()
    }

    </script>


@endsection
