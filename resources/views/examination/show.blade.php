@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-paste text-white text-info"></i>  Examination  </h4>
        <small class="text-muted"> <i> Manages examination details, assignment, questions and settings </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('examination.index')}}">Examination</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$exam->name}} </li>
        </ol>
    </nav>
</div>

<form action="{{route('examination.examination-assignment.unassign-questions')}}" method="POST" >
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h5 class="text-muted"> <strong> {{$exam->name}} </strong> &nbsp&nbsp   </h5>
            <small> {{$exam->description ?? 'No details provided'}} </small>
            <hr>
            <div>
                <i class="fas fa-clock"></i> {{$exam->duration}} Minutes
                &nbsp&nbsp
                <i class="fas fa-star text-warning"></i> {{$exam->total_score}} Maximum Score
                &nbsp&nbsp
                <a href="{{route('groups.show',$exam->group_id)}}" class="text-info"> <i class="fas fa-cube"></i> {{$exam->group->name}} </a>
                &nbsp&nbsp
                <a href="{{route('examination.edit',$exam)}}" class="text-info"> <i class="fas fa-edit "></i> Edit Exam </a>
                &nbsp&nbsp
                <a href="{{route('examination.delete',$exam)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this exam? All exam assignments to users will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Exam </a>
            </div>
            <br>
            <div class="mt-5">
                <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
                <a href="{{route('examination.examination-assignment.index',$exam)}}" class="btn btn-info btn-sm"> <i class="fas fa-question-circle"></i> Assign Questions </a>
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected questions?')"> Unassign Questions </button>
                <a href="{{route('groups.show',$exam->group_id)}}" class="btn btn-outline-secondary btn-sm"> Go to Group </a>
            </div>
            <table class="table table-hover mt-3">
                <thead>
                    <th> Question </th>
                    <th> Type </th>
                    <th> Points </th>
                    <th>  </th>
                </thead>
                <tbody>
                    @forelse ($questions_assigned as $assignment)
                        <tr>
                            <td> <a href="{{route('question-bank.show',$assignment->question_id)}}" class="text-info"> {!!$assignment->question->instruction!!} </a>  </td>
                            <td class="text-uppercase"> <small> {{$assignment->question->question_type}} </small></td>
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

@endsection
